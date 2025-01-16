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


        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    </head>
    <style>
        .like-btn i {
            color: gray;
            /* Warna ikon merah */
        }

        /* Warna tombol saat liked (ubah background tombol menjadi abu-abu) */
        .like-btn.liked {
            background-color: #d3d3d3;
            /* Warna latar belakang abu-abu */
        }

        /* Warna ikon tetap merah saat liked */
        .like-btn.liked i {
            color: #cc001f;
            /* Warna ikon tetap merah */
        }

        /* Warna tombol saat aktif */
        .like-btn.active {
            background-color: #d3d3d3;
            /* Warna latar belakang abu-abu */
            color: #cc001f;
            /* Warna ikon merah */
        }

        /* Warna ikon saat aktif tetap merah */
        .like-btn.active i {
            color: #cc001f;
            /* Warna ikon tetap merah */
        }

        .comment-btn i {
            color: orange;
        }
    </style>

    <body>
        <div class="profile-header">
            <img alt="Profile Picture" height="100"
                src="https://storage.googleapis.com/a1aa/image/85CMLozD2X5YLN91mP0pdSJpyFcrrfevqr8mKf5hgOfhfNVgC.jpg"
                width="100" />
            <h1>
                {{ $postingan->first()->user->name ?? $user->name }}
            </h1>
            <div>
                {{ $postingan->first()->user->bio ?? $user->bio }}

            </div>
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


            <div class="cover-photo" style="margin-top: 50px">
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


                                Posted {{ $item->created_at->diffForHumans() }}
                                <hr>
                                <p class="post-description">{!! nl2br(e($item->post_caption)) !!}</p>
                            </div>
                        </div>
                    @endforeach
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
    </body>

    </html>
    <script src="{{ asset('js/home.js') }}"></script>


</x-profile-page-layout>
