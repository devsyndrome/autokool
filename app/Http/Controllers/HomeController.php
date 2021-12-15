<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMenu;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        return view('index',compact('menu'));
    }
}
