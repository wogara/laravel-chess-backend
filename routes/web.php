<?php


use App\Events\MoveEvent;
use Illuminate\Support\Facades\Route;

Route::get('test', function() {
    event(new MoveEvent('hello from web.php'));
    return 'done';
});

Route::get("/{any}",function () {
	return file_get_contents(public_path('app.html'));
})->where('any','.*');
