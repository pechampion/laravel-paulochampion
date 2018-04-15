@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="form" method="get" action="{{route('search.files')}}">
                    <h2 align="center"> Search </h2>
                    <label for="search">Enter the search value:</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." required>
                    </div>
                    <div class="col-md-2">
                        <div class="radio">
                            <label><input type="radio" name="opt"  value="Files" required>Files</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="opt" value="Folders" required>Folders</label>
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
            @if((isset($search))&&(count($search) >=1))
                <table>
                    @foreach($search as $src)
                        <tr>
                            <td>  <img class="img-responsive img-left" src="{{asset('img/'.(isset($src->sub_id)?'folder':'doc').'.png')}}" width="24" height="24" alt=""> </td>
                            <td> <a href="{{isset($src->sub_id)?'/folder/'.$src->id:route('download',$src->path)}}">  {{$src->name}} </a> </td>
                        </tr>
                    @endforeach
                </table>
                @elseif (isset($search))
                    <h2> Nothing found. </h2>
                    <p> Your search returned no results.</p>

                @endif
            </div>
        </div>
    </div>

@endsection