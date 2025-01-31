@extends('main.home')

@section('title', 'Newest posts')
@section('css-file')
    @vite('resources/css/main/post/list-post.css')
@endsection

@section('main-part')
    @php use Illuminate\Support\Str; @endphp

    @if (session('success'))
        <div class="success-message">
            <div class="success-content">
                <svg viewBox="0 0 24 24" class="check-icon">
                    <path fill="currentColor"
                        d="M20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.76,4 13.5,4.11 14.2,4.31L15.77,2.74C14.61,2.26 13.34,2 12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="error-message">
            <div class="error-content">
                <svg viewBox="0 0 24 24" class="error-icon">
                    <path fill="currentColor"
                        d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

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
                                <span>{{ $article->likeQuantity()->exists() ? $article->likeQuantity()->first()->quantity : 0 }}</span>
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
            @foreach ($latestArticles as $article)
                <div class="sub-card"
                    onclick="window.location.href='{{ route('article', ['slug' => Str::slug($article->title), 'id' => $article->id]) }}'">
                    <h2>{{ $article->title }}</h2>
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
                            <span>{{ $article->likeQuantity()->exists() ? $article->likeQuantity()->first()->quantity : 0 }}</span>
                        </span>
                    </div>
                    <span>{{ $article->author->username }}</span>
                </div>
            @endforeach

        </div>

    </div>

@endsection
