@foreach($comments as $comment)
    <div class="display-comment col-12" @if($comment->parent_id != null) style="margin-left:40px;" @endif style="margin-bottom:40px;">
        <strong style="margin-bottom:20px; font-weight:bold">{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>        @auth
        @if($comment->parent_id === null)
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group col-5">
                <input style="width:190px; " type="text" class="form-control " placeholder="Reply to {{ $comment->user->name }} ..." name="body">
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>            <div class="form-group">
                <input style="padding:10px" type="submit" class="btn btn-warning btn-round" value="Reply" />
            </div>
        </form>
        @endif
        @endauth
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>@endforeach