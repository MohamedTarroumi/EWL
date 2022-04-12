<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
class JWTAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','refresh']]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);

       
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->get('email'))->get();
        //dd($user);
        if (count($user) == 0)
        {
            return response()->json(['error' => 'This account not found'], 400);
        }
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Password is worng'], 400);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
      //  dd(Auth::user());
        $token = JWTAuth::getToken();
  //return response()->json(['error' => 'Token not found'], 401);
        if(!$token){
            return response()->json(['error' => 'Token not found','token' =>$token], 401);
        }
        try{
            $token = JWTAuth::refresh($token);
        }catch( TokenBlacklistedException $e){
            return response()->json(['error' => 'The token is Blacklisted'], 401);
        }catch(TokenInvalidException $e){
            return response()->json(['error' => 'The token is invalid'], 401);
          //  throw new AccessDeniedHttpException('The token is invalid');
        }catch(JWTException $e)
        {
            return response()->json(['error' => 'A JWTException exception is happend '], 401);
        }catch(Exception $e)
        {
            return response()->json(['error' => 'An error is happend '], 401);
        }

        // $token = JWTAuth::parseToken()->refresh();
        // dd($token);
        // if (!$token)
        // {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        
       return $this->createNewToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            
        ]);
    }
}
