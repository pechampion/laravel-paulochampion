@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="btns">
                <a href="{{route('new',[$id])}}" class="btn btn-primary">Add Folder</a>
                <a href="{{route('file-upload',[$id])}}" class="btn btn-primary">Upload File</a>
                <a href="{{route('search')}}" class="btn btn-primary">Search Folder or File</a>
            </div>

            <br>
            <div class="card">

                <div class="card-header">
                    @foreach($directory as $dir)
                        <a href="{{$dir['link']}}">{{$dir['root']}}</a> /
                    @endforeach
                    {{$current}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table CLASS="table-responsive">
                           @foreach($folders as $folder)
                                <tr>
                                    <td>  <img class="img-responsive img-left" src="{{asset('img/folder.png')}}" width="24" height="24" alt=""> </td>
                                    <td> <a href="/folder/{{$folder->id}}">  {{$folder->name}} </a> </td>
                                </tr>
                           @endforeach

                            @foreach($files as $file)
                                   <tr>
                                       <td>  <img class="img-responsive img-left" src="{{asset('img/doc.png')}}" width="24" height="24" alt=""> </td>
                                       <td> <a href="{{route('download',$file->path)}}">  {{$file->name}} </a> </td>
                                   </tr>
                               @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
