<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
    	return view('home');
    }

    public function activity()
    {
    	return view('activity');
    }

    public function mylogin()
    {
    	return view('login');
    }

    public function profile()
    {
    	return view('profile');
    }

    public function form1()
    {
        return view('forms.form1');
    }

    public function form2()
    {
        return view('forms.form2');
    }

    public function form3()
    {
        return view('forms.form3');
    }

    public function form4A()
    {
        return view('forms.form4A');
    }

    public function form4B()
    {
        return view('forms.form4B');
    }

    public function form5A()
    {
        return view('forms.form5A');
    }

    public function form5B()
    {
        return view('forms.form5B');
    }

    public function form6()
    {
        return view('forms.form6');
    }

    public function form7A()
    {
        return view('forms.form7A');
    }

    public function form7B()
    {
        return view('forms.form7B');
    }
}
