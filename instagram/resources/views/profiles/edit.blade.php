@extends('layouts.app')

@section('content')


<div class="container" >


<form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
            @csrf

            @method('PATCH')
        
            <div class="row">
                <div class="col-8 offset-2">
        
                    <div class="row">
        
                     
                          <h1 class="row " style="padding-bottom: 10%; margin:auto; display:block ">Edit Profile </h1>
                    
                          <a style="font-size:20px; margin-right:20%; margin-top:15px" href="/profile/{{$user->id}}">{{$user->username}}</a>

                        
                    </div>
        
                        <div class="form-group row">

                            <div class="row">
                                
                                <label  for="title" class="col-md-4 col-form-label "><h2 >Title</h2></label>
                           
                                
                                    <input style="margin-top:2%" id="title" type="text" class="form-control @error("title") is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>
        
                                    @error("title")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>

                        </div>


                        <div class="form-group row">

                               
                               
                            <div class="row">
                                    <label  for="description" class="col-md-4 col-form-label "><h2 >Description</h2></label>
                               
                                    
                                        <input style="margin-top:2%" id="description" type="text" class="form-control @error("description") is-invalid @enderror" name="description" value="{{ old("description") ?? $user->profile->description }}" required autocomplete="description" autofocus>
            
                                        @error("description")
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
    
                                </div>

                            </div>
                            
                            
                            <div class="form-group row">

                                <div class="row">
                                        
                                    <label  for="url" class="col-md-4 col-form-label "><h2 >URL</h2></label>
                                   
                                        
                                            <input style="margin-top:2%" id="url" type="text" class="form-control @error("url") is-invalid @enderror" name="url" value="{{ old("url") ?? $user->profile->url }}" required autocomplete="url" autofocus>
                
                                            @error("url")
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
        
                                    </div>

                                </div>

                                
                                <div class="form-group row">

                                    <div class="row">
                            

                                            <label  for="image" class="col-md-6 col-form-label "><h2 style="margin-top:1%; " >Post Image</h2></label>
                
                                            <input style=" font-size:10px" type="file" class="form-control-file" id="image" name="image">
                
                                        @error('image')
                                            
                                                <strong style=" margin-top:2%; font-size:15px !important" class="ml-4 alert alert-danger" >{{ $message }}</strong>
                                            
                                        @enderror
                                        
                                     </div>

                                <div class="form-group row">
                           
        
                            <div class="row">  
                                        
                                    <button style="width:100px; height:50px; margin-top:50px" class="btn btn-primary ">Save Profile</button>
        
                            </div>
                        </div>
        
                
            </div>
        </form>          
                    
            
</div>
               
            
            
    

@endsection
