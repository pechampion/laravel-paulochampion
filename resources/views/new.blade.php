@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>New Folder</h1>
                 <form class="form" method="post" action="{{route('folder.store')}}">
                     <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Folder Name">
                         <input type="hidden" name="id" value="{{$id}}">
                         {!! csrf_field() !!}
                     </div>
                     <div class="form-group" align="right">
                       <button type="submit" class="btn btn-primary" >Save</button>
                     </div>
                </form>
            </div>
        </div>
    </div>
@endsection