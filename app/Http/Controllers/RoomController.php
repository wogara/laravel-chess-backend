<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Game;

class RoomController extends Controller
{
    //
    //
    public function create(Request $request){
	    $roomID= Str::uuid()->toString();

	    $validatedData = $request->validate([
		    'white_email' => 'nullable|email',
		    'black_email' => 'nullable|email',
	    ]);

	    $game = Game::create([
		    'id' => $roomID,
		    'white_email' => $validatedData['white_email'] ?? null,
		    'black_email' => $validatedData['black_email'] ?? null,
		    'moves' => [],
	    ]);

        return response()->json(['roomID'=>$roomID],201);
    }

    public function getGamesByEmail(Request $request){
	    $request->validate([
		    'email' => 'required|email',
	    ]);

	    $email = $request->query('email');

	    $games = Game::where('white_email',$email)
		    ->orWhere('black_email',$email)
	    	    ->get();

	    return response()->json($games);
    }
}
