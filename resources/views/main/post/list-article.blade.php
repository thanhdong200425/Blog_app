@extends('main.home')

@section('title', 'Newest posts')
@section('css-file')
    @vite('resources/css/main/post/list-post.css')
@endsection

@section('main-part')
    @php use Illuminate\Support\Str; @endphp
    <div class="main-container">
        <div class="column left">
            @foreach ($articles as $article)
                <div class="card"
                    onclick="window.location.href='{{ route('article', ['slug' => Str::slug($article->title), 'id' => $article->id]) }}'">
                    {{-- Avatar --}}
                    <div class="avatar">
                        <img src="{{ $article->author->image_url }}" />
                    </div>

                    {{-- Content --}}
                    <div class="content">
                        {{-- Top --}}
                        <div class="top-content">
                            <p>{{ $article->author->username }}
                                <span>{{ $article->created_at->diffForHumans() }}</span>
                                <span>
                                    <img src="/icons/url-icon.svg" alt="url copy" />
                                </span>
                            </p>
                        </div>

                        {{-- Middle --}}
                        <h2>{{ $article->title }}</h2>

                        {{-- Bottom --}}
                        <div class="bottom-content">
                            <span class="eye">
                                <img src="/icons/eye-icon.svg" />
                                <span>2</span>
                            </span>

                            <span class="bookmark">
                                <img src="/icons/bookmark-icon.svg" />
                                <span>2</span>
                            </span>

                            <span class="bubble-chat">
                                <img src="/icons/bubble-chat-icon.svg" />
                                <span>2</span>
                            </span>
                            <span class="up-and-down">
                                <img src="/icons/up-and-down-icon.svg" />
                                <span>1</span>
                            </span>
                        </div>


                    </div>
                </div>
            @endforeach
            <div class="pagination">
                {{ $articles->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <div class="column right">
            <p>Newest questions <span></span></p>
            @foreach ($latestPosts as $post)
                <div class="sub-card">
                    <h2>{{ $post->title }}</h2>
                    <div class="bottom-content">
                        <span class="eye">
                            <img src="/icons/eye-icon.svg" />
                            <span>2</span>
                        </span>
                        <span class="bookmark">
                            <img src="/icons/bookmark-icon.svg" />
                            <span>2</span>
                        </span>
                        <span class="bubble-chat">
                            <img src="/icons/bubble-chat-icon.svg" />
                            <span>2</span>
                        </span>
                        <span class="up-and-down">
                            <img src="/icons/up-and-down-icon.svg" />
                            <span>1</span>
                        </span>
                    </div>
                    <span>{{ $post->author->username }}</span>
                </div>
            @endforeach

        </div>

    </div>

@endsection
