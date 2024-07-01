<?php

namespace App\Http\Controllers;

use App\Models\Components;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $components = Components::all(); // Ajusta esta consulta según tus necesidades.
        return view('welcome', compact('components'));
    }
}
