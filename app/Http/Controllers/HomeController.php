<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home.index');
    }
    public function about() {
        return view('home.about');
    }
    
    public function service() {
        return view('home.service');
    }
    public function team() {
        return view('home.team');
    }
    public function contact() {
        return view('home.contactus');
    }
    public function profile() {
        return view('home.profile');
    }
}
