<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use File;
use App\Files;


class FilesController extends Controller
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

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($id)

    {

        return view('upload', compact('id'));

    }


    /**

     * Upload Files.

     *

     * @return \Illuminate\Http\Response

     */

    public function getUpload()

    {
        if (Input::hasFile('File')){
            $file = Input::File('File');
            // Folder Destination
            $destination = 'usr';
            // Get Original Filename
            $filename = $file->getClientOriginalName();
            // Hashing filename, purpose of security
            $hashname = md5($filename);
            // Get Size of File
            $size = $file->getClientSize();
            // Storage the File
            Storage::putFileAs($destination,Input::File('File'),$hashname);

            // Saving
            $file = new Files;
            $file->name = $filename;
            // get Folder id by the Form
            $file->folder_id = Input::get('id');
            // Authenticated User
            $file->user_id = Auth::getUser()->id;
            // File Size
            $file->size = $size;
            // Name cryptography used for download
            $file->path = $hashname;
            $file->save();



            // Redirecting to Main Page
            return redirect('folder/'.Input::get('id'));

        }

    }

    /**

     * Download File.

     *

     * @return \Illuminate\Http\Response

     */

    public function getDownload($hash)

    {
        $row = Files::where('user_id', Auth::getUser()->id)->where('path',$hash)->pluck('name');
        $filename = $row->first();

        $file = storage_path().'/app/usr/'.$hash;
        //$file = Storage::get('usr/'.$id);
        $header = array('Content-Type: application/octet-stream',);
        if (File::exists($file))
            //Download the File;
            return Response::download($file,$filename,$header);
        else return 'Error 204 - File not Exist';
    }

}
