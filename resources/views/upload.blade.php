@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                    <div class="form-group">
                         <form class="form" action="{{route('upload')}}" method="post" enctype="multipart/form-data" >
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <input type="hidden" name="id" value="{{$id}}">
                             <h2 align="center"> File Update </h2>
                            <div class="col-md-12">
                                 <label for="search">Enter file to upload:</label>
                                <div class="form-group">
                                     <input type="file" class="form-control" name="File" required>
                                </div>
                                <div class="form-group" align="center">
                                     <input type="submit" class="btn btn-primary" value="Submmit">
                                </div>
                            </div>
                        </form>
                     </div>
            </div>
        </div>

    </div>

@endsection