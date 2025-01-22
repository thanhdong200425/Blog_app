@extends('main.home')

@section('title', 'Asking question')
@section('css-file')
    @vite('resources/css/main/asking.css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/44.1.0/ckeditor5-premium-features.css"
        crossorigin>
@endsection

@section('main-part')
    <div class="main-container modern">
        <div class="editor-wrapper">
            <form method="POST" id="post-form">
                @csrf
                <div class="editor-container modern-editor" id="editor-container">
                    <div class="editor-container__editor">
                        <div id="editor"></div>
                    </div>
                    <div class="editor_container__word-count" id="editor-word-count"></div>
                </div>
                <div class="submit-container">
                    <button type="submit" class="submit-button">
                        <span>Publish Post</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
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
