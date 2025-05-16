<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border: none;
            text-decoration: none;
            -webkit-font-smoothing: antialiased;
        }

        body, html {
            height: 100%;
            font-family: "Inter-Regular", sans-serif;
            background: #121246;
            color: #fff;
            overflow-x: hidden;
        }

        /* Container for layout */
        .profile-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Hover area for sidebar trigger */
        .hover-area {
            position: fixed;
            left: 0;
            top: 0;
            width: 20px;
            height: 100vh;
            background: transparent;
            z-index: 20;
            cursor: pointer;
        }

        /* Navigation */
        .navigation {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: -250px;
            top: 0;
            transition: left 0.3s ease-in-out;
            z-index: 30;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            background: rgba(18, 18, 70, 0.9);
            backdrop-filter: blur(10px);
        }

        .navigation[aria-expanded="true"] {
            left: 0;
        }

        /* Main content */
        .profile-page {
            flex: 1;
            background: #f9f8f4;
            min-height: 100vh;
            padding: 90px 1rem 2rem;
            transition: padding-left 0.3s ease-in-out;
            overflow-y: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .profile-page[aria-nav-expanded="true"] {
            padding-left: 250px;
        }

        /* Mobile navigation toggle */
        .mobile-nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #b5835a;
            cursor: pointer;
            position: fixed;
            right: 15px;
            top: 15px;
            z-index: 1001;
            padding: 10px;
            transition: transform 0.3s ease, color 0.2s ease;
            line-height: 1;
        }

        .mobile-nav-toggle:hover,
        .mobile-nav-toggle:focus {
            color: #8c5f3f;
            transform: rotate(90deg);
        }

        .mobile-nav-toggle:active {
            color: #6b4e31;
        }

        /* Header rectangle */
        .rectangle-5 {
            background: #ded9c3;
            width: 100%;
            height: 80px;
            position: fixed;
            left: 0;
            top: 0;
            border-bottom: 2px solid #b5835a;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-title {
            color: #121246;
            text-align: center;
            font-family: "Inter-Regular", sans-serif;
            font-size: 32px;
            font-weight: 600;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.3);
            background: linear-gradient(to right, #0e0f3a 0%, #8c5f3f 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Profile content */
        .profile-content {
            background: #ded9c3;
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #121246;
            background: linear-gradient(to right, #121246, #b5835a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: none; /* Hidden since we use rectangle-5 */
        }

        .profile-picture-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .profile-picture {
            border-radius: 50%;
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid #b5835a;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 10px;
        }

        .profile-picture:hover {
            transform: scale(1.05);
        }

        .change-picture-button {
            display: inline-block;
            padding: 8px 18px;
            background: #b5835a;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .change-picture-button:hover {
            background: #9a6b47;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(181, 131, 90, 0.3);
        }

        .change-picture-button input[type="file"] {
            display: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 15px;
            font-weight: 500;
            color: #121246;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #b5835a;
            font-size: 14px;
            background: #fff;
            color: #121246;
            transition: border-color 0.2s ease;
            width: 100%;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #8c5f3f;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .update-button,
        .discard-button {
            padding: 10px 20px;
            border-radius: 6px;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            flex: 1;
            max-width: 160px;
            text-align: center;
        }

        .update-button {
            background: #121246;
        }

        .update-button:hover {
            background: #0d0e33;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(18, 18, 70, 0.3);
        }

        .discard-button {
            background: #b5835a;
        }

        .discard-button:hover {
            background: #9a6b47;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(181, 131, 90, 0.3);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 13px;
            text-align: center;
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .hover-area {
                display: none;
            }

            .mobile-nav-toggle {
                display: block;
                z-index: 1001;
            }

            .navigation {
                width: 250px;
                left: -250px;
                z-index: 1002;
            }

            .profile-page {
                padding: 80px 0.5rem 1rem;
            }

            .profile-page[aria-nav-expanded="true"] {
                padding-left: 0;
            }

            .rectangle-5 {
                height: 70px;
            }

            .profile-title {
                font-size: 24px;
            }

            .profile-content {
                padding: 20px;
                margin: 0 10px;
            }

            .form-grid {
                gap: 12px;
            }

            .profile-picture {
                width: 120px;
                height: 120px;
            }

            .form-group input,
            .form-group textarea {
                padding: 8px;
                font-size: 13px;
            }

            .form-group label {
                font-size: 14px;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            .update-button,
            .discard-button {
                max-width: 100%;
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {
            .navigation {
                width: 200px;
                left: -200px;
            }

            .mobile-nav-toggle {
                right: 10px;
                top: 10px;
                font-size: 20px;
                padding: 8px;
            }

            .profile-page {
                padding: 70px 0.5rem 1rem;
            }

            .rectangle-5 {
                height: 60px;
            }

            .profile-title {
                font-size: 20px;
            }

            .profile-content {
                padding: 15px;
                margin: 0 5px;
            }

            .profile-picture {
                width: 100px;
                height: 100px;
            }

            .profile-picture-container {
                margin-bottom: 20px;
            }

            .change-picture-button {
                padding: 6px 14px;
                font-size: 12px;
            }

            .form-group label {
                font-size: 13px;
            }

            .form-group input,
            .form-group textarea {
                font-size: 12px;
            }

            .error-message {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Mobile navigation toggle -->
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Hover area for sidebar -->
        <div class="hover-area" role="button" aria-label="Open sidebar" tabindex="0"></div>
        <!-- Navigation Sidebar -->
        <div class="navigation" aria-expanded="false">
            @include('layouts.navigation')
        </div>
        <!-- Main Content -->
        <div class="profile-page" aria-nav-expanded="false">
            <div class="rectangle-5">
                <div class="profile-title">Edit Profile</div>
            </div>
            <div class="profile-content">
                <div class="profile-header">
                    <h1>EDIT PROFILE</h1>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="profile-picture-container">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/logo1.png') }}" alt="Profile Picture" class="profile-picture">
                        <label class="change-picture-button">
                            Change Picture
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                        </label>
                        @error('profile_picture')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_no">Contact Number</label>
                            <input type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', Auth::user()->contact_no) }}">
                            @error('contact_no')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address">{{ old('address', Auth::user()->address) }}</textarea>
                            @error('address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="update-button">Update Profile</button>
                        <a href="{{ route('user.profile') }}" class="discard-button">Discard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const navigation = document.querySelector('.navigation');
            const profilePage = document.querySelector('.profile-page');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');

            // Hover navigation for desktop
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        profilePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !navigation.matches(':hover')) {
                        navigation.setAttribute('aria-expanded', 'false');
                        profilePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                navigation.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        profilePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                navigation.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'false');
                        profilePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = navigation.getAttribute('aria-expanded') === 'true';
                        navigation.setAttribute('aria-expanded', !isExpanded);
                        profilePage.setAttribute('aria-nav-expanded', !isExpanded);
                    }
                });
            }

            // Mobile navigation toggle
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = navigation.getAttribute('aria-expanded') === 'true';
                    const newExpandedState = !isExpanded;
                    navigation.setAttribute('aria-expanded', newExpandedState);
                    profilePage.setAttribute('aria-nav-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close nav when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && navigation.getAttribute('aria-expanded') === 'true') {
                        if (!navigation.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                            navigation.setAttribute('aria-expanded', 'false');
                            profilePage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    }
                });

                // Close nav when clicking a link inside navigation
                navigation.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            navigation.setAttribute('aria-expanded', 'false');
                            profilePage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>