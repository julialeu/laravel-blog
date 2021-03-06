<?php


use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Post;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;

Route::post('newsletter', function (Newsletter $newsletter){

    request()->validate(['email'=>'required|email']);


    try {
        $newsletter->subscribe(request('email'));

    }catch (\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email'=>'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')
        ->with('success', 'You are now signed up for our newsletter!');
});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');




Route::get('/dummy', function () {

    $a = Post::where('slug', 'harum-et-non-et-qui')->get();

//   var_dump($a);
//   die;
});





