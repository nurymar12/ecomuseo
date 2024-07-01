<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Volunteer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:edit-task', ['only' => ['edit','complete']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $volunteers = Volunteer::with(['user'])
            ->where('volunteers.status', '!=', 'inactive') // Filtra por estado 'active'
            ->whereHas('tasks', function ($query) {
                $query->where('task_volunteer.status', 'pending'); // Filtra por tareas con estado 'pending'
            })
            ->latest()
            ->paginate(10);

        return view('home', compact('volunteers'));
    }
}
