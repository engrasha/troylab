<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Event;
use App\Events\SendMail;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Transformers\ProfileTransformer;
use Auth;
use App\Models\User;
use Carbon\Carbon;

class UsersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $profileTransformer;


    function __construct(Request $request, ProfileTransformer $profileTransformer)
    {       
        $this->profileTransformer = $profileTransformer;
        $this->middleware('jwt.auth')->only(['logout']);
    }

    public function regist( Request $request )
    {
        $validator = Validator::make( $request->all(), [
            'name'        => 'required|string',
            'username'    => 'required|string|unique:students,username',
            'password'    => 'required|min:6',
            'school_id'   => 'required|exists:schools,id'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'code'      =>  401,
                'message'   => $validator->messages()->first()
            ), 401);
        }

        
        $latestUser = User::orderBy('id','DESC')->first();

        //return $latestUser->id;
        $student_order = (int) $latestUser->id + 1;
        
        
        $user = new User();
        $user->name         =  $request->name;
        $user->username         =  $request->username;
        $user->password      =  $request->password;
        $user->school_id    =  $request->school_id;
        $user->status = 0;
        $user->order = $student_order;
        $user->exam_assgin = 0;
        $user->remember_token = '';        
        $user->save();

        Event::dispatch(new SendMail(1));

        $token = JWTAuth::fromUser($user);

        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Successfully Registration, wait for active your account',
        ), 200);  

    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'username'    => 'required|string',
            'password'=> 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'code'      =>  401,
                'message'   =>  $validator->messages()->first()
            ), 401);
            
        }
         
        
         // check if user exist
         $is_exist = Auth::attempt(['username' => $request->username , 'password' => $request->password]) ? true : false;
         if(!$is_exist)
        {
            return response()->json(array(
                'code'      =>  401,
                'message'   =>  'There is no user with this username'
            ), 401);
        }
        // check if right data
        $is_active = Auth::attempt(['username' => $request->username , 'password' => $request->password, 'status' => 1]) ? true : false;
        if(! $is_active)
        {
            return response()->json(array(
                'code'      =>  401,
                'message'   =>  'Your account is not active'
            ), 401);
        }
        


        $credentials = $request->only('username','password');
        return $this->generateToken( $credentials);


    } 

    public function logout(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        $current_token  = JWTAuth::getToken();

        if ( !$current_token ) {
            return response()->json(array(
                'code'      =>  401,
                'message'   =>  'Token faild validation'
            ), 401);
        }

        JWTAuth::setToken( $current_token )->invalidate();
        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Successfully Logout'
        ), 200);

    }





    public function generateToken( $credentails)
    {
       
    	try {
            if ( !$token = JWTAuth::attempt($credentails) ) {

                return $this->respondUnauthorized( 'Wrong Student data' );
                
            }

        } catch (JWTException $e) {
            return response()->json(array(
                'code'      =>  500,
                'message'   =>  'Can not create token'
            ), 500);
        
         } catch (TokenExpiredException $e) {
            return response()->json(array(
                'code'      =>  500,
                'message'   =>  'Expired token'
            ), 500);
        }

       // return $token;

         
       // $user = JWTAuth::toUser($token);
        $user = Auth::user();
        $user->updated_at = Carbon::now();
        $user->remember_token = $token;
        $user->save();
        $profile = $this->profileTransformer->transform($user);

        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Success',
            'data'=>$profile,
            'token' => $token
        ), 200);
        
       
    }

    public function Profile( Request $request ) // get user profile data
    {

        $user =  $this->getAuthenticatedUser();
        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Success',
            'data'=> $this->profileTransformer->transform($user)
        ), 200);
    }

    public function update_Password(  $request )
    {
        $user =  $this->getAuthenticatedUser();

        $validator = Validator::make($request->all(),[
            'old_password'          => 'required',
            'new_password'          => 'required|string',
            'repeat_password'       => 'required_with:new_password|same:new_password',
        ]);


        if ($validator->fails()) {
            return response()->json(array(
                'code'      =>  401,
                'message'      => $validator->messages()->first(),
            ), 401);
            
        }

        $user =  User::find($user->id);
        $isValidPassword = Hash::check($request->old_password, $user->password);
        $isCorrectOldPassword = $isValidPassword ? true : false;
        

        if (!$isCorrectOldPassword ) {
            return response()->json(array(
                'code'      =>  401,
                'message'      => 'Wrong Old Password'
            ), 401);
        } 
       
        $user->password     =  $request->new_password;
        $user->save();
        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Success updated password'
        ), 200);

        
    }

    public function updateProfile(Request $request)
    { 
        $user =  $this->getAuthenticatedUser();

        $validator = Validator::make( $request->all(), [
            'name'        => 'required|string',
            'username'    => ['required', 'string', Rule::unique('students')->ignore($user->id, 'id')],
            'school_id'   => 'required|exists:schools,id'
        ]);


        if ($validator->fails()) {
            return response()->json(array(
                'code'      =>  401,
                'message'   => $validator->messages()->first()
            ), 401);
        }



        $userData = User::find( $user->id );
        $userData->name =  $request->name;
        $userData->username =  $request->username;
        $userData->password =  $request->password;
        $userData->school_id =  $request->school_id;		
        $userData->save();
         
        return response()->json(array(
            'code'      =>  200,
            'message'   =>  'Successfully updated',
            'data'=> $this->profileTransformer->transform($user)
        ), 200);
        
    }

    
    
    

}
