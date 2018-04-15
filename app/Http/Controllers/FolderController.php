<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Folder;
use App\Files;


class FolderController extends Controller
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
     * @return view (home)
     */
    public function index($id)
    {
        // Including List of Folders and Files to be used by view
        $folders = Folder::where('user_id', Auth::getUser()->id)->where('sub_id',$id)->get();
        $files = Files::where('user_id', Auth::getUser()->id)->where('folder_id',$id)->get();
        // Get list ob Subdirectories if is not root
        $directory = ($id==0)?[]:$this->getSub($id);
        // Get Folder Name if is not root
        $current = ($id==0)?'..':$this->getFolderName($id);
        return view('home', compact('folders','files', 'directory', 'current','id'));
    }

    /**
     * Show New Folder Form.
     *
     * @return view (new)
     */
    public function create($id)
    {
        // Open View
        return view('new',compact('id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array('name'=>'required|max:255');
        $validator = Validator::make(Input::all(),$rules);

        if ($validator->fails()){
            return  redirect('folder/create')->withInput()->withErrors($validator);
        } else {

            $folder = new Folder;
            $folder->name = Input::get('name');
            $folder->sub_id = Input::get('id');
            $folder->user_id = Auth::getUser()->id;
            $folder->save();

            return redirect('folder/'.Input::get('id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
    }
    /**
     * Save New Folder
     *
     * @return view (new)
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * Allow the user select any previous subfolder
     *
     * @return List of Directories
     */
    private function getSub($id)
    {
        $row = Folder::where('user_id', Auth::getUser()->id)->where('id',$id)->pluck('sub_id');
        $result = [];
        foreach ($row as $sub)
        while ($sub > 0){
            $result = array_prepend($result,['root'=>$this->getFolderName($sub),'link'=>$sub]);
            $sub = $this->getFolderSub($sub);
        }

        if (isset($result))
            $result = array_prepend($result,['root'=>'root','link'=>'0']);
        return $result;
    }

    /**
     * Function to return Name of Folder.
     *
     * @return List of Directories
     */
    private function getFolderName($id)
    {
        $row = Folder::where('user_id', Auth::getUser()->id)->where('id',$id)->pluck('name');
        foreach ($row as $name)
        return $name;
    }

    /**
     * Function to return Sub_Id of Folder.
     *
     * @return List of Directories
     */
    private function getFolderSub($id)
    {
        $row = Folder::where('user_id', Auth::getUser()->id)->where('id',$id)->pluck('sub_id');
        foreach ($row as $sub)
        return $sub;
    }


}
