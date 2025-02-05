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
        <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">
        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&family=Nunito:wght@300;400;600&family=Raleway:wght@300;400;600&family=Josefin+Sans:wght@300;400;600&display=swap"
            rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>
    <style>
        textarea {
            width: 100%;
            min-height: 20px;
            max-height: 80px;
            resize: none;
            overflow-y: auto;
            border: 1px solid white;
            padding: 5px;
            font-size: 14px;
            border-radius: 5px;
            outline: none;
        }

        textarea:focus {
            border-color: black;
        }
    </style>

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

                <div class="likes">
                    <p class="like-count">
                        Liked by <strong
                            style="font-weight: 900; font-size: 1.0em; color: #555;">{{ $post->post_likes->count() }}</strong>
                        Other </p>
                </div>
                <p>

                    <strong>
                        {{ $post->user->name }} :
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
            {{-- <div class="likes">
                <p class="like-count">
                    {{ $post->post_likes->count() }} Liked
                </p>
            </div> --}}
            <form action="/commented" method="POST">
                @csrf
                <div class="add-comment">
                    <textarea placeholder="Add a comment..." name="comment" oninput="autoResize(this)"></textarea>
                    <input type="text" name="id_post" value="{{ $post->id_post }}" hidden>
                    <input type="text" name="id_user" value="{{ $user->id }}" hidden>
                    <button type="submit" style="color:rgb(204,0,31);">
                        Post
                    </button>
                </div>
            </form>

        </div>
    </body>
    <script src="{{ asset('js/home.js') }}"></script>

    </html>
    <script>
        function autoResize(element) {
            element.style.height = "40px";
            element.style.height = element.scrollHeight + "px";
        }
    </script>
</x-home-page-layout>
