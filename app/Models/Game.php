<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

	protected $fillable = ['id', 'white_email', 'black_email', 'moves'];

	protected $casts = [
		'moves' => 'array',
	];

	public $incrementing = false;
	protected $keyType = 'string';
}
