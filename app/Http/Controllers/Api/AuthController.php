<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validations= Validator::make($request->all(),[
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'email'=>'required|email|unique:users|max:155',
            'password'=>'required|string|min:6|',

        ]);
        //check error
        if($validations->fails()){
            $errors = $validations->errors();
            return response()->json([
                'errors' => $errors,
                'status'=>401
            ]);
        }
        //check if validations is successs
   
   
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'type' => 'Bearer'
            ]);
    }

    
    public function login(Request $request){
        if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'message' => 'Information de Connexion non reconnus',
                'status'=>401
            ]);
        }
        $user = User::where('email',$request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'type' => 'Bearer',
            'status' =>200,
        ])->cookie('jwt',$token);


        
    }

public function user(Request $request){
    return $request->user();
}




















    // public function register(Request $request)
    // {
    //     try {
    //         //Validated
    //         $validateUser = Validator::make($request->all(), 
    //         [
    //             'nom' => 'required',
    //             'prenom' => 'required',
    //             'email' => 'required|email|unique:users,email',
    //             'password' => 'required'
    //         ]);

    //         if($validateUser->fails()){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }

    //         $user = User::create([
    //             'nom' => $request->nom,
    //             'prenom' => $request->prenom,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password)
    //         ]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'User Created Successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ], 200);

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }

    // /**
    //  * Login The User
    //  * @param Request $request
    //  * @return User
    //  */
    // public function login (Request $request)
    // {
    //     try {
    //         $validateUser = Validator::make($request->all(), 
    //         [
    //             'email' => 'required|email',
    //             'password' => 'required'
    //         ]);

    //         if($validateUser->fails()){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }

    //         if(!Auth::attempt($request->only(['email', 'password']))){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Email & Password does not match with our record.',
    //             ], 401);
    //         }

    //         $user = User::where('email', $request->email)->first();

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'User Logged In Successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ], 200);

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }
}
