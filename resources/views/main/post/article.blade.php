@extends('main.home')

@section('title', 'Post')
@section('css-file')
    @vite('resources/css/main/post/post.css')
@endsection

@section('main-part')
    <div class="main-container">
        <div class="post-action-container">
            {{-- <div class="avatar-author">
                <img src="https://picsum.photos/200/300" alt="author-image" />
            </div> --}}
            <div class="votes">
                <span class="upvote">
                    <img src="{{ asset('icons/upvote-icon.svg') }}" alt="upvote icon" />
                </span>
                <span class="figure">+100</span>
                <span class="downvote">
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
                                <img src="https://picsum.photos/200/300" alt="avatar image" />
                            </div>
                            <div class="title">
                                <div class="author-name">
                                    <p>Nguyen Van Duong</p>
                                    <span>@nguyen.van.duong</span>
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
                            <p>Created at Jan 22nd, 2025 11:10 AM</p>
                            <div class="article-statistical">
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
                        <h1>Building Modern Web Applications with Laravel and Vue.js</h1>

                        <p class="article-summary">
                            Learn how to create powerful web applications by combining Laravel's robust backend with
                            Vue.js's reactive frontend. This guide covers everything from setup to deployment.
                        </p>

                        <img src="https://picsum.photos/1000/400" alt="Cover image" class="cover-image" />

                        <h2>Getting Started</h2>
                        <p>
                            Before we dive into the development process, make sure you have the following prerequisites
                            installed on your system:
                        </p>

                        <ul>
                            <li>PHP 8.1 or higher</li>
                            <li>Composer</li>
                            <li>Node.js and npm</li>
                            <li>Git</li>
                        </ul>

                        <h2>Setting Up Laravel</h2>
                        <p>
                            First, let's create a new Laravel project using Composer. Open your terminal and run:
                        </p>

                        <div class="code-block">
                            <div class="code-header">
                                <span>Terminal</span>
                                <button class="copy-btn">Copy</button>
                            </div>
                            <pre><code>composer create-project laravel/laravel example-app
cd example-app
php artisan serve</code></pre>
                        </div>

                        <h2>Adding Vue.js</h2>
                        <p>
                            Next, we'll integrate Vue.js into our Laravel application. This will give us the reactive
                            frontend capabilities we need.
                        </p>

                        <div class="info-box">
                            <img src="{{ asset('icons/info-icon.svg') }}" alt="Info icon" />
                            <p>
                                Make sure you're using Vue.js 3 for the latest features and best performance.
                            </p>
                        </div>

                        <img src="https://picsum.photos/1000/500" alt="Architecture diagram" class="content-image" />

                        <p>
                            The image above shows the basic architecture of our application. Laravel handles the backend API
                            and authentication, while Vue.js manages the frontend state and user interface.
                        </p>
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

            <div class="comment-input">
                <div class="user-avatar">
                    <img src="https://picsum.photos/200/200" alt="User avatar" />
                </div>
                <div class="input-wrapper">
                    <textarea placeholder="Write a comment..."></textarea>
                    <div class="input-actions">
                        <button class="cancel-btn">Cancel</button>
                        <button class="submit-btn">Comment</button>
                    </div>
                </div>
            </div>

            <div class="comments-list">
                <!-- Comment Item -->
                <div class="comment-item">
                    <div class="comment-user">
                        <img src="https://picsum.photos/200/200" alt="Commenter avatar" />
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="user-info">
                                <h4>John Doe</h4>
                                <span class="time">2 hours ago</span>
                            </div>
                            <div class="comment-actions">
                                <button class="action-btn">
                                    <img src="{{ asset('icons/dots-icon.svg') }}" alt="More actions" />
                                </button>
                            </div>
                        </div>
                        <p>This is a great article! The explanation about Laravel and Vue.js integration is very clear and
                            helpful.</p>
                        <div class="comment-footer">
                            <div class="reactions">
                                <button class="reaction-btn">
                                    <img src="{{ asset('icons/like-icon.svg') }}" alt="Like" />
                                    <span>24</span>
                                </button>
                                <button class="reaction-btn">
                                    <img src="{{ asset('icons/reply-icon.svg') }}" alt="Reply" />
                                    <span>Reply</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nested Comment -->
                <div class="comment-item nested">
                    <div class="comment-user">
                        <img src="https://picsum.photos/200/201" alt="Commenter avatar" />
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="user-info">
                                <h4>Jane Smith</h4>
                                <span class="time">1 hour ago</span>
                            </div>
                            <div class="comment-actions">
                                <button class="action-btn">
                                    <img src="{{ asset('icons/dots-icon.svg') }}" alt="More actions" />
                                </button>
                            </div>
                        </div>
                        <p>Agreed! Especially the part about Vue.js 3 features.</p>
                        <div class="comment-footer">
                            <div class="reactions">
                                <button class="reaction-btn">
                                    <img src="{{ asset('icons/like-icon.svg') }}" alt="Like" />
                                    <span>12</span>
                                </button>
                                <button class="reaction-btn">
                                    <img src="{{ asset('icons/reply-icon.svg') }}" alt="Reply" />
                                    <span>Reply</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
