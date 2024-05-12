<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render("Welcome");
    }
    public function galeri(){
        return Inertia::render("Home/Galeri");
    }
    public function camera(){
        return Inertia::render("Home/Camera");
    }
}
