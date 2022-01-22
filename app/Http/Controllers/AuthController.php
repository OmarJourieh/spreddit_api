<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
class AuthController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }//end __construct()


    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return $this->returnError('400','invalid date');
        }

        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return $this->returnError('400','Unauthorized');
        }

        return $this->respondWithToken($token);

    }//end login()

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:users',
                'username' => 'required|string|unique:users',
                'password' => 'required|min:6',
                'address' => 'required|string',
                'phone' => 'required|string',
                // 'account_type' => 'required|string',
                // 'id_university'=> 'numeric|nullable',
                // 'faculty_id'=> 'numeric|nullable'
            ]
        );

        if ($validator->fails()) {
            return $this->returnError('400','invalid date');
        }
        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );
        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);

    }//end logout()


    public function profile()
    {

        $user= $this->guard()->user();
        //   $this->returnData('amout',Crypt::decrypt( $user->password));
        return $this->returnData('user', $user);



    }//end profile()


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refr


    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
            ]
        );

    }//end re
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                // 'first_name' => 'string|between:2,100',
                // 'last_name' => 'string|between:2,100',
                // 'phone' => 'string|between:2,100',
                'username' => 'string|between:2,100',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }



        $this->guard()->user()->update(
            $validator->validated());
        return $this->guard()->user();


    }//
    protected function guard()
    {
        return Auth::guard();

    }//end guard()

    public function uploadphoto(Request $request)
    {


        if ($request->hasFile('file'))
        {
            $file = $request->file('file');
            $uploadpath = "storage/image";
            $orgenalimage = $file->getClientOriginalName();
            $file_name= time().'.'.$orgenalimage;
            $file->move($uploadpath,$file_name);
            $this->guard()->user()->update(['profile_pic'=>$file_name]);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
    }

}
