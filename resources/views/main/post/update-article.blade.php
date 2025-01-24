@extends('main.home')

@section('title', 'Update Article')
@section('css-file')
    @vite('resources/css/main/asking.css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/44.1.0/ckeditor5-premium-features.css"
        crossorigin>
@endsection

@section('main-part')
    <div class="main-container modern">
        <div class="editor-wrapper">
            <form method="POST" id="post-form" action="{{ route('saveArticle') }}">
                @csrf
                <input type="hidden" name="articleId" value="{{ $article->id }}" />
                <div class="article-title">
                    <div class="title-input-wrapper">
                        <input type="text" name="title" id="article-title" required class="title-input"
                            value="{{ $article->title }}">
                        <label for="article-title" class="title-label">Title of your article</label>
                    </div>
                </div>
                <div class="editor-container modern-editor" id="editor-container">
                    <div class="editor-container__editor">
                        <div id="editor">{{ $article->content }}</div>
                    </div>
                    <div class="editor_container__word-count" id="editor-word-count"></div>
                </div>
                <div class="submit-container">
                    <button type="button" class="cancel-button" onclick="history.back()">
                        <span>Cancel</span>
                    </button>
                    <button type="submit" class="submit-button" id="submit-button">
                        <span>Update Post</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js" crossorigin></script>
    <script src="https://cdn.ckeditor.com/ckeditor5-premium-features/44.1.0/ckeditor5-premium-features.umd.js" crossorigin>
    </script>
    <script src="https://cdn.ckbox.io/ckbox/2.6.1/ckbox.js" crossorigin></script>
    @vite('resources/js/ask.js')
@endsection
