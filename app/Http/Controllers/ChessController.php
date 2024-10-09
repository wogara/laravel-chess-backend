<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Events\MoveEvent;

class ChessController extends Controller
{
	public function storeMove(Request $request){
		$validated=$request->validate([
			'game_id' => 'required|uuid',
			'from' => 'required|string',
			'to' => 'required|string',
			'played_by' => 'required|string',
			'promotion' => 'nullable|string',
		]);

		$game = Game::firstOrCreate(
			['id' => $validated['game_id']],
			['moves' => []]
		);
		$moves = $game->moves ?? [];

		$newMove = [
			'from' => $validated['from'],
			'to' => $validated['to'],
			'played_by' => $validated['played_by'],
			'promotion' => $validated['promotion'] ?? null
		];

		$moves[] = $newMove;

		$game->update(['moves' => $moves]);
		broadcast(new MoveEvent($newMove))->toOthers();
		return response()->json(['message' => 'Moved saved successfully', 'moves' => $moves]);
	}

	public function getMoves(Request $request){
		$validated = $request->validate([
			'game_id' => 'required|uuid',
		]);

		$game = Game::find($validated['game_id']);

		if (!$game) {
			return response()->json(['message' => 'Game not found'], 404);
		}

		return response()->json([
			'moves' => $game->moves,
			'white_email' => $game->white_email,
			'black_email' => $game->black_email
		],200);
	}
}
