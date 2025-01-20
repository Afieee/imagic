<x-home-page-layout :user="$user">

    <head>
        <title>Imagic | Upload</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    </head>
    <style>

    </style>
    <div class="upload-container">
        <h1 class="upload-title"> Upload Your Creativity </h1>
        @if (session('success'))
            <div class="toast-success">
                <span class="toast-icon">&#10004;</span>
                <span class="toast-message">{{ session('success') }}</span>
                <span class="toast-close" onclick="closeToast()">&#10005;</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="error-message">
                <p>{{ $errors->first('error') }}</p>
            </div>
        @endif

        <form action="{{ route('image.process') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf


            <div class="form-group">
                <label for="image">Select Image:</label>
                <div class="file-input-wrapper">
                    <input type="file" name="image" id="image" accept="image/*" required
                        onchange="previewImage(event)" style="display: none;">
                    <button type="button" class="file-upload-btn"
                        onclick="document.getElementById('image').click()">Choose Image</button>
                </div>
                <div class="image-preview" id="imagePreview"></div>
            </div>

            <div class="form-group">
                <label for="watermark">Select Watermark Image:</label>
                <div class="file-input-wrapper">
                    <input type="file" name="watermark" id="watermark" accept="image/*"
                        onchange="previewImage(event)">
                    <button type="button" class="file-upload-btn"
                        onclick="document.getElementById('watermark').click()">Choose Watermark</button>
                </div>
                <div class="image-preview" id="watermarkPreview"></div>
            </div>

            <div class="form-group">
                <label for="caption">Caption:</label>
                <textarea id="post_caption" name="caption" cols="130" rows="10" placeholder="Write something creative..."></textarea>
            </div>

            <button type="submit" class="upload-button">UPLOAD</button>
        </form>
    </div>
    <script src="{{ asset('js/upload-preview.js') }}"></script>
    <script></script>
</x-home-page-layout>
