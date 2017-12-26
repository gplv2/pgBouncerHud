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

use Dingo\Api\Exception\ValidationHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

//use Slack;
//use Maknz\Slack\Attachment;
//use Maknz\Slack\AttachmentField;

use Validator;
use App\Cluster;
use App\Member;
use App\Bouncer;
use App\Mailers\AppMailer;

// Gridview
use ViewComponents\Eloquent\EloquentDataProvider;

// use DB;
use Cache;
use Log;


class ClusterController extends Controller
{
    // protected $hidden = ['password', 'remember_token'];

    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        //$response = new Response();
        //$response->header('charset', 'utf-8');

        $members = Member::all();
        $clusters = Cluster::all();

        return response()->json(compact('clusters', 'members'),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        //$categories = Category::all();

        //return view('clusters.create', compact('clusters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        if (!$currentUser->is_admin) {
            $reply =  array('status' => 'Error', 'message' => 'You need to be an admin user to perform this operation','msg_status'=>'error');
            return response()->json($reply,428);
        }

        $token = JWTAuth::getToken();

        $response = new Response();
        $response->header('charset', 'utf-8');

        $messages= array();

        //$reply = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            $reply = $validator->messages();
            return response()->json($reply,428);
            //return $reply;
        };

        $cluster = new Cluster([
                'label'     => $request->input('label'),
                'cluster_id' => $request->input('cluster_id'),
                'description' => $request->input('description')
            ]);

        $cluster->save();

        /*
        Slack::to('@gplv2')->attach([
            'fallback' => 'Bouncer notification',
            'text' => $cluster->title,
            'color' => $color
        ])->attach($attachment)->send($template); // no message, but can be provided if you'd like
         */

        $reply =  array('status' => $cluster->status, 'id' => $cluster->id, 'message' => 'Bouncer has been added to the configuration.');

        return response()->json($reply,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cluster_id)
    {
        $type='application/json'; // ->header('Content-Type', $type);

        $response = new Response();
        $response->header('charset', 'utf-8');

        $cluster = Cluster::where('id', $cluster_id)->firstOrFail();
        // $category = $bouncer->category;
        $members = $cluster->members();

        //$clusters = Cluster::all();
        return response()->json(compact('cluster', 'members'),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        // 'label', 'dsn', 'priority',
        return [
                'cluster_id'    => 'required|digits_between:0,2',
                'label'         => 'required|min:8'
        ];
    }
}
