<x-home-page-layout :user="$user">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Image Result</title>
    </head>

    <body>
        <h1>Image Processing Result</h1>

        <h2>Watermarked Image:</h2>
        <img src="{{ $watermarkedImagePath }}" alt="Watermarked Image"><br><br>

        <h2>Image Metadata:</h2>
        <pre>{{ print_r($metadata, true) }}</pre>

        <h2>Generated Hashtags:</h2>
        <p>{{ implode(' ', array_map(fn($tag) => "#$tag", $hashtags)) }}</p>

        <h3>Post the Image?</h3>


        <a href="/home">Go Back</a>
    </body>

    </html>
</x-home-page-layout>
