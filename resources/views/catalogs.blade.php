<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogs - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            background: #121246;
            color: #fff;
            overflow-x: hidden;
        }

        .catalog-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Hover area for desktop */
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

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background: rgba(18, 18, 70, 0.9);
            backdrop-filter: blur(10px);
            height: 100vh;
            position: fixed;
            left: -280px;
            top: 0;
            transition: left 0.3s ease-in-out;
            z-index: 10;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar[aria-expanded="true"] {
            left: 0;
        }

        /* Hamburger toggle button */
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #b5835a;
            cursor: pointer;
            position: absolute;
            right: 10px; /* Changed from left: 10px to right: 10px */
            top: 20px;
            z-index: 1001;
            transition: transform 0.3s ease;
        }

        .nav-toggle:hover {
            transform: rotate(90deg);
        }

        /* Header with logo and title */
        .header-container {
            width: 100%;
            height: 80px;
            background: rgba(222, 217, 195, 0.9);
            backdrop-filter: blur(8px);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #b5835a;
        }

        .logo {
            width: 60px;
            height: auto;
            margin-right: 10px;
        }

        .grand-archives2 {
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

        /* Main content styles */
        .catalog-selection-page {
            flex: 1;
            background: linear-gradient(135deg, #f9f8f4 0%, #f0f0e4 100%);
            min-height: 100vh;
            padding-left: 0;
            transition: padding-left 0.3s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .catalog-selection-page[aria-nav-expanded="true"] {
            padding-left: 280px;
        }

        /* Search bar styles */
        .search-container {
            display: flex;
            justify-content: center;
            margin: 100px 0 40px;
        }

        .rectangle-7 {
            background: rgba(217, 217, 217, 0.7);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: relative;
            border: 1px solid rgba(181, 131, 90, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .rectangle-7:hover {
            box-shadow: 0 0 15px rgba(181, 131, 90, 0.3);
        }

        .search-input {
            flex: 1;
            background: transparent;
            color: #121246;
            font-family: "Inter", sans-serif;
            font-size: 16px;
            outline: none;
            border: none;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            color: #121246;
            box-shadow: inset 0 0 5px rgba(181, 131, 90, 0.2);
        }

        .material-symbols-outlined {
            color: #b5835a;
            transition: transform 0.2s ease;
        }

        .material-symbols-outlined:hover {
            transform: scale(1.2);
        }

        /* Genre cards */
        .genre-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 0 20px;
            margin-bottom: 40px;
        }

        .genre-card {
            background: #b5835a;
            border-radius: 12px;
            height: 86px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px rgba(255, 255, 255, 0.3);
            animation: fadeIn 0.5s ease forwards;
            animation-delay: calc(var(--index) * 0.1s);
            opacity: 0;
        }

        .genre-card:hover {
            box-shadow: 0 8px 20px rgba(181, 131, 90, 0.4);
            transform: translateY(-5px);
        }

        .genre-card a {
            color: #ffffff;
            text-align: center;
            font-family: "Inter", sans-serif;
            font-size: 20px;
            font-weight: 500;
            padding: 0 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-decoration: none;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fade-in animation for genre cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 40px;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            color: #ded9c3;
        }

        .pagination a, .pagination span {
            color: #121246;
            background: rgba(222, 217, 195, 0.8);
            padding: 6px 12px;
            text-decoration: none;
            margin: 0 4px;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .pagination a:hover {
            background-color: #b5835a;
            color: #fff;
            transform: scale(1.1);
        }

        .pagination .current {
            background-color: #b5835a;
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .pagination .disabled {
            color: #b5835a;
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination .chevron {
            font-size: 18px;
            vertical-align: middle;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hover-area {
                display: none;
            }

            .nav-toggle {
                display: block;
                font-size: 20px; /* Slightly smaller for mobile */
                right: 15px; /* Adjusted for better spacing */
                top: 25px; /* Centered vertically in header */
            }

            .sidebar {
                width: 240px;
                left: -240px;
            }

            .header-container {
                height: 70px;
                justify-content: center; /* Keep centered for title */
                padding: 0 50px; /* Adjusted padding */
            }

            .logo {
                width: 50px;
            }

            .grand-archives2 {
                font-size: 28px; /* Slightly smaller */
            }

            .search-container {
                margin: 90px 0 30px;
            }

            .rectangle-7 {
                max-width: 400px;
            }

            .genre-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .genre-card {
                height: 70px;
            }

            .genre-card a {
                font-size: 16px;
            }

            .pagination {
                font-size: 12px;
            }

            .pagination a, .pagination span {
                padding: 4px 8px;
            }

            .pagination .chevron {
                font-size: 16px;
            }

            .catalog-selection-page[aria-nav-expanded="true"] {
                padding-left: 0;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 200px;
                left: -200px;
            }

            .header-container {
                height: 60px;
            }

            .nav-toggle {
                font-size: 18px; /* Smaller for very small screens */
                right: 10px;
                top: 20px;
            }

            .logo {
                width: 40px;
                margin-right: 8px;
            }

            .grand-archives2 {
                font-size: 24px;
            }

            .search-container {
                margin: 80px 0 20px;
            }

            .rectangle-7 {
                max-width: 300px;
            }

            .genre-grid {
                padding: 0 10px;
            }

            .pagination {
                font-size: 10px;
            }

            .pagination a, .pagination span {
                padding: 3px 6px;
            }

            .pagination .chevron {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="catalog-container">
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        <div class="hover-area" role="button" aria-label="Open sidebar" tabindex="0"></div>
        <div class="sidebar" aria-expanded="false">
            @include('layouts.navigation')
        </div>
        <div class="catalog-selection-page" aria-nav-expanded="false">
            <div class="header-container">
                <div class="grand-archives2" role="heading" aria-level="1">CATALOGS</div>
            </div>
            <div class="search-container">
                <form method="GET" action="{{ route('catalogs') }}" class="rectangle-7">
                    <input type="text" name="search" class="search-input" placeholder="Search genres..." value="{{ request('search') }}" />
                    <button type="submit" style="background: none; border: none; padding: 0;">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>
            <div class="genre-grid">
                @forelse ($genres as $genre)
                    <div class="genre-card" style="--index: {{ $loop->index }}">
                        <a href="{{ route('genre.show', $genre->id) }}">{{ $genre->name }}</a>
                    </div>
                @empty
                    <div class="text-center text-gray-400">No genres found.</div>
                @endforelse
            </div>
            <div class="pagination">
                {{ $genres->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const sidebar = document.querySelector('.sidebar');
            const catalogPage = document.querySelector('.catalog-selection-page');
            const navToggle = document.querySelector('.nav-toggle');

            // Desktop hover navigation
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        catalogPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !sidebar.matches(':hover')) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        catalogPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                sidebar.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        catalogPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        catalogPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                // Keyboard accessibility for hover area
                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                        sidebar.setAttribute('aria-expanded', !isExpanded);
                        catalogPage.setAttribute('aria-nav-expanded', !isExpanded);
                    }
                });
            }

            // Mobile toggle navigation
            if (navToggle) {
                navToggle.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                        sidebar.setAttribute('aria-expanded', !isExpanded);
                        catalogPage.setAttribute('aria-nav-expanded', !isExpanded);
                        navToggle.setAttribute('aria-expanded', !isExpanded);
                        navToggle.innerHTML = !isExpanded ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
                    }
                });
            }
        });
    </script>
</body>
</html>