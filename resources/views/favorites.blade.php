<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
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
            font-family: "Inter-Regular", sans-serif;
            background: #121246;
            color: #fff;
            overflow-x: hidden;
        }

        .favorites-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Mobile Navigation Toggle Button */
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
            z-index: 9; /* Below sidebar but above header */
            padding: 12px; /* Large touch area */
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
            z-index: 10; /* Above header and toggle */
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar[aria-expanded="true"] {
            left: 0;
        }

        /* Main content styles */
        .favorites-page {
            flex: 1;
            background: #f0f0e4;
            min-height: 100vh;
            padding-left: 0;
            transition: padding-left 0.3s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .favorites-page[aria-nav-expanded="true"] {
            padding-left: 250px;
        }

        .rectangle-5 {
            background: #ded9c3;
            width: 100%;
            height: 80px;
            position: fixed;
            left: 0;
            top: 0;
            border-bottom: 2px solid #b5835a;
            z-index: 8; /* Below toggle and sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .favorites {
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

        /* Search bar styles */
        .search-container {
            display: flex;
            justify-content: center;
            margin: 100px 0 40px;
        }

        .rectangle-7 {
            background: #d9d9d9;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            height: 47px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: relative;
        }

        .search-input {
            flex: 1;
            background: transparent;
            color: #121246;
            font-family: "Inter-Regular", sans-serif;
            font-size: 16px;
            outline: none;
            border: none;
        }

        /* Favorites container */
        .favorites-content {
            background: #b5835a;
            border-radius: 24px;
            padding: 20px;
            margin: 0 20px 40px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .book-grid::-webkit-scrollbar {
            width: 8px;
        }

        .book-grid::-webkit-scrollbar-track {
            background: #d4a373;
        }

        .book-grid::-webkit-scrollbar-thumb {
            background: #b5835a;
            border-radius: 4px;
        }

        .book-card {
            width: 100%;
            height: 250px;
            background: #712222;
            border-radius: 15px;
            border: 1px solid #b5835a;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .book-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .book-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .book-card p {
            color: #e9e9e9;
            text-align: center;
            font-family: "Inter-Regular", sans-serif;
            font-size: 14px;
            padding: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .mobile-nav-toggle {
                display: block;
                font-size: 22px;
                right: 10px;
                top: 10px;
                padding: 14px;
            }

            .hover-area {
                display: none;
            }

            .sidebar {
                width: 240px;
                left: -240px;
            }

            .favorites-page[aria-nav-expanded="true"] {
                padding-left: 240px; /* Adjusted to match sidebar width */
            }

            .rectangle-5 {
                height: 70px;
            }

            .favorites {
                font-size: 22px;
            }

            .rectangle-7 {
                max-width: 400px;
            }

            .favorites-content {
                padding: 15px; /* Reduced padding for more content space */
                margin: 0 10px 20px; /* Reduced margins for better fit */
            }

            .book-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                max-height: 65vh; /* Increased height for more visible content */
            }

            .book-card {
                height: 200px;
            }

            .book-card img {
                height: 130px;
            }

            .book-card p {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .mobile-nav-toggle {
                font-size: 20px;
                right: 8px;
                top: 8px;
                padding: 12px;
            }

            .sidebar {
                width: 200px;
                left: -200px;
            }

            .favorites-page[aria-nav-expanded="true"] {
                padding-left: 200px; /* Adjusted to match sidebar width */
            }

            .rectangle-5 {
                height: 60px;
            }

            .rectangle-7 {
                max-width: 300px;
            }

            .favorites-content {
                padding: 10px; /* Further reduced padding */
                margin: 0 5px 10px; /* Further reduced margins */
            }

            .book-grid {
                max-height: 60vh; /* Adjusted height for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="favorites-container">
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <div class="hover-area" role="button" aria-label="Open sidebar" tabindex="0"></div>
        <div class="sidebar" aria-expanded="false">
            @include('layouts.navigation')
        </div>
        <div class="favorites-page" aria-nav-expanded="false">
            <div class="rectangle-5">
                <div class="favorites">FAVORITES</div>
            </div>
            <div class="search-container">
                <div class="rectangle-7">
                    <input type="text" class="search-input" placeholder="Search favorites..." />
                    <span class="material-symbols-outlined" style="color:black">search</span>
                </div>
            </div>
            <div class="favorites-content">
                <div class="book-grid">
                    @foreach($favorites as $book)
                        <div class="book-card" style="position: relative;">
                            <a href="{{ route('books.show', $book->id) }}" style="color: inherit; text-decoration: none;">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                                <p>{{ $book->title }}</p>
                            </a>
                        </div>
                    @endforeach
                    @if($favorites->isEmpty())
                        <p style="text-align: center; color: #121246; grid-column: 1 / -1;">No favorite books yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const sidebar = document.querySelector('.sidebar');
            const favoritesPage = document.querySelector('.favorites-page');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');

            // Mobile navigation toggle
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                    const newExpandedState = !isExpanded;
                    sidebar.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    favoritesPage.setAttribute('aria-nav-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && sidebar.getAttribute('aria-expanded') === 'true' && !sidebar.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.setAttribute('aria-expanded', 'false');
                        favoritesPage.setAttribute('aria-nav-expanded', 'false');
                        mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                    }
                });

                // Close sidebar when clicking a link inside navigation
                sidebar.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            sidebar.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            favoritesPage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }

            // Desktop hover navigation
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        favoritesPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !sidebar.matches(':hover')) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        favoritesPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                sidebar.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        favoritesPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        favoritesPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                // Keyboard accessibility for hover area
                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                        sidebar.setAttribute('aria-expanded', !isExpanded);
                        favoritesPage.setAttribute('aria-nav-expanded', !isExpanded);
                    }
                });
            }

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const bookCards = document.querySelectorAll('.book-card');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                bookCards.forEach(card => {
                    const bookTitle = card.querySelector('p').textContent.toLowerCase();
                    if (bookTitle.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>