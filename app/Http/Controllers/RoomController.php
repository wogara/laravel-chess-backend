<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    //
    //
    public function create(Request $request){
        $roomID= Str::uuid()->toString();

        return response()->json(['roomID'=>$roomID],201);
    }
}
