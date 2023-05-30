<?php

namespace App\Http\Controllers;


class StaticController extends Controller{
    public function help(){
        return view('pages.help');
    }

    public function about(){
        return view('pages.about-us');
    }

    public function contacts(){
        return view('pages.contacts');
    }
}
