<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// Importa el middleware Role de Spatie
use Spatie\Permission\Middleware\RoleMiddleware;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\WelcomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [WelcomeController::class, 'index']);

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
    });

    Route::get('/google-auth/callback', function () {

    $user_google = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ],[
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);
    if (User::count() == 1) {
        $user->assignRole('Admin');
    }else {
        $user->assignRole('Visitor');
    }
    Auth::login($user);

    if($user->hasRole("Admin")){
        return redirect('/dashboard');
    } else {
        return view('welcome');
    }

    // $user->token
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified', 'redirect.if.not.admin.or.volunteer'])
    ->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'redirect.if.not.admin.or.volunteer'])->name('dashboard');

// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'components' => ComponentsController::class,
]);

Route::get('/components/public/{id}', [ComponentsController::class, 'publicShow'])->name('components.publicShow');




// Asegúrate de que la ruta apunte a la vista dentro de la subcarpeta 'static'
Route::get('/static/contactUs', function () {
    return view('static.contactUs');
});


require __DIR__.'/auth.php';
