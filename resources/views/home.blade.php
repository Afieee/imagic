<x-home-page-layout :user="$user">

    <head>
        <!-- Link CSS -->
        <title>Imagic | Home</title>
        <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>

    @if (session('success'))
        <div class="toast-success">
            <span class="toast-icon">&#10004;</span>
            <span class="toast-message">{{ session('success') }}</span>
            <span class="toast-close" onclick="closeToast()">&#10005;</span>
        </div>
    @endif

    <div class="post-container">
        @foreach ($postingan as $item)
            <div class="post-card">
                <div class="post-user-profile">
                    <a href="{{ route('profile', $item->user->id) }}" class="user-name" style="text-decoration: none;">
                        {{ $item->user->name }}
                        @if ($item->user->premium == 'Premium')
                            <i class="fas fa-star" style="color: gold; margin-left: 5px;"
                                title="{{ $item->user->name }} Adalah User Premium"></i>
                        @endif
                    </a>

                </div>

                <div class="post-image">
                    @if ($item->post_image)
                        <img src="{{ asset($item->post_image) }}" alt="Uploaded Image"
                            title="Size : {{ $item->post_image_file_size }} | Extension : {{ $item->post_image_extension }} | Pixel : {{ $item->post_image_size }} ">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                </div>

                <div class="post-actions">
                    @php
                        $isLiked = $item->post_likes->contains('id_users', auth()->user()->id);
                    @endphp

                    <form action="{{ route('toggle-like') }}" method="POST" id="like-form-{{ $item->id_post }}">
                        @csrf
                        <input type="hidden" name="id_post" value="{{ $item->id_post }}">
                        <button type="button" class="action-btn like-btn {{ $isLiked ? 'active liked' : '' }}"
                            onclick="document.getElementById('like-form-{{ $item->id_post }}').submit();">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                    </form>
                    <a href="{{ route('comment', $item->id_post) }}" style="text-decoration: none">

                        <button class="action-btn comment-btn">

                            <i class="fas fa-comment"></i>
                        </button>
                    </a>
                </div>

                <div class="post-content">
                    <span class="like-count">Liked by <strong>{{ $item->post_likes->count() }}</strong> others</span>

                    Posted {{ $item->created_at->diffForHumans() }}
                    <hr>
                    <p class="post-description">{!! nl2br(e($item->post_caption)) !!}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Link JavaScript -->
    <script>
        function closeToast() {
            document.querySelector('.toast-success').style.display = 'none';
        }
    </script>
    <script src="{{ asset('js/home.js') }}"></script>
</x-home-page-layout>
