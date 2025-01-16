<x-home-page-layout :user="$user">

    {{-- {{ $user->name }}
    {{ $post->id_post }}
    {{ $post->post_caption }}

    <h1>test</h1> --}}

    <head>
        <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Imagic | Comment
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>

    <body>
        @if (session('success'))
            <div class="toast-success">
                <span class="toast-icon">&#10004;</span>
                <span class="toast-message">{{ session('success') }}</span>
                <span class="toast-close" onclick="closeToast()">&#10005;</span>
            </div>
        @endif

        <div class="container">

            <div class="header">

                <div class="username">
                    <a href="{{ route('profile', $post->user->id) }}" class="user-name"
                        style="text-decoration: none;">{{ $post->user->name }}</a>
                </div>
                <div class="options">
                    <span class="like-count">Posted {{ $post->created_at->diffForHumans() }}</span>

                </div>
            </div>
            @if ($post->post_image)
                <img src="{{ asset($post->post_image) }}" alt="Uploaded Image" class="image">
            @endif
            <div class="content">
                @php
                    $isLiked = $post->post_likes->contains('id_users', auth()->user()->id);
                @endphp
                <form action="{{ route('toggle-like') }}" method="POST" id="like-form-{{ $post->id_post }}"
                    style="margin-bottom: 20px">
                    @csrf
                    <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                    <form action="{{ route('toggle-like') }}" method="POST" id="like-form-{{ $post->id_post }}">
                        @csrf
                        <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                        <button type="button" class="action-btn like-btn {{ $isLiked ? 'active liked' : '' }}"
                            onclick="document.getElementById('like-form-{{ $post->id_post }}').submit();">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                    </form>

                </form>
                <p>
                    <strong>
                        {{ $post->user->name }}
                    </strong>
                    {!! nl2br(e($post->post_caption)) !!}
            </div>
            <div class="comments-container">
                <div class="comments">
                    @foreach ($comments as $comment)
                        <div class="comment">
                            <div class="text">
                                <span class="username">
                                    {{ $comment->user->name }} -
                                    <span class="created-at">{{ $comment->created_at->diffForHumans() }}</span>
                                </span>
                                {!! nl2br(e($comment->comment)) !!}
                            </div>
                        </div>
                        @if (!$loop->last)
                            <!-- Tampilkan <hr> kecuali untuk komentar terakhir -->
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="likes">
                <p class="like-count">
                    {{ $post->post_likes->count() }} Liked
                </p>
            </div>
            <form action="/commented" method="POST">
                @csrf
                <div class="add-comment">
                    <input placeholder="Add a comment..." type="text" name="comment">
                    <input type="text" name="id_post" value="{{ $post->id_post }}" hidden>
                    <input type="text" name="id_user" value="{{ $user->id }}" hidden>
                    <button type="submit">
                        Post
                    </button>
                </div>
            </form>

        </div>
    </body>
    <script src="{{ asset('js/home.js') }}"></script>

    </html>

</x-home-page-layout>
