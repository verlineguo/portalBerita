@extends('visitor.layouts.app')

@section('Visitor_page_title')
    Posts tagged with "{{ $tag->name }}" - News Portal
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Posts Tagged with "{{ $tag->name }}"</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                    <div class="post-item mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                @else
                                <img src="{{ asset('frontend/assets/img/news/whatNews1.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3><a href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a></h3>
                                <div class="post-meta">
                                    <span>{{ $post->category->name }}</span>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    <span>{{ $post->views }} Views</span>
                                </div>
                                <p>{{ Str::limit(strip_tags($post->description), 150) }}</p>
                                <a href="{{ route('visitor.post.details', $post->slug) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="pagination-wrapper">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        No posts found with this tag.
                    </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="categories-widget mb-5">
                    <h4>Categories</h4>
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{ route('visitor.category', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular posts -->
                <div class="popular-posts-widget mb-5">
                    <h4>Popular Posts</h4>
                    @foreach ($popularPosts as $popularPost)
                        <div class="media mb-3">
                            <img src="{{ asset('frontend/assets/img/news/right' . $loop->iteration . '.jpg') }}" class="mr-3" alt="{{ $popularPost->title }}" style="width: 80px;">
                            <div class="media-body">
                                <h6><a href="{{ route('visitor.post.details', $popularPost->slug) }}">{{ $popularPost->title }}</a></h6>
                                <p class="text-muted">{{ $popularPost->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Social follow -->
                <div class="social-follow-widget mb-5">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-fb.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-tw.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-ins.png') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-yo.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection