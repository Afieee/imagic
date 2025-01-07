<x-profile-page-layout :user="$user">

    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Imagic | Profile
        </title>
        <link rel="stylesheet" href="{{ asset('css/upload.css') }}">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }

            .profile-header {
                text-align: ;
                padding: 20px;
                background-color: #fff;
                border-bottom: 1px solid #ddd;
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

            .profile-header .stats span {
                margin: 0 10px;
            }

            .profile-header .website {
                color: #000;
                text-decoration: none;
            }

            .profile-header .website:hover {
                text-decoration: underline;
            }

            .profile-header .cover-photo img {
                width: 100%;
                height: auto;
                border-radius: 10px;
            }

            .tabs {
                display: flex;
                justify-content: center;
                background-color: #fff;
                border-bottom: 1px solid #ddd;
            }

            .tabs a {
                padding: 15px 20px;
                text-decoration: none;
                color: #333;
                font-weight: bold;
            }

            .tabs a.active {
                border-bottom: 2px solid #e60023;
                color: #e60023;
            }


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
        </style>
    </head>

    <body>
        <div class="profile-header">
            <img alt="Profile Picture" height="100"
                src="https://storage.googleapis.com/a1aa/image/85CMLozD2X5YLN91mP0pdSJpyFcrrfevqr8mKf5hgOfhfNVgC.jpg"
                width="100" />
            <h1>
                {{ $postingan->first()->user->name ?? $user->name }} |
                {{ $postingan->first()->user->bio ?? $user->bio }}
            </h1>

            <div class="stats">
                <span>
                    634 pengikut
                </span>
                -
                <span>
                    717 mengikuti
                </span>
                -
                <span>
                    12.9rb tayangan bulanan
                </span>
            </div>
            <a class="website" href="https://ablondegalblogs.home.blog">
                Work Contact: {{ $postingan->first()->user->email ?? $user->email }}

            </a>
            <div>
                <button class="follow-btn">
                    Ikuti
                </button>
                <button class="message-btn" style="margin-bottom: 50px">
                    Hubungi
                </button>
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
                                        class="action-btn like-btn {{ $isLiked ? 'active' : '' }}"onclick="document.getElementById('like-form-{{ $item->id_post }}').submit();">
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
                                <p class="like-count">Liked by <strong>{{ $item->post_likes->count() }}</strong>
                                    others</p>

                                Posted {{ $item->created_at->diffForHumans() }}
                                <hr>
                                <p class="post-description">{!! nl2br(e($item->post_caption)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>





    </body>

    </html>


</x-profile-page-layout>
