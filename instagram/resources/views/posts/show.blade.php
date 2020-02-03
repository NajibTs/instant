@extends('layouts.app')

@section('content')


<div class="container d-flex justify-content-center">


   

    <div class="row">
            
            <div class="col-8">

                    <img width='500' height="500" src="/storage/{{ $post->image }}" alt="image">
<br>
                    {{-- <span style="margin-left:2%" id = heart><i style="font-size:20px" class="fa fa-heart-o" aria-hidden="true" ></i> </span> --}}
            
                </div>
        

        <div class="col-4">
    
            <div>

            <div class="d-flex align-items-center">

                <div class="pr-3">

                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:40px">

                </div>

                <div>

                <div class="font-weight-bold row d-flex justify-content-between">
                    
                    <a class=" ml-3  font-weight-bold" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a>

                    {{-- <a style="text-decoration:none; color:darkgreen; padding-left:15px" href="#"> Follow </a> --}}

                    <a title="Delete this post"  style="color:red; " class="ml-5 font-weight-bolder" href="/delete/{{$post->id}}">X</a>
                
                
                
                </div>

                </div>

            </div>

            <p class="mt-3"><span class="font-weight-bold"><a style="padding-right:10px" href="/profile/{{$post->user->id}}">{{$post->user->username}}</a></span>{{$post->caption}}</p>

           

            <hr>
            <h4>Comments</h4>
        <div class=" overflow" style="max-height:200px; overflow-x:hidden"  uk-overflow-auto>
            @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
            <hr />
            <h4>Add comment</h4>
            <form  method="post" action="{{ route('comments.store'   ) }}">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body"></textarea>                    
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
                <div class="form-group">
                    <input style="padding:10px" type="submit" class="btn btn-success" value="Add Comment" />
                </div>*
            </form>
        </div>


        
        </div>

        </div>

    </div>
            
                    
</div>


@endsection
