@extends('main.home')

@section('title', 'Profile')
@section('css-file')
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite('resources/css/main/user/update-profile.css')
@endsection

@section('main-part')
    <div class="profile-container">
        <h1>Update Profile</h1>
        <form action="{{ route('saveProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="image-upload">
                <div class="preview">
                    <img src="{{ $user->image_url }}" alt="Profile picture" id="preview-image">
                </div>
                <input type="file" name="image_url" id="image_url" accept="image/*">
                <label for="image_url" class="upload-label">Choose Image</label>
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $user->date_of_birth }}">
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/updateProfile.js')
@endsection
