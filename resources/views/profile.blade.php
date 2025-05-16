<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary: #121246;
            --accent: #b5835a;
            --background: #f0f0e4;
            --header-bg: #ded9c3;
            --card-bg: #baba82;
            --text-dark: #121246;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            --glass-bg: rgba(186, 186, 130, 0.3);
            --glass-blur: blur(10px);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "Inter", "Georgia", sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #2d4a8a 100%);
            color: #fff;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .profile-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

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

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, rgba(18, 18, 70, 0.9) 0%, rgba(45, 74, 138, 0.9) 100%);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            left: -280px;
            top: 0;
            transition: left 0.3s ease-in-out;
            z-index: 10;
            box-shadow: var(--shadow);
        }

        .sidebar[aria-expanded="true"] {
            left: 0;
        }

        .profile-page {
            flex: 1;
            background: var(--background);
            min-height: 100vh;
            padding-left: 0;
            padding-top: 80px;
            transition: padding-left 0.3s ease-in-out;
            overflow-y: auto;
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-page[aria-expanded="true"] {
            padding-left: 250px;
        }

        .rectangle-5 {
            background: var(--header-bg);
            width: 100%;
            height: 80px;
            position: fixed;
            left: 0;
            top: 0;
            border-bottom: 2px solid var(--accent);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: var(--shadow);
            opacity: 0.95;
        }

        .profile {
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
            transition: transform 0.3s ease;
        }

        .profile-content {
            max-width: 700px;
            width: 100%;
            margin: 40px 20px;
            padding: 30px;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border-radius: 15px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .profile-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .profile-details {
            background: var(--header-bg); /* Matches .library-stats */
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-details:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .images-1-1 {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid var(--accent);
            box-shadow: var(--shadow);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .images-1-1:hover {
            transform: scale(1.05);
        }

        .dreamy-bull {
            color: var(--text-dark);
            font-family: "Georgia", serif;
            font-size: 26px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .profile-info {
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .library-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-around;
            padding: 15px;
            background: var(--header-bg);
            border-radius: 10px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .stat-item .material-symbols-outlined {
            margin-right: 8px;
            font-size: 18px;
            color: var(--accent);
        }

        .stat-item span:first-child {
            font-weight: 600;
            margin-right: 5px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }

        .button-wrapper {
            display: inline-block;
        }

        .edit-profile,
        .logout {
            width: 140px;
            padding: 10px 20px;
            line-height: 1.5;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--text-dark);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-sizing: border-box;
        }

        .edit-profile:hover,
        .logout:hover {
            background: var(--accent);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(181, 131, 90, 0.5);
        }

        /* Mobile Navigation Toggle Button */
        .mobile-nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--accent);
            cursor: pointer;
            position: fixed;
            right: 15px;
            top: 15px;
            z-index: 1001;
            padding: 12px;
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

        @media (max-width: 768px) {
            .hover-area {
                display: none;
            }

            .sidebar {
                width: 240px;
                left: -240px;
            }

            .profile-page[aria-expanded="true"] {
                padding-left: 0;
            }

            .rectangle-5 {
                height: 70px;
            }

            .profile {
                font-size: 26px;
            }

            .profile-content {
                padding: 20px;
                margin: 20px;
            }

            .profile-details {
                padding: 12px;
            }

            .images-1-1 {
                width: 100px;
                height: 100px;
            }

            .dreamy-bull {
                font-size: 22px;
            }

            .profile-info {
                font-size: 13px;
            }

            .library-stats {
                flex-direction: column;
                gap: 10px;
            }

            .stat-item {
                font-size: 12px;
            }

            .edit-profile,
            .logout {
                width: 130px;
                padding: 8px 18px;
                line-height: 1.5;
                font-size: 13px;
            }

            .mobile-nav-toggle {
                display: block;
            }

            .profile-page {
                padding-top: 90px; /* Adjusted to account for the toggle button */
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 200px;
                left: -200px;
            }

            .rectangle-5 {
                height: 60px;
            }

            .profile {
                font-size: 22px;
            }

            .profile-content {
                margin: 15px;
                padding: 15px;
            }

            .profile-details {
                padding: 10px;
            }

            .images-1-1 {
                width: 80px;
                height: 80px;
            }

            .dreamy-bull {
                font-size: 18px;
            }

            .profile-info {
                font-size: 12px;
            }

            .stat-item {
                font-size: 11px;
                padding: 8px 12px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }

            .edit-profile,
            .logout {
                width: 100%;
                padding: 8px 20px;
                line-height: 1.5;
            }

            .mobile-nav-toggle {
                font-size: 20px;
                right: 10px;
                top: 10px;
                padding: 10px;
            }

            .profile-page {
                padding-top: 80px; /* Adjusted for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <div class="hover-area" role="button" aria-label="Open sidebar" tabindex="0"></div>
        <div class="sidebar" aria-expanded="false">
            @include('layouts.navigation')
        </div>
        <div class="profile-page" aria-expanded="false">
            <div class="rectangle-5">
                <div class="profile">PROFILE</div>
            </div>
            <div class="profile-content">
                @if (session('success'))
                    <div class="profile-card alert alert-success" style="color: #ffffff; animation: fadeIn 0.7s ease-in-out;">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="profile-card alert alert-danger" style="color: #e74c3c; animation: fadeIn 0.7s ease-in-out;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="profile-card">
                    <div class="profile-details">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/logo1.png') }}" alt="Profile Picture" class="images-1-1" />
                        <div class="dreamy-bull">{{ Auth::user()->name }}</div>
                        <div class="profile-info">Contact: {{ Auth::user()->contact_no ?? 'Not provided' }}</div>
                        <div class="profile-info">Email: {{ Auth::user()->email }}</div>
                        <div class="profile-info">Address: {{ Auth::user()->address ?? 'Not provided' }}</div>
                    </div>
                </div>
                <div class="profile-card">
                    <div class="library-stats">
                        <div class="stat-item">
                            <span class="material-symbols-outlined">badge</span>
                            <span>Membership ID:</span>
                            <span>
                                @if(Auth::user()->membership_id)
                                    {{ str_pad(Auth::user()->membership_id, 6, '0', STR_PAD_LEFT) }}
                                @else
                                    Not assigned
                                @endif
                            </span>
                        </div>
                        <div class="stat-item">
                            <span class="material-symbols-outlined">calendar_today</span>
                            <span>Join Date:</span>
                            <span>{{ Auth::user()->created_at->format('Y-m-d') }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="material-symbols-outlined">library_books</span>
                            <span>Total Books Borrowed:</span>
                            <span>{{ $totalBooksBorrowed }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="material-symbols-outlined">book</span>
                            <span>Books Currently Borrowed:</span>
                            <span>{{ $currentlyBorrowed }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="material-symbols-outlined">warning</span>
                            <span>Overdue Books:</span>
                            <span>{{ $overdueBooks }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="material-symbols-outlined">attach_money</span>
                            <span>Fines Due:</span>
                            <span>${{ number_format($finesDue, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <div class="button-wrapper">
                        <a href="{{ route('profile.edit') }}" class="edit-profile">Edit Profile</a>
                    </div>
                    <div class="button-wrapper">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const sidebar = document.querySelector('.sidebar');
            const profilePage = document.querySelector('.profile-page');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');

            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        profilePage.setAttribute('aria-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !sidebar.matches(':hover')) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        profilePage.setAttribute('aria-expanded', 'false');
                    }
                });

                sidebar.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        profilePage.setAttribute('aria-expanded', 'true');
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        profilePage.setAttribute('aria-expanded', 'false');
                    }
                });

                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                        sidebar.setAttribute('aria-expanded', !isExpanded);
                        profilePage.setAttribute('aria-expanded', !isExpanded);
                    }
                });
            }

            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                    const newExpandedState = !isExpanded;
                    sidebar.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    profilePage.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close nav when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && sidebar.getAttribute('aria-expanded') === 'true' && !sidebar.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.setAttribute('aria-expanded', 'false');
                        profilePage.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                    }
                });

                // Close nav when clicking a link inside sidebar
                sidebar.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            sidebar.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            profilePage.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>