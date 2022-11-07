<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function signup(Request $request)
    {


        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'identification' => 'required',
                    'email' => 'required|string|unique:users',
                    'password' => 'required|string|confirmed'

                ]
            );

            if ($validator->fails()) {
               return response()->json(['status' => false, 'error' => $validator->errors()], 500);
            }

            $validation_user= User::where('name',$request->identification)->first();

            if (!is_object($validation_user)) {
               
                $user = new User([
                    'name' => $request->identification,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'firstname' => $request->firstname == null ? 'N/A': $request->firstname,
                    'lastname' => $request->lastname,
                    'identification' => $request->identification,
                    'phone_number' =>$request->phone_number,
                    'conventional_number' => $request->conventional_number == null ? 'N/A': $request->conventional_number,
                    'date_birth' => $request->date_birth,
                    'blood_type' => $request->blood_type,
                    'profile_picture' =>'N/A'
                ]);

                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully created user!'
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'User already exists'
                ], 500);
            }

        } catch (Exception $ex) {
            return 'Register Failed ' .$ex->getMessage();
        }


    }
 
    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'password' => 'required|string',
                //'remember_me' => 'boolean'

            ]
        );

        if ($validator->fails()) {
           return response()->json(['status' => false, 'error' => $validator->errors()], 500);
        }

        $credentials = request(['name', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json(['status' => false,'message' => 'Unauthorized'], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $user=Auth::user();

        return response()->json([
            'status' => true,
            'token' =>[
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ],
            'user'=>$user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {


        return response()->json([
            'status' => true,
            'data' =>[
              'user_profile' => $request->user()
            ]
        ]);
    }

    public function userUpdate(Request $request)
    {

        DB::beginTransaction();
        $user=User::find($request->user()->id);

        $file = 'N/A';
        if ($request->hasFile('profile_picture')) {
            $img = $request->file('profile_picture');
            $destinationPath = 'image/user/';
            $filename = time() . '-' . $img->getClientOriginalName();
            $request->file('profile_picture')->move($destinationPath, $filename);

            $file = $destinationPath . $filename;
        }

        if(empty($request->password)){
            $user_data=[
                'name' => $request->identification,
                'email' => $request->email,
                'firstname' => $request->firstname == null ? 'N/A': $request->firstname,
                'lastname' => $request->lastname,
                'identification' => $request->identification,
                'phone_number' =>$request->phone_number,
                'conventional_number' => $request->conventional_number == null ? 'N/A': $request->conventional_number,
                'date_birth' => $request->date_birth,
                'blood_type' => $request->blood_type,
                'profile_picture' =>$file,
            ];
        }else{
            $user_data=[
                'name' => $request->identification,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'firstname' => $request->firstname == null ? 'N/A': $request->firstname,
                'lastname' => $request->lastname,
                'identification' => $request->identification,
                'phone_number' =>$request->phone_number,
                'conventional_number' => $request->conventional_number == null ? 'N/A': $request->conventional_number,
                'date_birth' => $request->date_birth,
                'blood_type' => $request->blood_type,
                'profile_picture' =>$file,
            ];
        }

        $user->update(
            $user_data
        );

        DB::commit();

        return response()->json([
            'status' => true,
            'data' =>[
              'user_profile' => $user
            ]
        ]);
    }

    public function userList(){

        $users=User::get();

        return response()->json([
            'status' => true,
            'data' =>[
              'user_list' => $users
            ]
        ]);
    }


}
