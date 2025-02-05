<x-profile-page-layout :user="$user">

    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Imagic | Profile
        </title>
        <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile_header.css') }}">
        <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">
        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&family=Nunito:wght@300;400;600&family=Raleway:wght@300;400;600&family=Josefin+Sans:wght@300;400;600&display=swap"
            rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;

            width: 100%;
        }

        .profile-header {
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            text-align: center;
            width: 100%;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .profile-header h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        .profile-header p {
            color: #666;
            margin: 5px 0;
        }

        .profile-header .follow-btn,
        .profile-header .message-btn {
            background-color: #e60023;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 10px 5px;
            border-radius: 20px;
            cursor: pointer;
        }

        .profile-header .message-btn {
            background-color: #ddd;
            color: #333;
        }

        .profile-header .stats {
            color: #666;
            margin: 10px 0;
        }

        .profile-header .website {
            color: #000;
            text-decoration: none;
        }

        .profile-header .website:hover {
            text-decoration: none;
        }

        .cover-photo {
            width: 100%;
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .cover-photo .post-container {
            width: 90%;
            max-width: 800px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery .item {
                width: 45%;
            }
        }

        @media (max-width: 480px) {
            .gallery .item {
                width: 100%;
            }
        }

        .like-btn i {
            color: gray;
        }

        .like-btn.liked {
            background-color: #d3d3d3;
        }

        .like-btn.liked i {
            color: #cc001f;
        }

        .like-btn.active {
            background-color: #d3d3d3;
            color: #cc001f;
        }

        .like-btn.active i {
            color: #cc001f;
        }

        .comment-btn i {
            color: orange;
        }

        .comment-count:hover {
            text-decoration: underline;
        }
    </style>

    <body>
        <div class="container">
            <div class="profile-header">
                <img alt="Profile Picture" height="100"
                    src="https://storage.googleapis.com/a1aa/image/85CMLozD2X5YLN91mP0pdSJpyFcrrfevqr8mKf5hgOfhfNVgC.jpg"
                    width="100" />
                <h1>{{ $postingan->first()->user->name ?? $user->name }}</h1>
                <div>{{ $postingan->first()->user->bio }}</div>
                <div class="stats">
                    <span>
                        <span id="jumlah-follower">{{ $jumlahFollower }}</span> Followers
                    </span>
                </div>
                <p class="website">
                    Work Contact: {{ $postingan->first()->user->email ?? $user->email }}
                </p>
                <div>
                    @if (auth()->user()->id !== ($postingan->first()->user->id ?? $user->id))
                        <button class="follow-btn" id="follow-button"
                            data-user-id="{{ $postingan->first()->user->id ?? $user->id }}">
                            {{ auth()->user()->isFollowing($postingan->first()->user->id)? 'Berhenti Mengikuti': 'Ikuti' }}
                        </button>
                    @endif
                </div>
            </div>

            <div class="cover-photo">
                <div class="post-container">
                    @foreach ($postingan as $item)
                        <div class="post-card">
                            <div class="post-user-profile">
                                <a href="{{ route('profile', $item->user->id) }}" class="user-name"
                                    style="text-decoration: none;">{{ $item->user->name }}</a>
                            </div>

                            <div class="post-image">
                                @if ($item->post_image)
                                    <img src="{{ asset($item->post_image) }}" alt="Uploaded Image">
                                @else
                                    <div class="no-image">No Image</div>
                                @endif
                            </div>

                            <div class="post-actions">
                                @php
                                    $isLiked = $item->post_likes->contains('id_users', auth()->user()->id);
                                @endphp

                                <form action="{{ route('toggle-like') }}" method="POST"
                                    id="like-form-{{ $item->id_post }}">
                                    @csrf
                                    <input type="hidden" name="id_post" value="{{ $item->id_post }}">
                                    <button type="button"
                                        class="action-btn like-btn {{ $isLiked ? 'active liked' : '' }}"
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
                                <p class="like-count" id="like-count-{{ $item->id_post }}">
                                    Liked by <strong>{{ $item->post_likes->count() }}</strong> others
                                </p>
                                @if ($item->comment->count() == 1)
                                    <a href="{{ route('comment', $item->id_post) }}" style="text-decoration: none">
                                        <span class="like-count comment-count">
                                            View <strong style="font-weight: 900; font-size: 1.0em; color: #555;">
                                                {{ $item->comment->count() }}
                                            </strong> Comment
                                        </span>
                                    </a>
                                @elseif ($item->comment->count() > 1)
                                    <a href="{{ route('comment', $item->id_post) }}" style="text-decoration: none">
                                        <span class="like-count comment-count">
                                            View all <strong style="font-weight: 900; font-size: 1.0em; color: #555;">
                                                {{ $item->comment->count() }}
                                            </strong> Comments
                                        </span>
                                    </a>
                                @endif
                                <p>Posted {{ $item->created_at->diffForHumans() }}</p>
                                <hr>

                                <p class="post-description">{!! nl2br(e($item->post_caption)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>







        <script>
            document.getElementById('follow-button').addEventListener('click', function() {
                const button = this;
                const userId = button.getAttribute('data-user-id');
                const followerCountElement = document.getElementById('jumlah-follower');

                fetch(`/follow/${userId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'followed') {
                            button.textContent = 'Berhenti Mengikuti';
                            followerCountElement.textContent = data.newFollowerCount;
                        } else if (data.status === 'unfollowed') {
                            button.textContent = 'Ikuti';
                            followerCountElement.textContent = data.newFollowerCount;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
        <script src="{{ asset('js/home-drop-down.js') }}"></script>

    </body>

    </html>
    <script src="{{ asset('js/home.js') }}"></script>


</x-profile-page-layout>
