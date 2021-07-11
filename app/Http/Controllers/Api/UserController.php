<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Teknisi, Order};

class UserController extends Controller
{

    public function setLoc(Request $request, Teknisi $teknisi){
        $teknisi->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json([
            'message' => 'Location has been updated'
        ]);
    }

    public function getTeknisi(Teknisi $teknisi){
        return response()->json([
            'message' => 'success',
            'teknisi' => $teknisi
        ]);
    }

    
}


