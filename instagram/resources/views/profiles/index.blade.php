@extends('layouts.app')

@section('content')



        <header>

                <div class="container " >
            
                    <div class="profile">
            
                        <div class="profile-image">
            
                            <img style="width:150px; height:150px; margin-bottom:28%" src="{{$user->profile->profileImage()}}" alt="">
            
                        </div>
            
                        <div class="profile-user-settings">
                            <div class="row d-flex">
            
                            <div style="margin-right:50px" class="profile-user-name h1">{{$user->username}}</div>

                            @cannot('update', $user->profile)
                                @auth
                                {{-- <form action="{{ route('user.follow',$user->id)}}" method="POST">
                                    @csrf --}}
                                    <button style="width:130px; height:30px; margin-top:40px" class="btn btn-primary btn-sm action-follow ml-5" data-id="{{ $user->id }}"><strong id="follow">
                                        
                                            @if(auth()->user()->isFollowing($user))
                            
                                            UnFollow
                            
                                        @else
                            
                                            Follow
                            
                                        @endif    
                                    </strong>
                                    </button>
                                {{-- </form> --}}

                                           
                            
                                        
                                    
                                @endauth

                                @guest
                                    
                                @endguest
                            


                                @endcannot

                            @can('update', $user->profile)
                            
                            <a class="btn btn-outline-default d-flex justify-content-center align-items-center" style="text-decoration: none; padding:20px; " href="/p/create">Add New Post </a>
                                
                                
                            
                            
                            <a  class=" btn  btn-outline-default d-flex justify-content-center align-items-center" style="text-decoration: none; padding:20px" href="/profile/{{$user->id}}/edit">Edit Profile</a>
                                
                             

                           


                            {{-- Modal "Pop up" --}}


        <a class="uk-button uk-button-default " style="margin-left:200px; height:40px" href="#modal-center" uk-toggle>Edit User Parametres</a>

   <div id="modal-center" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>


    <form action="{{route('user.update', Auth::user())}}" class="uk-form-stacked" method="POST">

        @csrf
        @method('PATCH')

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Name</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="name" id="form-stacked-text" type="text" value="{{$user->name}}">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input"  name="username" id="form-stacked-text" type="text" value="{{$user->username}}">
                </div>
            </div>

            <button type="submit" style="" class="uk-button uk-button-default">Submit</button>
        
            
        
     </form>

        


    </div>
</div>

  {{-- Modal "Pop up" --}}

                                
                            @endcan
                        
                            </div>
                        </div>
            
                        <div class="px profile-stats mt-4">
            
                            
                          
                            <div class="nav " id="nav-tab" role="tablist">

                                <a  class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab" href="#followers" role="tab" aria-controls="nav-home" aria-selected="true">Posts <span class="badge badge-primary">{{ $user->posts->count() }}</span></a>
        

                                <a data-toggle="modal" data-target="#followersModal"  class="nav-item nav-link active text-dark" id="nav-home-tab" data-toggle="tab" href="#followers" role="tab" aria-controls="nav-home" aria-selected="true">Followers <span class="badge badge-primary">{{ $user->followers()->get()->count() }}</span></a>
        
                                {{-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa modal --}}

                                <!-- Modal -->
                                <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 style="padding-left: 43%"  class="modal-title" id="exampleModalLabel">Abonnés</h5>
                                        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span style="font-size:20px" aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($followers as $followers)
                                                <a href="/profile/{{$followers->id}}" class="text-decoration-none row mt-2 mb-2">
                                                    <img style="height:40px; width:40px; border-radius:50%" src="{{$followers->profile->profileImage()}}" alt="">
                                                    <div  class=" column mt-1">
                                                        <div class="ml-2 text-dark">{{$followers->name}}</div>
                                                        <div class="ml-2 text-dark">{{$followers->username}}</div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>

                            {{-- bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb modal --}}

                                <a data-toggle="modal" data-target="#followingModal" class="nav-item nav-link text-dark" id="nav-profile-tab" data-toggle="tab" href="#following" role="tab" aria-controls="nav-profile" aria-selected="false">Following <span class="badge badge-primary">{{ $user->followings()->get()->count() }}</span></a>
        
                                {{-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa modal --}}

                                <!-- Modal -->
                                    <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 style="padding-left: 43%" class="modal-title" id="exampleModalLabel">Abonnements</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span style="font-size:20px" aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                    @foreach ($following as $following)
                                                    <a href="/profile/{{$following->id}}" class="text-decoration-none row mt-2 mb-2">
                                                        <img style="height:40px; width:40px; border-radius:50%" src="{{$following->profile->profileImage()}}" alt="">
                                                        <div  class=" column mt-1">
                                                            <div class="ml-2 text-dark">{{$following->name}}</div>
                                                            <div class="ml-2 text-dark">{{$following->username}}</div>
                                                        </div>
                                                    </a>
                                                    @endforeach
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>

                                {{-- bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb modal --}}
                               
                            
                            </div> 
                           
            
                        </div>
            
                        <div style="margin-left:-2%" class="px profile-bio ">
            
                            <p><span class="profile-real-name">{{ $user->profile->title }}</span> {{$user->profile->description}}</p>
                           
                            <hr>
                            <div><a href="#">{{$user->profile->url}}</a></div>
            
                        </div>
            
                    </div>
                    <!-- End of profile section -->
            
                </div>
                <!-- End of container -->
            
            </header>
            
            <main>
            
                <div class="container" style="width:975px; margin:auto">
            
                    <div class="row pt-5">

                        @foreach($user->posts as $post)

                        <div class="col-lg-4 pb-4 " tabindex="0">

                        <a href="/p/{{$post->id}}">
            
                        <img src="/storage/{{$post->image}}" class="gallery-image " style="width:293px !important; height: 293px !important" alt="">
                
                        </a>
                        
                        <div class="gallery-item-info ">
                
                                    <ul  style="margin-right: 10%;">
                                        <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart " aria-hidden="true"></i> 56</li>
                                        <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
                                    </ul>
                
                                </div>
                
                        </div>


                        @endforeach
            
                        
            
                    
                    </div>
                    <!-- End of gallery -->
            
                    {{-- <div class="loader"></div> --}}
            
                </div>
                <!-- End of container -->
            
            </main>


            
    

@endsection
