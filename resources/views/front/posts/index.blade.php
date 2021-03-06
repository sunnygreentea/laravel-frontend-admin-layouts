<div class="row">
    @if ( !$posts->count() )
    <div class="col-12">
        <p>There is no post till now. <a href="{{route('admin.posts.create')}}">Write a new post now!</a></p>
    </div>
    @else
    
    <div class="col-12">
        @foreach($posts as $post)
        <div class="list-group mb-3">
            <div class="list-group-item">
                
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <a href="{{route('front.posts.show', $post->id)}}"><h3>{{$post->title}}</h3></a>
                        <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ route('front.users.show', $post->author->id)}}">{{ $post->author->name }}</a></p>
                    </div>
                    <div class="col-12 col-sm-6">

                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->isAdmin()))
                        <a style="float:right;" class="ml-2" href="{{route('admin.posts.destroy', $post->id)}}"><button class="btn btn-warning">Delete Post</button>
                        @if($post->active == '1')
                        <a style="float:right;" href="{{route('admin.posts.edit', $post->id)}}"><button class="btn btn-info" >Edit Post</button></a>
                        @else
                        <a style="float:right;" href="{{route('admin.posts.edit', $post->id)}}"><button class="btn btn-info">Edit Draft</button></a>
                        @endif
                        
                    @endif
                
                    </div>
                </div>
                
            </div>
            <div class="list-group-item">
                <article>
                    {!! Str::limit($post->body, $limit = 1500, $end = '.......') !!}
                </article>
                <p><a href="{{route('front.posts.show', $post->id)}}">Read More</a></p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>