<x-home-page-layout :user="$user">

    <head>
        <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
    </head>
    <style>
        .pro-con {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .pro-con h2 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .input-group input,
        .input-group textarea {
            width: 90%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            transition: border 0.3s ease;
        }

        .input-group textarea {
            resize: vertical;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            border-color: #ea4335;
        }

        .submit-btn {
            width: 93%;
            padding: 12px;
            background-color: #ea4335;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #db2d23;
        }

        .submit-btn:active {
            background-color: #b01a1a;
        }

        @media (max-width: 1024px) {
            .pro-con {
                width: 95%;
                padding: 20px;
            }

            .input-group input,
            .input-group textarea {
                font-size: 15px;
            }

            .submit-btn {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .pro-con {
                width: 90%;
                padding: 15px;
            }

            .input-group label {
                font-size: 14px;
            }

            .input-group input,
            .input-group textarea {
                font-size: 14px;
            }

            .submit-btn {
                font-size: 15px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .pro-con {
                width: 95%;
                padding: 10px;
            }

            .input-group input,
            .input-group textarea {
                font-size: 13px;
            }

            .submit-btn {
                width: 100%;
                font-size: 14px;
                padding: 8px;
            }

        }
    </style>
    <div class="pro-con" style="">
        <h2>Edit Your Profile</h2>

        <form action="{{ route('updateProfile', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="input-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" rows="5" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="submit-btn">Update Profile</button>
        </form>
    </div>
</x-home-page-layout>
