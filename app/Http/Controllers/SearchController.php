<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Folder;
use App\Files;

class SearchController extends Controller
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
        return view('search');


    }

    /**
     * Show the application dashboard.
     *
     * @return home
     */
    public function files(Request $request)
    {   $value = Input::get('search');
        if ($request->input('opt')=='Folders')
            $search = Folder::where('user_id', Auth::getUser()->id)->where('name','like','%'.$value.'%')->get();
        else
            $search = Files::where('user_id', Auth::getUser()->id)->where('name','like','%'.$value.'%')->get();

        return view('search',compact('search'));
    }
}
