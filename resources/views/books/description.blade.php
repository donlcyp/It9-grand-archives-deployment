<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Book Description</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=bookmark" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body, html {
            height: 100%;
            font-family: "Inter-Regular", sans-serif;
            background: #121246;
            color: #121246;
            overflow-x: hidden;
        }

        /* Container for layout */
        .profile-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Main content */
        .book-page {
            flex: 1;
            background: #f9f8f4;
            min-height: 100vh;
            padding: 90px 1rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header */
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
            align-items: center;
            padding: 0 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            width: 100%;
        }

        .header-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .header-title {
            color: #121246;
            font-family: "Inter-Regular", sans-serif;
            font-size: 32px;
            font-weight: 600;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.3);
            background: linear-gradient(to right, #0e0f3a 0%, #8c5f3f 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Book Container */
        .book-container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            background: #ded9c3;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .book-header {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .book-cover-container {
            flex: 0 0 auto;
            width: 180px;
            aspect-ratio: 2 / 3;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

       

 .book-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        .book-info {
            flex: 1;
            min-width: 0;
            text-align: center;
        }

        .book-title {
            font-size: 35px;
            color: #121246;
            margin-bottom: 10px;
        }

        .book-author {
            color: #121246;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .book-genres {
            color: #121246;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .book-publisher {
            color: #121246;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .book-description {
            color: #121246;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
            font-size: 14px;
        }

        .book-rating {
            margin-top: 20px;
            color: #121246;
            text-align: center;
            font-size: 16px;
        }

        /* Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .borrow-section, .favorite-section {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 300px;
            height: 50px;
        }

        .borrow-button {
            padding: 8px 16px;
            background: #b5835a;
            color: #fff;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
            text-align: center;
            font-size: 14px;
            min-height: 40px;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin: 0;
            vertical-align: middle;
        }

        .borrow-button:hover {
            background: #9a6b47;
        }

        .borrow-button:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .favorite-button, .back-button {
            padding: 8px 16px;
            background: #b5835a;
            color: #fff;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
            text-align: center;
            font-size: 14px;
            min-height: 40px;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin: 0;
            vertical-align: middle;
        }

        .favorite-button:hover, .back-button:hover {
            background: #9a6b47;
        }

        .back-button {
            display: inline-block;
            text-decoration: none;
        }

        .fa-star {
            font-size: 24px;
            color: #ccc;
        }

        .checked {
            color: #ffca08;
        }

        .star-display {
            font-size: 24px;
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .borrow-feedback {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-top: 5px;
        }

        /* Responsive Adjustments */
        @media (min-width: 769px) {
            .book-page {
                padding: 100px 2rem 2rem;
            }

            .book-container {
                max-width: 800px;
                padding: 30px;
                gap: 20px;
                width: 100%;
            }

            .book-cover-container {
                width: 220px;
                margin: 0;
            }

            .book-info {
                text-align: left;
            }

            .book-title {
                font-size: 35px;
            }

            .book-author {
                font-size: 22px;
            }

            .book-genres, .book-publisher {
                font-size: 18px;
            }

            .book-description {
                font-size: 16px;
            }

            .action-buttons {
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }

            .borrow-section, .favorite-section {
                max-width: 200px;
            }

            .borrow-button, .favorite-button {
                width: 200px;
                max-width: 200px;
                padding: 10px 20px;
                font-size: 15px;
                min-height: 44px;
            }

            .back-button {
                width: 200px;
                max-width: 200px;
                padding: 10px 20px;
                font-size: 15px;
            }

            .book-rating {
                font-size: 18px;
            }
        }

        @media (max-width: 768px) {
            .book-page {
                padding: 80px 0.5rem 1rem !important;
            }

            .rectangle-5 {
                height: 70px !important;
            }

            .header-logo {
                width: 36px !important;
                height: 36px !important;
            }

            .header-title {
                font-size: 24px !important;
            }

            .book-container {
                width: 95% !important;
                max-width: 400px !important;
                padding: 15px !important;
                gap: 12px !important;
            }

            .book-header {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .book-cover-container {
                width: 150px !important;
            }

            .book-title {
                font-size: 24px !important;
            }

            .book-author {
                font-size: 18px !important;
            }

            .book-genres, .book-publisher {
                font-size: 14px !important;
            }

            .book-description {
                font-size: 13px !important;
                line-height: 1.5 !important;
            }

            .action-buttons {
                gap: 8px !important;
            }

            .borrow-section, .favorite-section {
                max-width: 100%;
            }

            .borrow-button, .favorite-button, .back-button {
                width: 100%;
                max-width: 100% !important;
                padding: 8px 12px !important;
                font-size: 13px !important;
                min-height: 40px;
            }

            .book-rating {
                font-size: 14px !important;
            }

            .fa-star {
                font-size: 20px !important;
            }

            .star-display {
                font-size: 20px !important;
            }

            .borrow-feedback {
                font-size: 13px !important;
            }
        }

        @media (max-width: 480px) {
            .book-page {
                padding: 70px 0.5rem 1rem !important;
            }

            .rectangle-5 {
                height: 60px !important;
            }

            .header-logo {
                width: 32px !important;
                height: 32px !important;
            }

            .header-title {
                font-size: 20px !important;
            }

            .book-container {
                width: 98% !important;
                max-width: 350px !important;
                padding: 12px !important;
                gap: 10px !important;
            }

            .book-cover-container {
                width: 120px !important;
            }

            .book-title {
                font-size: 20px !important;
            }

            .book-author {
                font-size: 16px !important;
            }

            .book-genres, .book-publisher {
                font-size: 13px !important;
            }

            .book-description {
                font-size: 12px !important;
            }

            .action-buttons {
                gap: 6px !important;
            }

            .borrow-button, .favorite-button, .back-button {
                padding: 6px 10px !important;
                font-size: 12px !important;
                min-height: 36px;
            }

            .book-rating {
                font-size: 13px !important;
            }

            .fa-star {
                font-size: 18px !important;
            }

            .star-display {
                font-size: 18px !important;
            }

            .borrow-feedback {
                font-size: 12px !important;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <!-- Main Content -->
        <div class="book-page">
            <header>
                <div class="rectangle-5">
                    <div class="header-content">
                        <img src="/images/logo1.png" alt="The Grand Archives Logo" class="header-logo">
                        <div class="header-title">The Grand Archives</div>
                    </div>
                </div>
            </header>
            <div class="book-container">
                <div class="book-header">
                    <div class="book-cover-container">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover image of {{ $book->title }}" class="book-cover">
                    </div>
                    <div class="book-info">
                        <h1 class="book-title"><strong>{{ $book->title }}</strong></h1>
                        <h2 class="book-author"><strong>Author:</strong> {{ $book->author }}</h2>
                        <h3 class="book-publisher"><strong>Publisher:</strong> {{ $book->publisher ?? 'Unknown' }}</h3>
                        <h3 class="book-genres"><strong>Genres:</strong>
                            @if($book->genres->isNotEmpty())
                                @foreach($book->genres as $genre)
                                    <span>{{ $genre->name }}@if(!$loop->last), @endif</span>
                                @endforeach
                            @else
                                <span>No genres available.</span>
                            @endif
                        </h3>
                        <div class="book-description"><strong>Description:</strong>
                            {{ $book->description ?? 'No description available.' }}
                        </div>
                        <div class="action-buttons">
                            <div class="borrow-section">
                                @php
                                    $userBorrowedRecord = auth()->check() ? auth()->user()->borrowedBooks()
                                        ->where('book_id', $book->id)
                                        ->where('status', 'borrowed')
                                        ->whereNull('returned_at')
                                        ->first() : null;

                                    $isBorrowedByOthers = \App\Models\BorrowedBook::where('book_id', $book->id)
                                        ->where('status', 'borrowed')
                                        ->whereNull('returned_at')
                                        ->where('user_id', '!=', auth()->id())
                                        ->exists();

                                    $borrowButtonDisabled = $isBorrowedByOthers && !$userBorrowedRecord;
                                @endphp

                                <button id="borrow-button" class="borrow-button"
                                    @if($borrowButtonDisabled) disabled @endif>
                                    {{ $userBorrowedRecord ? 'Return Book' : ($borrowButtonDisabled ? 'Not Available' : 'Borrow This Book') }}
                                </button>

                                @if($userBorrowedRecord)
                                    <div>
                                        <strong>Due Date:</strong> {{ $userBorrowedRecord->due_date->format('Y-m-d') }}
                                        @php
                                            $lateFee = $userBorrowedRecord->calculateLateFee();
                                        @endphp
                                        @if($lateFee > 0)
                                            <span style="color: red;">(Late Fee: ${{ number_format($lateFee, 2) }})</span>
                                        @endif
                                    </div>
                                @endif

                                <div id="borrow-feedback" class="borrow-feedback"></div>
                            </div>

                            <div class="favorite-section">
                                <form id="favorite-form" action="{{ route('favorites.toggle', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" id="favorite-button" class="favorite-button">
                                        @if(!empty($isFavorited) && $isFavorited)
                                            Remove from Favorites
                                        @else
                                            Add to Favorites
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="book-rating">
                            <h4>Average Rating: {{ number_format($averageRating ?? 0, 1) }} / 5</h4>
                            @auth
                                @php
                                    $userRating = auth()->user()->ratings()->where('book_id', $book->id)->first();
                                    $userRatingValue = $userRating ? $userRating->rating : 0;
                                @endphp
                                <div style="margin-top: 10px;">
                                    <span>Your Rating: </span>
                                    <div class="star-display">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <i class="fa fa-star {{ $i <= $userRatingValue ? 'checked' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            @else
                                <p><a href="{{ route('login') }}">Log in</a> to see your rating.</p>
                            @endauth
                        </div>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="back-button">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Borrow button AJAX
            const borrowButton = document.getElementById('borrow-button');
            const feedback = document.getElementById('borrow-feedback');

            if (borrowButton) {
                borrowButton.addEventListener('click', function() {
                    borrowButton.disabled = true;
                    feedback.textContent = '';

                    fetch("{{ route('books.toggleBorrow', $book) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status === 200) {
                            if (body.borrowed) {
                                borrowButton.textContent = 'Return Book';
                                feedback.style.color = 'green';
                                feedback.textContent = 'Book borrowed successfully.';
                            } else {
                                borrowButton.textContent = 'Borrow This Book';
                                feedback.style.color = 'green';
                                feedback.textContent = 'Book returned successfully.';
                            }
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            borrowButton.disabled = false;
                            feedback.style.color = 'red';
                            feedback.textContent = body.error || 'An error occurred.';
                        }
                    })
                    .catch(error => {
                        borrowButton.disabled = false;
                        feedback.style.color = 'red';
                        feedback.textContent = 'An error occurred.';
                        console.error('Error:', error);
                    });
                });
            }

            // Favorite button AJAX
            const favoriteForm = document.getElementById('favorite-form');
            const favoriteButton = document.getElementById('favorite-button');

            if (favoriteForm && favoriteButton) {
                favoriteForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    fetch(favoriteForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': favoriteForm.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams(new FormData(favoriteForm))
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.favorited) {
                            favoriteButton.textContent = 'Remove from Favorites';
                        } else {
                            favoriteButton.textContent = 'Add to Favorites';
                        }
                    })
                    .catch(error => {
                        console.error('Error toggling favorite:', error);
                    });
                });
            }
        });
    </script>
    @vite(['resources/js/app.js'])
</body>
</html>