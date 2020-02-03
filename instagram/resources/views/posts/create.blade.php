@extends('layouts.app')

@section('content')


<div class="container">

<form action="/p" enctype="multipart/form-data" method="post">
    @csrf

    <div class="row">
        <div class="col-8 offset-2">

            <div class="row">

                <h1 style="padding-bottom: 10%; margin:auto; display:block">Add New Post</h1>

            </div>

                <div class="form-group row">
                        <label  for="caption" class="col-md-4 col-form-label "><h2 >Post Caption</h2></label>
                   
                        
                            <input style="margin-top:2%" id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       
                       
                        <div class="row">
                            

                            <label  for="image" class="col-md-6 col-form-label "><h2 style="margin-top:30%; margin-left:11%; padding-right:5px; width:100%" >Post Image</h2></label>

                            <input style="margin-left:12%; font-size:10px; " type="file" class="form-control-file" id="image" name="image">

                        @error('image')
                            
                                <strong style="margin-left:5%; margin-top:2%; font-size:15px !important" class="ml-4 alert alert-danger" >{{ $message }}</strong>
                            
                        @enderror
                        
                        </div>
  
                        
                    </div>
                   

                    <div class="row">
                                
                            <button style="width:100px; height:50px; margin-left:20px"  class="btn btn-primary mt-5">Add New Post</button>

                    </div>

        </div>
    </div>
</form>
            
                    
</div>


@endsection
