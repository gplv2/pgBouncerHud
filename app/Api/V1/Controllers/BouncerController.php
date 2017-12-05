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

class BouncerController extends Controller
{
    protected $hidden = ['password', 'remember_token'];
        // 'label', 'dsn', 'priority',

    use Helpers;

    public function create()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $categories = Category::all();

        return view('bouncers.create', compact('categories'));
    }

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

    public function index(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $response = new Response();
        $response->header('charset', 'utf-8');

        $categories = Category::all();
        $bouncers = Bouncer::all();

        return response()->json(compact('bouncers', 'category'),200);
    }

    public function store(Request $request, AppMailer $mailer)
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

        $bouncer = new Bouncer([
                'label'     => $request->input('label'),
                'category_id' => $request->input('category_id'),
                'dsn'   => $request->input('dsn'),
                'priority'  => $request->input('priority'),
                'description' => $request->input('description')
            ]);

        $bouncer->save();

        /*
        Slack::to('@gplv2')->attach([
            'fallback' => 'Bouncer notification',
            'text' => $bouncer->title,
            'color' => $color
        ])->attach($attachment)->send($template); // no message, but can be provided if you'd like
         */

        $reply =  array('status' => $bouncer->status, 'bouncer_id' => $bouncer->id, 'message' => 'Bouncer has been added to the configuration.');

        return response()->json($reply,201);
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
                'label'     => 'required|min:5',
                'dsn'   => 'required|min:8',
                'priority'   => 'required|digits_between:0,2',
                // 'email'   => 'required|email'
                // 'category'  => 'required',
        ];
    }
/*
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $this->formatValidationErrors($validator);
        }
    }
*/
}
