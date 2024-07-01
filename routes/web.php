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
use App\Http\Controllers\TourController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VolunteerController;

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
    'tours' => TourController::class,
    'visits' => VisitController::class,
    'blogs' => BlogController::class,
    'donations' => DonationController::class,
    'tasks' => TaskController::class,
    'volunteers' => VolunteerController::class,
]);

Route::get('/components/public/{id}', [ComponentsController::class, 'publicShow'])->name('components.publicShow');

Route::get('/tour', [TourController::class, 'publicShow'])->name('tours.publicShow');


Route::get('/my-visits', [VisitController::class, 'publicVisits'])->name('visits.publicVisits');

Route::post('/visits/{visit}/approve', [VisitController::class, 'approve'])->name('visits.approve');
Route::post('/visits/{visit}/decline', [VisitController::class, 'decline'])->name('visits.decline');

Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blogs.public_index');
// Route::get('/blog', [BlogController::class, 'publicShow'])->name('blogs.publicShow');
Route::get('blog/{id}', [BlogController::class, 'publicShow'])->name('blogs.publicShow');


Route::post('/blogs/{blog}/approve', [BlogController::class, 'approve'])->name('blogs.approve');
Route::post('/blogs/{blog}/decline', [BlogController::class, 'decline'])->name('blogs.decline');

Route::get('/donations/manage', [DonationController::class, 'show'])->name('donations.show');

Route::post('/donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve');
Route::post('/donations/{donation}/decline', [DonationController::class, 'decline'])->name('donations.decline');
Route::post('/donations/export', [DonationController::class, 'export'])->name('donations.export');

Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::post('/tasks/export', [TaskController::class, 'export'])->name('tasks.export');
/* Route::post('/tasks/{task}/decline', [TaskController::class, 'decline'])->name('tasks.decline'); */


Route::get('/volunteers/manage', [VolunteerController::class, 'show'])->name('volunteers.show');
Route::post('/volunteers/{volunteer}/approve', [VolunteerController::class, 'approve'])->name('volunteers.approve');
Route::post('/volunteers/{volunteer}/decline', [VolunteerController::class, 'decline'])->name('volunteers.decline');
/* Route::post('/volunteers/{volunteer}/approve', [VolunteerController::class, 'approve'])->name('volunteers.approve');
Route::post('/volunteers/{volunteer}/decline', [VolunteerController::class, 'decline'])->name('volunteers.decline'); */

//Asegúrate de que la ruta apunte a la vista dentro de la subcarpeta 'static'
// Route::get('/contactus', function () {
//     return view('static.contactUs');
// })->name('contactus');

/* Route::get('/static/paymentsInfo', function () {
    return view('static.paymentInfo');
}); */


require __DIR__.'/auth.php';
