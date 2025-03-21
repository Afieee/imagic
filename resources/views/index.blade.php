<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagic</title>
    <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&family=Nunito:wght@300;400;600&family=Raleway:wght@300;400;600&family=Josefin+Sans:wght@300;400;600&display=swap"
        rel="stylesheet">

</head>

<x-landing-page-layout>

    <div class="post-container">
        @foreach ($postingan as $item)
            <div class="post-card">
                <div class="post-user-profile">
                    <p class="user-name">{{ $item->user->name }}</p>
                </div>
                <div class="post-image">
                    @if ($item->post_image)
                        <img src="{{ asset($item->post_image) }}" alt="Uploaded Image">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                </div>
                <div class="post-actions">
                </div>
                <div class="post-content">
                    Posted {{ $item->created_at->diffForHumans() }}

                    <p class="post-description">{!! nl2br($item->post_caption) !!}</p>
                </div>
            </div>
        @endforeach
    </div>


</x-landing-page-layout>
