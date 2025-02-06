@extends('main.home')

@section('title', 'Profile')
@section('css-file')
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite('resources/css/main/user/profile.css')
@endsection

@section('main-part')
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

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ $user->image_url }}" alt="Profile Avatar">
            </div>
            <div class="profile-info">
                <div class="profile-header-top">
                    <h1>{{ $user->first_name && $user->last_name ? "{$user->first_name} {$user->last_name}" : $user->username }}
                    </h1>
                    <button class="edit-profile-btn" onclick="window.location.href='{{ route('updateProfile') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                        </svg>
                        Edit Profile
                    </button>
                </div>
                <p class="bio">Senior Software Engineer | Tech Blogger | Coffee Enthusiast</p>
                <div class="stats">
                    <div class="stat-item">
                        <span class="number">{{ $user->articles->count() }}</span>
                        <span class="label">Articles</span>
                    </div>
                    <div class="stat-item">
                        <span class="number">1.2k</span>
                        <span class="label">Followers</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="articles-section">
            <h2>Published Articles</h2>
            <div class="articles-grid">
                @foreach ($articles as $article)
                    @php
                        preg_match('/\!\[\]\((.*?)\)/', $article->content, $matches);
                    @endphp
                    <article class="article-card"
                        onclick="window.location.href='{{ route('article', ['slug' => Str::slug($article->title), 'id' => $article->id]) }}'">
                        <img src="{{ $matches[1] ?? 'https://picsum.photos/200/300' }}" alt="Article thumbnail">
                        <div class="article-content">
                            <h3>{{ $article->title }}</h3>
                            <div class="article-meta">
                                <span class="date">{{ $article->created_at->diffForHumans() }}</span>
                                <span class="read-time">5 min read</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
