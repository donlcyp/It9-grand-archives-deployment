<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $genre->name ?? 'Unknown Genre' }} - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    @vite(['resources/css/app.css'])
    <style>
        /* Reset styles */
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
        .genre-container {
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
        .genre-page {
            flex: 1;
            background: #f9f8f4;
            min-height: 100vh;
            padding: 100px 1rem 1rem;
            transition: padding-left 0.3s ease-in-out;
            overflow-y: auto;
        }

        .genre-page[aria-nav-expanded="true"] {
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

        /* Book card styles */
        .book-card {
            width: 100%;
            height: 300px;
            background: #b5835a;
            border-radius: 15px;
            border: 1px solid #b5835a;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
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

        .book-card .book-info {
            padding: 8px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: calc(100% - 180px);
        }

        .book-card p {
            color: #fff;
            font-family: "Inter-Regular", sans-serif;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 3px;
        }

        .book-card .quantity {
            color: #fff;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .book-card .action-button {
            background: #121246;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.2s;
        }

        .book-card .action-button:hover {
            background: #1e2a78;
        }

        .book-card .out-of-stock {
            color: #ff6b6b;
            font-size: 12px;
            font-style: italic;
        }

        /* Star rating styles */
        .book-card .fa-star {
            color: #ccc;
            font-size: 12px;
        }

        .book-card .fa-star.checked {
            color: #ffca08;
        }

        .book-card .rating-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 3px;
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

        .genre-title {
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

        /* Search bar */
        .search-container {
            margin: 20px auto 40px;
            width: 100%;
            max-width: 537px;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .rectangle-7 {
            background: #d9d9d9;
            border-radius: 8px;
            width: 100%;
            height: 47px;
            padding: 0 50px 0 15px;
            font-family: "Inter-Regular", sans-serif;
            font-size: 16px;
            color: #121246;
            outline: none;
            border: none;
            display: flex;
            align-items: center;
        }

        .magnifying-1 {
            font-size: 24px;
            color: #121246;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .magnifying-1:hover {
            color: #8c5f3f;
        }

        /* Book grid */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1102px;
            margin: 0 auto 40px;
            padding: 0 20px;
        }

        .book-item {
            position: relative;
            text-align: center;
        }

        .book-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            aspect-ratio: 3/4;
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .book-item img:hover {
            transform: scale(1.05);
        }

        .book-item .borrow-form {
            margin-top: 10px;
        }

        .book-item .borrow-button {
            padding: 5px 10px;
            background: #d4a373;
            color: #121246;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .book-item .borrow-button:hover {
            background: #b5835a;
        }

        /* Success/Error Messages */
        .success-message, .error-message {
            text-align: center;
            padding: 10px;
            margin: 10px auto;
            border-radius: 4px;
            max-width: 500px;
        }

        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
        }

        .success-message {
            background: #b5835a;
            color: #121246;
        }

        .error-message {
            background: #ff6b6b;
            color: #fff;
        }

        /* Responsive adjustments */
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

            .genre-page {
                padding: 90px 0.5rem 1rem;
            }

            .genre-page[aria-nav-expanded="true"] {
                padding-left: 0;
            }

            .rectangle-5 {
                height: 70px;
            }

            .genre-title {
                font-size: 24px;
            }

            .search-container {
                max-width: 400px;
                margin: 10px auto 20px;
            }

            .rectangle-7 {
                height: 40px;
                font-size: 14px;
            }

            .magnifying-1 {
                font-size: 20px;
                right: 10px;
            }

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .book-item .borrow-button {
                font-size: 12px;
                padding: 4px 8px;
            }

            .book-card {
                height: 220px;
            }

            .book-card img {
                height: 130px;
            }

            .book-card .book-info {
                padding: 6px;
                height: calc(100% - 130px);
            }

            .book-card p {
                font-size: 12px;
                margin-bottom: 2px;
            }

            .book-card .rating-container {
                gap: 3px;
                margin-bottom: 2px;
            }

            .book-card .fa-star {
                font-size: 10px;
            }

            .book-card .rating-container span:last-child {
                font-size: 10px;
                margin-left: 5px;
            }

            .book-card .quantity, .book-card .out-of-stock {
                font-size: 10px;
                margin-bottom: 2px;
            }

            .book-card .action-button {
                font-size: 10px;
                padding: 3px 6px;
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
                padding: 10px;
            }

            .genre-page {
                padding: 80px 0.5rem 1rem;
            }

            .rectangle-5 {
                height: 60px;
            }

            .genre-title {
                font-size: 20px;
            }

            .search-container {
                max-width: 300px;
            }

            .rectangle-7 {
                height: 36px;
                font-size: 13px;
            }

            .magnifying-1 {
                font-size: 18px;
                right: 8px;
            }

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .book-item .borrow-button {
                font-size: 10px;
                padding: 3px 6px;
            }

            .book-card {
                height: 200px;
            }

            .book-card img {
                height: 120px;
            }

            .book-card .book-info {
                padding: 5px;
                height: calc(100% - 120px);
            }

            .book-card p {
                font-size: 10px;
            }

            .book-card .rating-container span:last-child {
                font-size: 10px;
            }

            .book-card .quantity, .book-card .out-of-stock {
                font-size: 9px;
            }

            .book-card .action-button {
                font-size: 9px;
                padding: 2px 5px;
            }
        }
    </style>
</head>
<body>
    <div class="genre-container">
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
        <div class="genre-page" aria-nav-expanded="false">
            <div class="rectangle-5">
                <div class="genre-title">{{ $genre->name ?? 'Unknown Genre' }}</div>
            </div>
            <div class="search-container">
                <form method="GET" action="{{ route('genre.show', $genre->id) }}">
                    <input type="text" name="search" class="rectangle-7" placeholder="Search books..." value="{{ request('search') }}">
                    <button type="submit" style="background: none; border: none; padding: 0; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                        <span class="material-symbols-outlined magnifying-1">search</span>
                    </button>
                </form>
            </div>
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif
            <div class="book-grid">
                @forelse ($books as $book)
                    <div class="book-card">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                        </a>
                        <div class="book-info">
                            <a href="{{ route('books.show', $book->id) }}">
                                <p>{{ $book->title }}</p>
                            </a>
                            <div class="rating-container">
                                @php
                                    $roundedRating = round($book->average_rating);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $roundedRating)
                                        <span class="fa fa-star checked"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                                <span style="color: #121246;">({{ number_format($book->average_rating, 2) }}/5)</span>
                            </div>
                            @if($book->quantity > 0)
                                <span class="quantity">Available: {{ $book->quantity }}</span>
                            @else
                                <span class="out-of-stock">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400">No books found in this genre.</div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const navigation = document.querySelector('.navigation');
            const genrePage = document.querySelector('.genre-page');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');

            // Hover navigation for desktop
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        genrePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !navigation.matches(':hover')) {
                        navigation.setAttribute('aria-expanded', 'false');
                        genrePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                navigation.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'true');
                        genrePage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                navigation.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        navigation.setAttribute('aria-expanded', 'false');
                        genrePage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = navigation.getAttribute('aria-expanded') === 'true';
                        navigation.setAttribute('aria-expanded', !isExpanded);
                        genrePage.setAttribute('aria-nav-expanded', !isExpanded);
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
                    genrePage.setAttribute('aria-nav-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close nav when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && navigation.getAttribute('aria-expanded') === 'true') {
                        if (!navigation.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                            navigation.setAttribute('aria-expanded', 'false');
                            genrePage.setAttribute('aria-nav-expanded', 'false');
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
                            genrePage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }
        });
    </script>
    @vite(['resources/js/app.js'])
</body>
</html>