<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Profile Page
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .profile-header {
            text-align: center;
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

        .gallery {
            display: flex;
            flex-wrap: wrap;
            padding: 10px;
            justify-content: center;
        }

        .gallery .item {
            width: 150px;
            margin: 10px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .gallery .item img {
            width: 100%;
            height: auto;
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
            Claudia | Fashion Beauty and Lifestyle
        </h1>
        <p>
            Blogger. Lifestyle | Travel | Beauty | Fashion | Sharing inspiration one pin at a time! Contact me through
            my blog with any enquiries!
        </p>
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
            @ablondegalblogs.home.blog
        </a>
        <div>
            <button class="follow-btn">
                Ikuti
            </button>
            <button class="message-btn">
                Hubungi
            </button>
        </div>
        <div class="cover-photo">
            <img alt="Cover Photo" height="200"
                src="https://storage.googleapis.com/a1aa/image/HLbVtN1rbBorAJJwPkKoHtl8DeGOOc5pxwuHwf9tLWwqvpCUA.jpg"
                width="800" />
        </div>
    </div>
    <div class="tabs">
        <a class="active" href="#">
            Dibuat
        </a>
        <a href="#">
            Disimpan
        </a>
    </div>
    <div class="gallery">
        <div class="item">
            <img alt="Image 1" height="300"
                src="https://storage.googleapis.com/a1aa/image/0WCNMnfnAR3JL65IhTIgRLrC8HweEGjJWsIp91jIVaJxvpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 2" height="300"
                src="https://storage.googleapis.com/a1aa/image/lwnyMeS6FR2NRyufDHg5rOkykf9KAAomnjv3G9QtfqFjeNVgC.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 3" height="300"
                src="https://storage.googleapis.com/a1aa/image/84v09zJHuI5NCRC86R9sr4jGx38l9rGoIhVL1uTw8LEAcqAF.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 4" height="300"
                src="https://storage.googleapis.com/a1aa/image/TdXz7PImaWJkFZXetyszI469pTgkCLAXYeVwo7FGyLQCwpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 5" height="300"
                src="https://storage.googleapis.com/a1aa/image/GNfEQtE94hWoT64Jd60iPx4ZRKeQlQHLu0B16nZ60ww1vpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 6" height="300"
                src="https://storage.googleapis.com/a1aa/image/8WkSEHLr4WKXKpS42kqtpPfYMo58BS9bZ7njCWDobGoB4UBKA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 7" height="300"
                src="https://storage.googleapis.com/a1aa/image/yqdvoeFCmelvI03Xor3V74yFl0v1CDy9mBJtLMrpjrfHfmKQB.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 8" height="300"
                src="https://storage.googleapis.com/a1aa/image/xBUcVjcVzhZxONuLT8Zkera87dP1kYt6jUdkFIDSn76v3UBKA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 9" height="300"
                src="https://storage.googleapis.com/a1aa/image/3lA1EkoWiI6oDReZUaLIYVq5nZt2r09FKiguNShlReWhvpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 10" height="300"
                src="https://storage.googleapis.com/a1aa/image/bx9xjNAYXrIYNZuPaBf0t4C0DcjMZQKKIcWUfTJvm0FmvpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 11" height="300"
                src="https://storage.googleapis.com/a1aa/image/MDyNp17HGTK4Il2iRYM5wdff372Ma2F3HerVLuQhdjDcfmKQB.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 12" height="300"
                src="https://storage.googleapis.com/a1aa/image/w2R5Co3Ep663L9rMAGYpLDd7EAmv1fZhMqKu5HQvsnfkvpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 13" height="300"
                src="https://storage.googleapis.com/a1aa/image/eKed7gP6p3sjNkYSyniL7W4w5ARXjBarPkbrGfEyc1EnfmKQB.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 14" height="300"
                src="https://storage.googleapis.com/a1aa/image/5CFtsiuf1tVXIi1K0MN2S0VPiEujLQKJAfNIwx9usfEKgTFoA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 15" height="300"
                src="https://storage.googleapis.com/a1aa/image/wJ0bLEHFCuZbLJZCKAxZpTrWDCWneYnm30gcS2Wlq3E73UBKA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 16" height="300"
                src="https://storage.googleapis.com/a1aa/image/3TQrljXjuJYcMxnQivU7jWzZOpmM1dJtdiaScJaN1lA7bqAF.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 17" height="300"
                src="https://storage.googleapis.com/a1aa/image/sQlt435YhopkPRnketNcgGYOQ4sWfqO3ubxqfHog3Ql1fmKQB.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 18" height="300"
                src="https://storage.googleapis.com/a1aa/image/IUYRldlx9QrOG54OeJzHyx5rmYw7XBzdJN61QGIcEWFevpCUA.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 19" height="300"
                src="https://storage.googleapis.com/a1aa/image/sAkuufIv59UWVyJY11EewkpF1hlH1xfdzQCxNCa6bFf4fNVgC.jpg"
                width="150" />
        </div>
        <div class="item">
            <img alt="Image 20" height="300"
                src="https://storage.googleapis.com/a1aa/image/k7TRfSFrQH1nGCWg2TrrsMTSEesY9hOlPW4qJ5x6j5feeNVgC.jpg"
                width="150" />
        </div>
    </div>
</body>

</html>
