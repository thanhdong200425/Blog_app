@extends('main.home')

@section('title', 'Post')
@section('css-file')
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite('resources/css/main/post/post.css')
@endsection

@section('main-part')
    <div class="main-container">
        <div class="post-action-container">
            <div class="votes">
                <span
                    class="upvote {{ $article->likes()->exists() && $article->likes()->where('user_id', Auth::id())->exists() ? 'active' : '' }}"
                    data-entity-id="{{ $article->id }}" data-url="{{ route('like') }}">
                    <img src="{{ asset('icons/upvote-icon.svg') }}" alt="upvote icon" />
                </span>
                <span
                    class="figure {{ $article->likes()->exists() && $article->likes()->where('user_id', Auth::id())->exists() ? 'active' : '' }}">{{ $article->likeQuantity()->exists() ? $article->likeQuantity()->first()->quantity : 0 }}</span>
                <span class="downvote" data-entity-id="{{ $article->id }}" data-url="{{ route('unlike') }}">
                    <img src="{{ asset('icons/downvote-icon.svg') }}" alt="downvote icon" />
                </span>
            </div>

            <div class="bookmark">
                <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="Bookmark icon" />
            </div>

            <div class="shares">
                <span class="facebook">
                    <img src="{{ asset('icons/facebook-icon.svg') }}" alt="facebook icon" />
                </span>
            </div>
        </div>
        <div class="article-container">
            <div class="left-side">
                <article>
                    <div class="header">
                        <div class="author">
                            <div class="avatar">
                                <img src="{{ $article->author->image_url }}" alt="avatar image" />
                            </div>
                            <div class="title">
                                <div class="author-name">
                                    <p>{{ $article->author->first_name }} {{ $article->author->last_name }}</p>
                                    <span>@ {{ $article->author->username }}</span>
                                </div>
                                <div class="author-statistical">
                                    <span class="star">
                                        <img src="{{ asset('icons/star-icon.svg') }}" alt="star icon" />1.5K
                                    </span>
                                    <span class="followers">
                                        <img src="{{ asset('icons/follower-icon.svg') }}" alt="follower icon" />
                                        52
                                    </span>
                                    <span class="articles">
                                        <img src="{{ asset('icons/article-icon.svg') }}" alt="article icon" />
                                        52
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <p>Created at {{ $article->created_at->format('M jS, Y h:i A') }}</p>
                            <div class="article-statistical">
                                @if (Auth::user()->id == $article->author->id)
                                    <form method="post" action="{{ route('deleteArticle') }}" id="delete-form-article">
                                        @csrf
                                        <input type="hidden" name="articleId" value="{{ $article->id }}" />
                                        <input type="hidden" name="isOwner" value="true" />
                                        <span>
                                            <img src="{{ asset('icons/delete-icon.svg') }}" alt="delete icon"
                                                class="delete-action" />
                                        </span>
                                    </form>
                                    <span
                                        onclick="window.location.href = '{{ route('updateArticle', ['slug' => Str::slug($article->title), 'id' => $article->id]) }}'">
                                        <img src="{{ asset('icons/update-icon.svg') }}" alt="update icon" />
                                    </span>
                                @endif

                                <span class="eye">
                                    <img src="{{ asset('icons/eye-icon.svg') }}" alt="read icon" />6.8K
                                </span>
                                <span class="comment">
                                    <img src="{{ asset('icons/comment-icon.svg') }}" alt="comment icon" />3
                                </span>
                                <span class="bookmark-icon">
                                    <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="bookmark icon" />14
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        {!! \Illuminate\Support\Str::markdown($article->content) !!}
                    </div>
                </article>
            </div>
            <div class="right-side">
                <div class="table-of-contents">
                    <h3>Table of Contents</h3>
                    <div class="toc-list">
                        <a href="#" class="toc-item active">
                            <span class="number">01</span>
                            <span class="text">Building Modern Web Applications with Laravel and Vue.js</span>
                        </a>
                        <a href="#" class="toc-item">
                            <span class="number">02</span>
                            <span class="text">Getting Started</span>
                        </a>
                        <a href="#" class="toc-item">
                            <span class="number">03</span>
                            <span class="text">Setting Up Laravel</span>
                        </a>
                        <a href="#" class="toc-item">
                            <span class="number">04</span>
                            <span class="text">Adding Vue.js</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="comment-container">
        <div class="comment-wrapper">
            <div class="comment-header">
                <h3>Comments (24)</h3>
                <div class="comment-sort">
                    <button class="sort-btn active">Top</button>
                    <button class="sort-btn">Latest</button>
                </div>
            </div>

            {{-- Comment input part --}}
            <div class="comment-input">
                <div class="user-avatar">
                    <img src="https://picsum.photos/200/200" alt="User avatar" />
                </div>
                <div class="input-wrapper">
                    <textarea placeholder="Write a comment..." name="content" id="content" required></textarea>
                    <input type="hidden" name="article_id" value="{{ $article->id }}" />
                    <input type="hidden" name="url" value="{{ route('comment') }}" />
                    <div class="input-actions">
                        <button class="cancel-btn">Cancel</button>
                        <button class="submit-btn">Comment</button>
                    </div>
                </div>
            </div>


            <div class="comments-list">
                @foreach ($article->comments as $comment)
                    @php
                        $numberOfDots = substr_count($comment->path, '.');
                    @endphp
                    <div class="comment-item" style="margin-left: {{ ($numberOfDots >= 3 ? 3 : $numberOfDots) * 60 }}px"
                        data-id="{{ $comment->id }}">
                        <div class="comment-user">
                            <img src="{{ $comment->author->image_url }}" alt="Commenter avatar" />
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <div class="user-info">
                                    <h4>{{ $comment->author->username }}</h4>
                                    <span class="time">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-actions">
                                    <button class="action-btn">
                                        <img src="{{ asset('icons/dots-icon.svg') }}" alt="More actions" />
                                    </button>
                                </div>
                            </div>
                            <p>{{ $comment->content }}</p>
                            <div class="comment-footer">
                                <div class="reactions">
                                    <button class="reaction-btn">
                                        <img src="{{ asset('icons/like-icon.svg') }}" alt="Like" />
                                        <span>24</span>
                                    </button>
                                    <button class="reaction-btn reply-trigger">
                                        <img src="{{ asset('icons/reply-icon.svg') }}" alt="Reply" />
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </div>
                            <div class="reply-section">
                                <div class="reply-input-wrapper">
                                    <div class="user-avatar">
                                        <img src="{{ Auth::user()->image_url }}" alt="Your avatar" />
                                    </div>
                                    <div class="reply-content">
                                        <textarea placeholder="Write a reply..."></textarea>
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                        <div class="reply-actions">
                                            <button class="reply-cancel">Cancel</button>
                                            <button class="reply-submit">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/article.js')
@endsection
