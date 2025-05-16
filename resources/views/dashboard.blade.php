<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Grand Archives</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f0f0e4;
            color: #121246;
            overflow-x: hidden;
        }

        .fa-star {
            font-size: 0.9rem;
            color: #ccc;
        }

        .checked {
            color: #ffca08;
        }

        .home-container {
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
            z-index: 1001; /* Below navigation to allow overlay */
            padding: 12px; /* Larger touch area */
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

        /* Navigation styles */
        .navigation {
            width: 250px;
            background: #ded9c3;
            height: 100vh;
            position: fixed;
            left: -250px;
            top: 0;
            transition: left 0.3s ease-in-out;
            z-index: 1002; /* Above toggle button and content */
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
            border-radius: 0 12px 12px 0;
        }

        .navigation[aria-expanded="true"] {
            left: 0;
        }

        /* Hover area for desktop */
        .hover-area {
            position: fixed;
            left: 0;
            top: 0;
            width: 20px;
            height: 100vh;
            background: transparent;
            z-index: 1003; /* Above navigation */
            cursor: pointer;
        }

        /* Main content styles */
        .home-page {
            flex: 1;
            background: #f0f0e4;
            min-height: 100vh;
            padding: 2rem 1rem;
            transition: margin-left 0.3s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .home-page[aria-nav-expanded="true"] {
            margin-left: 250px;
        }

        /* Logo and GRAND ARCHIVES */
        .logo {
            width: 80px; /* Original size */
            height: auto;
            margin: 0 auto 0.5rem;
            display: block;
        }

        .grand-archives2 {
            color: #0e0f3a;
            text-align: center;
            font-family: "JacquesFrancoisShadow-Regular", "Cinzel Decorative", serif;
            font-size: 2rem; /* Larger as in original */
            font-weight: 400;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.7);
            background: linear-gradient(to right, #0e0f3a 0%, #8c5f3f 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: transform 0.3s ease;
            margin-bottom: 1rem;
        }

        .grand-archives2:hover {
            transform: scale(1.05);
        }

        /* Messages */
        .message {
            text-align: center;
            padding: 0.75rem;
            margin: 0.5rem auto;
            max-width: 1100px;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .message.success {
            background: #6aa933;
            color: #fff;
        }

        .message.error {
            background: #ff3333;
            color: #fff;
        }

        /* Overdue notice */
        .overdue-notice {
            background: #ff6b6b;
            color: #fff;
            padding: 0.75rem;
            border-radius: 8px;
            text-align: center;
            margin: 0.5rem auto;
            max-width: 1100px;
            font-size: 0.9rem;
        }

        /* Section headers */
        .trending, .trending2, .trending3, .borrowed-books {
            color: #121246;
            font-size: 40px;
            font-weight: 600;
            margin: 1rem 0 0.5rem;
            padding-left: 1rem;
        }

        .trending {
            margin-top: 0.5rem;
        }

        /* Carousel wrapper for arrows */
        .carousel-wrapper {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Book container styles (Netflix-like carousel) */
        .book-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 1rem;
            padding: 1rem;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .book-container::-webkit-scrollbar {
            display: none;
        }

        .book-container {
            scroll-snap-type: x proximity;
        }

        .book-container > * {
            scroll-snap-align: start;
        }

        /* Book card styles */
        .book-card {
            flex: 0 0 220px;
            height: 320px;
            background: #ded9c3;
            border-radius: 12px;
            border: 1px solid #b5835a;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            box-shadow: 0 4px 12px rgba(181, 131, 90, 0.1);
        }

        .book-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 24px rgba(181, 131, 90, 0.3);
        }

        .book-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .book-card .book-info {
            padding: 0.5rem;
            text-align: center;
        }

        .book-card p {
            color: #121246;
            font-size: 0.8rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.2rem;
        }

        .book-card .quantity {
            color: #121246;
            font-size: 0.7rem;
            margin-bottom: 0.2rem;
        }

        .book-card .action-button {
            background: #121246;
            color: #fff;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.7rem;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .book-card .action-button:hover {
            background: #1e2a78;
            transform: scale(1.05);
        }

        .book-card .out-of-stock {
            color: #ff6b6b;
            font-size: 0.7rem;
            font-style: italic;
        }

        /* Carousel navigation arrows */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(181, 131, 90, 0.8);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease, background 0.2s ease;
            z-index: 5;
        }

        .carousel-arrow:hover {
            background: #b5835a;
        }

        .carousel-wrapper:hover .carousel-arrow {
            opacity: 1;
        }

        .carousel-arrow.left {
            left: 10px;
        }

        .carousel-arrow.right {
            right: 10px;
        }

        .carousel-arrow:focus {
            outline: 2px solid #121246;
            outline-offset: 2px;
        }

        /* Bookmark icon styles */
        .bookmark-icon {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 1.25rem;
            cursor: pointer;
            z-index: 10;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .bookmark-icon.favorited {
            color: #b5835a;
        }

        .bookmark-icon:not(.favorited) {
            color: #d4a373;
        }

        .bookmark-icon:hover {
            transform: scale(1.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navigation {
                width: 200px;
                left: -200px;
            }

            .navigation[aria-expanded="true"] {
                left: 0;
            }

            .hover-area {
                display: none;
            }

            .mobile-nav-toggle {
                display: block;
                font-size: 22px;
                right: 10px;
                top: 10px;
                padding: 14px;
            }

            .home-page {
                padding: 3rem 0.5rem 1.5rem; /* Increased top padding to ensure header visibility */
            }

            .home-page[aria-nav-expanded="true"] {
                margin-left: 200px;
            }

            .grand-archives2 {
                font-size: 1.5rem;
            }

            .logo {
                width: 60px;
            }

            .book-card {
                flex: 0 0 160px;
                height: 260px;
            }

            .book-card img {
                height: 180px;
            }

            .book-card p {
                font-size: 0.8rem;
            }

            .book-card .quantity,
            .book-card .action-button,
            .book-card .out-of-stock {
                font-size: 0.7rem;
            }

            .carousel-arrow {
                display: none; /* Hide arrows on mobile */
            }

            .trending, .trending2, .trending3, .borrowed-books {
                font-size: 1.5rem;
                margin: 0.75rem 0 0.5rem;
            }

            .message, .overdue-notice {
                font-size: 0.85rem;
                padding: 0.5rem;
            }

            .bookmark-icon {
                font-size: 1.2rem;
                padding: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .mobile-nav-toggle {
                font-size: 20px;
                right: 8px;
                top: 8px;
                padding: 12px;
            }

            .home-page {
                padding: 2.5rem 0.5rem 1rem; /* Adjusted top padding for smaller screens */
            }

            .logo {
                width: 50px;
                margin-right: 8px;
            }

            .grand-archives2 {
                font-size: 1.25rem;
            }

            .book-card {
                flex: 0 0 140px;
                height: 260px;
            }

            .book-card img {
                height: 160px;
            }

            .book-card p {
                font-size: 0.7rem;
            }

            .book-card .quantity,
            .book-card .action-button,
            .book-card .out-of-stock {
                font-size: 0.6rem;
            }

            .trending, .trending2, .trending3, .borrowed-books {
                font-size: 1.25rem;
            }

            .carousel-arrow {
                display: none; /* Ensure arrows are hidden on smaller mobile screens */
            }
        }

        /* Ensure content fits on short screens */
        @media (max-height: 600px) {
            .mobile-nav-toggle {
                top: 8px;
                padding: 10px;
            }

            .home-page {
                padding: 2rem 0.5rem 1rem; /* Adjusted top padding for short screens */
            }

            .logo {
                width: 50px;
                margin-right: 8px;
            }

            .grand-archives2 {
                font-size: 1rem;
            }

            .trending, .trending2, .trending3, .borrowed-books {
                font-size: 1rem;
                margin: 0.5rem 0 0.25rem;
            }

            .book-card {
                flex: 0 0 140px;
                height: 220px;
            }

            .book-card img {
                height: 140px;
            }

            .book-card p {
                font-size: 0.7rem;
            }

            .book-card .quantity,
            .book-card .action-button,
            .book-card .out-of-stock {
                font-size: 0.6rem;
            }

            .message, .overdue-notice {
                padding: 0.5rem;
                margin: 0.25rem auto;
                font-size: 0.8rem;
            }
        }

        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <div class="hover-area" role="button" aria-label="Open navigation menu" tabindex="0"></div>
        <nav class="navigation" role="navigation" aria-label="Main navigation" aria-expanded="false">
            @include('layouts.navigation')
        </nav>
        <main class="home-page" role="main" aria-nav-expanded="false">
            <img src="{{ asset('images/logo1.png') }}" alt="Grand Archives Logo" class="logo" loading="lazy">
            <div class="grand-archives2" role="heading" aria-level="1">GRAND ARCHIVES</div>
            @if(session('success'))
                <div class="message success" role="alert">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="message error" role="alert">{{ session('error') }}</div>
            @endif
            @if($overdueCount > 0)
                <div class="overdue-notice" role="alert">
                    You have {{ $overdueCount }} overdue book(s)! Please return them as soon as possible.
                </div>
            @endif
            <!-- Trending Books -->
            <h2 class="trending">Newly Arrived</h2>
            <div class="carousel-wrapper">
                <button class="carousel-arrow left" aria-label="Scroll left" tabindex="0">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div class="book-container" role="region" aria-label="Trending books carousel">
                    @forelse($books as $book)
                        <div class="book-card" role="article">
                            <form action="{{ route('favorites.toggle', $book) }}" method="POST" style="position: absolute; top: 0.5rem; right: 0.5rem; z-index: 10;">
                                @csrf
                                <button type="submit" class="bookmark-icon {{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'favorited' : '' }}" style="background: none; border: none; padding: 0; cursor: pointer;" title="Toggle favorite" aria-label="Toggle favorite for {{ $book->title }}">
                                    <i class="{{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('books.show', $book->id) }}" aria-label="View details for {{ $book->title }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" loading="lazy">
                            </a>
                            <div class="book-info">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <p>{{ $book->title }}</p>
                                </a>
                                <div style="display: flex; align-items: center; gap: 0.2rem; color: #ffca08; font-size: 0.8rem; margin-bottom: 0.2rem; justify-content: center;">
                                    @php
                                        $roundedRating = round($book->average_rating);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $roundedRating)
                                            <span class="fa fa-star checked" aria-hidden="true"></span>
                                        @else
                                            <span class="fa fa-star" aria-hidden="true"></span>
                                        @endif
                                    @endfor
                                    <span style="color: #121246; font-size: 0.7rem; margin-left: 0.3rem;">({{ number_format($book->average_rating, 1) }}/5)</span>
                                </div>
                                <div class="quantity">Available: {{ $book->quantity }}</div>
                                @if($book->quantity > 0)
                                    <form action="{{ route('dashboard.borrow', $book) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="action-button">Borrow</button>
                                    </form>
                                @else
                                    <span class="out-of-stock">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="color: #121246; padding: 1rem; flex: 0 0 auto;">No trending books available.</p>
                    @endforelse
                </div>
                <button class="carousel-arrow right" aria-label="Scroll right" tabindex="0">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <!-- Top Books -->
            <h2 class="trending2">Top Books</h2>
            <div class="carousel-wrapper">
                <button class="carousel-arrow left" aria-label="Scroll left" tabindex="0">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div class="book-container" role="region" aria-label="Top books carousel">
                    @forelse($topBooks as $book)
                        <div class="book-card" role="article">
                            <form action="{{ route('favorites.toggle', $book) }}" method="POST" style="position: absolute; top: 0.5rem; right: 0.5rem; z-index: 10;">
                                @csrf
                                <button type="submit" class="bookmark-icon {{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'favorited' : '' }}" style="background: none; border: none; padding: 0; cursor: pointer;" title="Toggle favorite" aria-label="Toggle favorite for {{ $book->title }}">
                                    <i class="{{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('books.show', $book->id) }}" aria-label="View details for {{ $book->title }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" loading="lazy">
                            </a>
                            <div class="book-info">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <p>{{ $book->title }}</p>
                                </a>
                                <div style="display: flex; align-items: center; gap: 0.2rem; color: #ffca08; font-size: 0.8rem; margin-bottom: 0.2rem; justify-content: center;">
                                    @php
                                        $roundedRating = round($book->average_rating);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $roundedRating)
                                            <span class="fa fa-star checked" aria-hidden="true"></span>
                                        @else
                                            <span class="fa fa-star" aria-hidden="true"></span>
                                        @endif
                                    @endfor
                                    <span style="color: #121246; font-size: 0.7rem; margin-left: 0.3rem;">({{ number_format($book->average_rating, 1) }}/5)</span>
                                </div>
                                <div class="quantity">Available: {{ $book->quantity }}</div>
                                @if($book->quantity > 0)
                                    <form action="{{ route('dashboard.borrow', $book) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="action-button">Borrow</button>
                                    </form>
                                @else
                                    <span class="out-of-stock">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="color: #121246; padding: 1rem; flex: 0 0 auto;">No top books available.</p>
                    @endforelse
                </div>
                <button class="carousel-arrow right" aria-label="Scroll right" tabindex="0">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <!-- Most Read Books -->
            <h2 class="trending3">Most Read</h2>
            <div class="carousel-wrapper">
                <button class="carousel-arrow left" aria-label="Scroll left" tabindex="0">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div class="book-container" role="region" aria-label="Most read books carousel">
                    @forelse($mostReadBooks as $book)
                        <div class="book-card" role="article">
                            <form action="{{ route('favorites.toggle', $book) }}" method="POST" style="position: absolute; top: 0.5rem; right: 0.5rem; z-index: 10;">
                                @csrf
                                <button type="submit" class="bookmark-icon {{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'favorited' : '' }}" style="background: none; border: none; padding: 0; cursor: pointer;" title="Toggle favorite" aria-label="Toggle favorite for {{ $book->title }}">
                                    <i class="{{ auth()->user() && auth()->user()->favorites->contains($book->id) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('books.show', $book->id) }}" aria-label="View details for {{ $book->title }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" loading="lazy">
                            </a>
                            <div class="book-info">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <p>{{ $book->title }}</p>
                                </a>
                                <div style="display: flex; align-items: center; gap: 0.2rem; color: #ffca08; font-size: 0.8rem; margin-bottom: 0.2rem; justify-content: center;">
                                    @php
                                        $roundedRating = round($book->average_rating);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $roundedRating)
                                            <span class="fa fa-star checked" aria-hidden="true"></span>
                                        @else
                                            <span class="fa fa-star" aria-hidden="true"></span>
                                        @endif
                                    @endfor
                                    <span style="color: #121246; font-size: 0.7rem; margin-left: 0.3rem;">({{ number_format($book->average_rating, 1) }}/5)</span>
                                </div>
                                <div class="quantity">Available: {{ $book->quantity }}</div>
                                @if($book->quantity > 0)
                                    <form action="{{ route('dashboard.borrow', $book) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="action-button">Borrow</button>
                                    </form>
                                @else
                                    <span class="out-of-stock">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="color: #121246; padding: 1rem; flex: 0 0 auto;">No most read books available.</p>
                    @endforelse
                </div>
                <button class="carousel-arrow right" aria-label="Scroll right" tabindex="0">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const navigation = document.querySelector('.navigation');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
            const homePage = document.querySelector('.home-page');

            // Mobile navigation toggle
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = navigation.getAttribute('aria-expanded') === 'true';
                    const newExpandedState = !isExpanded;
                    navigation.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    homePage.setAttribute('aria-nav-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close nav when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && navigation.getAttribute('aria-expanded') === 'true' && !navigation.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                        navigation.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.setAttribute('aria-expanded', 'false');
                        homePage.setAttribute('aria-nav-expanded', 'false');
                        mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                    }
                });

                // Close nav when clicking a link inside navigation
                navigation.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            navigation.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            homePage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }

            // Desktop hover navigation
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        homePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !navigation.matches(':hover')) {
                        navigation.setAttribute('aria-expanded', 'false');
                        homePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                navigation.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        homePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                navigation.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'false');
                        homePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = navigation.getAttribute('aria-expanded') === 'true';
                        navigation.setAttribute('aria-expanded', !isExpanded);
                        homePage.setAttribute('aria-nav-expanded', !isExpanded);
                    }
                });
            }

            // Carousel navigation with touch support
            document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
                const container = wrapper.querySelector('.book-container');
                const leftArrow = wrapper.querySelector('.carousel-arrow.left');
                const rightArrow = wrapper.querySelector('.carousel-arrow.right');

                function isAtEnd() {
                    return container.scrollLeft >= container.scrollWidth - container.clientWidth - 10;
                }

                function isAtStart() {
                    return container.scrollLeft <= 10;
                }

                function getScrollDistance() {
                    const bookCard = container.querySelector('.book-card');
                    if (bookCard) {
                        const cardWidth = bookCard.offsetWidth;
                        const gap = parseFloat(getComputedStyle(container).gap) || 16;
                        return cardWidth + gap;
                    }
                    return 200;
                }

                leftArrow.addEventListener('click', () => {
                    if (isAtStart() && container.scrollWidth > container.clientWidth) {
                        container.scrollTo({ left: container.scrollWidth - container.clientWidth, behavior: 'smooth' });
                    } else {
                        container.scrollBy({ left: -getScrollDistance(), behavior: 'smooth' });
                    }
                });

                rightArrow.addEventListener('click', () => {
                    const scrollDistance = getScrollDistance();
                    const remainingScroll = container.scrollWidth - container.clientWidth - container.scrollLeft;
                    if (isAtEnd() || remainingScroll < scrollDistance) {
                        container.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        container.scrollBy({ left: scrollDistance, behavior: 'smooth' });
                    }
                });

                [leftArrow, rightArrow].forEach(arrow => {
                    arrow.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            arrow.click();
                        }
                    });
                });

                // Touch swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                container.addEventListener('touchstart', e => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                container.addEventListener('touchend', e => {
                    touchEndX = e.changedTouches[0].screenX;
                    const swipeDistance = touchStartX - touchEndX;
                    const minSwipeDistance = 50;

                    if (swipeDistance > minSwipeDistance) {
                        rightArrow.click();
                    } else if (swipeDistance < -minSwipeDistance) {
                        leftArrow.click();
                    }
                });
            });

            // Favorite toggle
            function toggleFavoriteAJAX(form, button, icon) {
                const url = form.action;
                const token = form.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.favorited) {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                        button.classList.add('favorited');
                    } else {
                        icon.classList.remove('fa-solid');
                        iconList.add('fa-regular');
                        button.classList.remove('favorited');
                    }
                    localStorage.setItem('favorite_' + form.action, JSON.stringify(data.favorited));
                })
                .catch(error => {
                    console.error('Error toggling favorite:', error);
                    alert('Failed to toggle favorite. Please try again.');
                });
            }

            document.querySelectorAll('form[action*="/favorites"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const button = form.querySelector('button.bookmark-icon');
                    const icon = button.querySelector('i');
                    toggleFavoriteAJAX(form, button, icon);
                });
            });

            document.querySelectorAll('form[action*="/favorites"]').forEach(form => {
                const button = form.querySelector('button.bookmark-icon');
                const icon = button.querySelector('i');
                const stored = localStorage.getItem('favorite_' + form.action);
                if (stored !== null) {
                    const favorited = JSON.parse(stored);
                    if (favorited) {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                        button.classList.add('favorited');
                    } else {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                        button.classList.remove('favorited');
                    }
                    localStorage.removeItem('favorite_' + form.action);
                }
            });
        });
    </script>
</body>
</html>