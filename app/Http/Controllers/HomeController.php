<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Files;
use Illuminate\Http\Request;
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
     * @return home
     */
    public function index()
    {
        return redirect('/folder/0');
    }

}
