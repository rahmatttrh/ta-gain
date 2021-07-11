<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{User, Teknisi};
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();
        if($user){
            if($user->level == 'teknisi'){
                if(password_verify($request->password, $user->password)){
                    $teknisi = Teknisi::where('email', $user->email)->get()->first();
                    return response()->json([
                        'success' => 1,
                        'message' => "Berhasil Login.",
                        'data' => $teknisi
                    ]);
                } else {
                    return $this->error('Password tidak sesuai');
                }
            } else {
                return $this->error('User tidak ditemukan');
            }
        } else {
            return $this->error('User tidak ditemukan');
        }
    }

    public function error($message){
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }
}
