<?php

namespace App\Api\V1\Controllers;

use Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Dingo\Api\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Providers\HelperServiceProvider;

use Dingo\Api\Routing\Helpers;
//use Dingo\Api\Http\FormRequest;

use Dingo\Api\Exception\ValidationHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// ex ns App\Http\Controllers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

//use Slack;
//use Maknz\Slack\Attachment;
//use Maknz\Slack\AttachmentField;

use Validator;
use App\User;
use App\Category;
use App\Bouncer;
use App\Mailers\AppMailer;

// Gridview
use ViewComponents\Eloquent\EloquentDataProvider;

use DB;
use Cache;
use Log;

class PoolController extends Controller
{
    protected $hidden = ['password', 'remember_token'];
        // 'label', 'dsn', 'priority',

    use Helpers;

    public function show($bouncer_id)
    {
        $type='application/json'; // ->header('Content-Type', $type);

        $response = new Response();
        $response->header('charset', 'utf-8');

        $bouncer = Bouncer::where('id', $bouncer_id)->firstOrFail();
        $category = $bouncer->category;

        return response()->json(compact('bouncer', 'category'),200);
        // return view('bouncer.show', compact('bouncer', 'category'));
    }

    public function index(Request $request, $buid=null)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $response = new Response();
        $response->header('charset', 'utf-8');

        $categories = Category::all();
        $bouncers = Bouncer::all()->orderBy('enabled', 'tag', 'priority');

        return response()->json(compact('bouncers', 'category'),200);
    }

    public function action(Request $request, $buid=null) {

        $command='';

        switch($request->segment(3)) {
        case 'databases':
            $command='DATABASES';
            break;
        case 'stats':
            $command='STATS';
            break;
        case 'pools':
            $command='POOLS';
            break;
        case 'config':
            $command='CONFIG';
            break;
        case 'clients':
            $command='CLIENTS';
            break;
        case 'lists':
            $command='LISTS';
            break;
        default:
            $command='VERSION';
            break;
        }

        $currentUser = JWTAuth::parseToken()->authenticate();

        $response = new Response();
        $response->header('charset', 'utf-8');

        if (!empty($buid)){
            $bouncers = Bouncer::where([ ['id', '=', $buid], ['enabled', '=', 'true' ] ])->orderBy('enabled', 'tag', 'priority')->get();
        } else {
            $bouncers = Bouncer::where('enabled', '=', 'true')->orderBy('enabled', 'tag', 'priority')->get();
        }

        if (!count($bouncers)) {
            $resultsset = array('error' => '505', 'message' => sprintf('No valid active bouncers found in database'));
            return response()->json($resultsset,500);
        }

        $resultsset = array();

        foreach ($bouncers as $bouncer) {

            $dsn=array();
            //var_dump($bouncer->dsn);
            $dsn = parse_url($bouncer->dsn);
            $dn = $dsn;
            // Clear some sensitive stuff up
            $dn['pass']='<blanked>';

            if (!empty($dsn)) {
                $bouncer['dsns']=$dn;

                // Clean up the existing connection data
                DB::purge('pgbouncer');

                // Set with the contents of the bouncers table
                Config::set('database.connections.pgbouncer.driver', 'pgsql');
                Config::set('database.connections.pgbouncer.charset', 'utf8');
                Config::set('database.connections.pgbouncer.host', $dsn['host'] );
                Config::set('database.connections.pgbouncer.port', $dsn['port'] );
                Config::set('database.connections.pgbouncer.username', $dsn['user'] );
                Config::set('database.connections.pgbouncer.password', $dsn['pass'] );
                Config::set('database.connections.pgbouncer.database', ltrim($dsn['path'],'/'));

                // Since PGbouncer does not talk prepared, we need to emulate this and even patch the DB driver code a bit to set these PDO flags:
                // DB::setAttribute('PDO::ATTR_EMULATE_PREPARES', true);
                // DB::setAttribute('PDO::PGSQL_ATTR_DISABLE_NATIVE_PREPARED_STATEMENT' , true);
                Config::set('database.connections.pgbouncer.simple', 'true' );
                Config::set('database.connections.pgbouncer.options', [ \PDO::ATTR_EMULATE_PREPARES => true , \PDO::ATTR_TIMEOUT => 1 ] );
                try {
                    $sql = sprintf("SHOW ".$command);
                    $results = DB::connection('pgbouncer')->select(DB::raw($sql));
                    $resultsset[$bouncer->label] = array('results' => $results, 'info' => $bouncer);
                    // return response()->json($results,200);
                } catch(\Illuminate\Database\QueryException $e){
                    // var_dump($e->getMessage());
                } catch(\PDOException $e) {
                    // return $this->response->error('Problem with command on backend', 500);
                    // echo $e->getMessage();
                    // echo $e->getCode();
                    if ((int)$e->getCode() === 7) { // This is a timeout on network level.  if 1 bouncer fails we still want to see the results of the rest and not end up as an exception
                        $resultsset[$bouncer->label] = array('error' => '402', 'message' => sprintf('problem with pgbouncer : %s', $e->getMessage()), 'info' => $bouncer );
                    } else {
                        return response()->json(array('error' => '502', 'message' => sprintf('problem with pgbouncer : %s', $e->getMessage())), 500);
                    }
                } catch(Exception $e) {
                    // Log::info('Error: user', array($e->getMessage()));
                    // echo $e->getMessage();
                    return response()->json(array('error' => '401', 'message' => sprintf('problem : %s', $e->getMessage())), 500);
                }
            } else {
                $resultsset[$bouncer->label] = array('error' => '501', 'message' => sprintf('problem with DB dsn: %s',$bouncer->label));
            }
            //var_dump($resultsset);
        }
        return response()->json($resultsset,200);
    }
}
