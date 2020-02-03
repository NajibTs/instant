@extends('layouts.app')

@section('content')


{{-- <button style="float:right" >
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a  href="/profile/{{Auth::user()->id}}">Profile</a>
@else
<a href="{{ route('login') }}">Login</a>

@if (Route::has('register'))
<a href="{{ route('register') }}">Register</a>
@endif
@endauth
</div>
@endif
</button> --}}


<div class="container d-flex justify-content-center" style="margin-left:15%">
    <div class="row" style="width:">
        @if($posts->count())
        @foreach ($posts as $post)
        <div class="col-lg-7" style="margin-top: 50px; width: 600px;">
            <div class="card">
                <div class="card-body" style="display: flex; flex-direction: row; height: 70px; padding: 10px;">
                    <div>
                        <img class="img-responsive" src="{{ $post->user->profile->profileImage() }}"
                            style="border-radius:50%; width: 50px; height: 50px;">
                    </div>
                    <div style="margin-left: 15px;" data-post="{{$post->id}}">
                        <a href="/profile/{{$post->user->id}}"><strong>
                                <p>{{ $post->user->username }}</p>
                            </strong></a>
                        <p style="margin-top: -18px;"><time datetime="">{{ $post->created_at->format('jS F Y') }}</time>
                        </p>
                    </div>
                </div>
                <a href="/p/{{ $post->id }}"><img src="/storage/{{ $post->image }}" class="card-img-top"
                        style="max-height: 500px; "></a>

                <span class="pull-right" data-postnajib="{{$post->id}}">
                    <span class="impress-btn">
                        {{-- <button style="background-color:white; border:none"> <i style="font-size:20px; padding-top:10px"
                                id="like{{$post->id}}"
                        class="fa fa-heart {{ auth()->user()->hasLiked($post) ? 'like-post' : '' }}"></i>
                        </button> --}}
                        <a
                            class="btn btn-xs btn-danger like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You liked this post' : 'Like' : 'Like'  }}</a>

                    </span>
                    <div id="-bs3">{{ $post->likes()->where('like', '1')->count() }}</div>
                </span>


                {{-- <a href="{{route('like', $post_id = post_id)}}"></a>

                {{route('like', Auth::user())}} --}}





                <div class="card-body" style="height: 100px; display: block ruby; padding-top: inherit;">
                    <p class="card-text">
                        <a href="/profile/{{Auth::user()->id}}">
                            <p>{{ $post->user->username }}</p>
                        </a>
                        <p style="margin-bottom:300px">{{ $post->caption }}</p>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

{{-- <script type="text/javascript">
                $(document).ready(function() {     
            
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            
                    $('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){    
                        var id = $(this).parents(".panel").data('id');
                        var c = $('#'+this.id+'-bs3').html();
                        var cObjId = this.id;
                        var cObj = $(this);
            
                        // $.ajax({
                        //    type:'POST',
                        //    url:'/like',
                        //    data:{id:id},
                        //    success:function(data){
                        //       if(jQuery.isEmptyObject(data.success.attached)){
                        //         $('#'+cObjId+'-bs3').html(parseInt(c)-1);
                        //         $(cObj).removeClass("like-post");
                        //       }else{
                        //         $('#'+cObjId+'-bs3').html(parseInt(c)+1);
                        //         $(cObj).addClass("like-post");
                        //       }
                        //    }
                        // });
            
                    });      
            
                    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                        event.preventDefault();
                        $(this).ekkoLightbox();
                    });                                        
                }); 
            </script> --}}

@endsection

@section('script')
<script>
    // function test($id) {
    //     console.log('yes')
    //         var data = {post_id: $id};
    //         $.post(
    //             "http://127.0.0.1:8000/like",
    //             data,
    //         )
    //         .done(function(data){
    //             var test = $('#like'+$id+'-bs3');
    //             test.text(data);
    //         })
    //         .fail(function(data){
    //             alert("not sent");
    //         })
            
    //         }
        
        

        
</script>
@endsection