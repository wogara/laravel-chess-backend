<?php


use App\Events\MoveEvent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function() {
    event(new MoveEvent('hello from web.php', 3));
    return 'done';
});
