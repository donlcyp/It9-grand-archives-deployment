<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Grand Archives</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary: #121246;
            --accent: #b5835a;
            --card-bg: rgba(222, 217, 195, 0.9);
            --text: #121246;
            --shadow: 4px 4px 15px rgba(0, 0, 0, 0.3);
            --transition: all 0.3s ease-in-out;
            --animation-duration: 0.3s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: "Inter", sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #1a1a5e 100%);
            color: #fff;
            overflow-x: hidden;
        }

        .transaction-container {
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
            color: var(--accent);
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

        .transaction-page {
            flex: 1;
            background: linear-gradient(135deg, #f0f0e4 0%, #ecebe0 100%);
            min-height: 100vh;
            padding: 1rem;
            transition: padding-left 0.3s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .transaction-page[aria-nav-expanded="true"] {
            padding-left: 250px;
        }

        .rectangle-5 {
            background: linear-gradient(90deg, var(--card-bg) 0%, rgba(232, 226, 204, 0.9) 100%);
            backdrop-filter: blur(8px);
            width: 100%;
            height: 80px;
            position: fixed;
            left: 0;
            top: 0;
            border-bottom: 2px solid rgba(181, 131, 90, 0.5);
            z-index: 8; /* Below toggle and sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .transaction {
            color: var(--text);
            font-family: "Inter", sans-serif;
            font-size: 32px;
            font-weight: 600;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.3);
            background: linear-gradient(to right, #0e0f3a 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: transform 0.3s ease;
        }

        .due-amount-section {
            background: rgba(217, 217, 217, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            width: 100%;
            max-width: 863px;
            height: 101px;
            margin: 120px auto 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .due-amount-here {
            color: var(--text);
            font-family: "Inter", sans-serif;
            font-size: 32px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .pay-button {
            background: linear-gradient(90deg, #6aa933 0%, #8bc34a 100%);
            color: #fff;
            padding: 8px 20px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            font-size: 16px;
            font-weight: 500;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }

        .books-due-section, .payment-history-section {
            background: rgba(181, 131, 90, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            margin: 0 20px 40px;
            box-shadow: var(--shadow);
            animation: fadeIn 0.5s ease forwards;
        }

        .books-that-are-due {
            color: #f0f0e4;
            font-family: "Inter", sans-serif;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .book-entry {
            background: rgba(217, 217, 217, 0.9);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInEntry 0.5s ease forwards;
            animation-delay: calc(var(--index) * 0.1s);
            opacity: 0;
        }

        @keyframes fadeInEntry {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .book-entry:hover {
            transform: translateY(-5px);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .book-info {
            color: var(--text);
            font-family: "Inter", sans-serif;
            font-size: 16px;
        }

        .book-info div {
            margin-bottom: 8px;
            font-weight: 500;
        }

        .status {
            padding: 6px 18px;
            border-radius: 20px;
            color: #fff;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .status:hover {
            transform: scale(1.1);
        }

        .status.due {
            background: linear-gradient(90deg, #c22d2d 0%, #e74c3c 100%);
        }

        .status.returned {
            background: linear-gradient(90deg, #6aa933 0%, #8bc34a 100%);
        }

        .status.borrowed {
            background: linear-gradient(90deg, #3498db 0%, #4aa8e0 100%);
        }

        .empty-message {
            text-align: center;
            color: #fff;
            font-family: "Inter", sans-serif;
            font-size: 16px;
            font-weight: 500;
            padding: 10px;
            opacity: 0.9;
        }

        .star-rating {
            font-size: 20px;
            display: flex;
            gap: 5px;
            direction: rtl;
            unicode-bidi: normal;
            margin-top: 10px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            padding: 0 5px;
            cursor: pointer;
            transition: color 0.2s ease;
            text-shadow: -1px -1px 0 #121246, 1px -1px 0 #121246, -1px 1px 0 #121246, 1px 1px 0 #121246;
        }

        .star-rating input[type="radio"]:checked + label,
        .star-rating input[type="radio"]:checked ~ label {
            color: #ffca08;
            text-shadow: -1px -1px 0 #121246, 1px -1px 0 #121246, -1px 1px 0 #121246, 1px 1px 0 #121246;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffca08;
            text-shadow: -1px -1px 0 #121246, 1px -1px 0 #121246, -1px 1px 0 #121246, 1px 1px 0 #121246;
        }

        .rating-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .rating-submit {
            padding: 5px 10px;
            background: linear-gradient(90deg, #d4a373 0%, #b5835a 100%);
            color: var(--text);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .rating-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .rating-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: linear-gradient(90deg, #a68a5f 0%, #8f6b47 100%);
        }

        .rating-close {
            padding: 5px;
            background: linear-gradient(90deg, #d4a373 0%, #b5835a 100%);
            color: var(--text);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            line-height: 1;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rating-close:hover {
            transform: translateY(-2px);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .rating-close:focus {
            outline: 2px solid #ffca08;
            outline-offset: 2px;
        }

        .rating-display {
            color: var(--text);
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .rating-display span {
            color: #ffca08;
            font-weight: 600;
        }

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

            .transaction-page[aria-nav-expanded="true"] {
                padding-left: 240px; /* Adjusted to match sidebar width */
            }

            .rectangle-5 {
                height: 70px;
            }

            .transaction {
                font-size: 24px;
            }

            .due-amount-section {
                max-width: 600px;
                height: 80px;
            }

            .due-amount-here {
                font-size: 24px;
            }

            .pay-button {
                font-size: 14px;
                padding: 6px 15px;
            }

            .books-that-are-due {
                font-size: 22px;
            }

            .book-info {
                font-size: 14px;
            }

            .status {
                font-size: 12px;
                padding: 5px 12px;
            }

            .star-rating {
                font-size: 18px;
            }

            .star-rating label {
                text-shadow: -0.8px -0.8px 0 #121246, 0.8px -0.8px 0 #121246, -0.8px 0.8px 0 #121246, 0.8px 0.8px 0 #121246;
            }

            .star-rating input[type="radio"]:checked + label,
            .star-rating input[type="radio"]:checked ~ label,
            .star-rating label:hover,
            .star-rating label:hover ~ label {
                text-shadow: -0.8px -0.8px 0 #121246, 0.8px -0.8px 0 #121246, -0.8px 0.8px 0 #121246, 0.8px 0.8px 0 #121246;
            }

            .rating-submit {
                font-size: 12px;
                padding: 4px 8px;
            }

            .rating-close {
                font-size: 12px;
                width: 20px;
                height: 20px;
            }

            .rating-display {
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

            .transaction-page[aria-nav-expanded="true"] {
                padding-left: 200px; /* Adjusted to match sidebar width */
            }

            .rectangle-5 {
                height: 60px;
            }

            .transaction {
                font-size: 20px;
            }

            .due-amount-section {
                max-width: 100%;
                height: 70px;
                margin: 100px 10px 30px;
            }

            .due-amount-here {
                font-size: 20px;
                flex-direction: column;
                gap: 10px;
            }

            .pay-button {
                font-size: 12px;
                padding: 5px 10px;
            }

            .books-due-section, .payment-history-section {
                margin: 0 10px 30px;
                padding: 15px;
            }

            .books-that-are-due {
                font-size: 18px;
            }

            .book-entry {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 10px;
            }

            .book-info div {
                margin-bottom: 5px;
            }

            .status {
                font-size: 10px;
                padding: 4px 10px;
            }

            .empty-message {
                font-size: 14px;
            }

            .star-rating {
                font-size: 16px;
            }

            .star-rating label {
                text-shadow: -0.6px -0.6px 0 #121246, 0.6px -0.6px 0 #121246, -0.6px 0.6px 0 #121246, 0.6px 0.6px 0 #121246;
            }

            .star-rating input[type="radio"]:checked + label,
            .star-rating input[type="radio"]:checked ~ label,
            .star-rating label:hover,
            .star-rating label:hover ~ label {
                text-shadow: -0.6px -0.6px 0 #121246, 0.6px -0.6px 0 #121246, -0.6px 0.6px 0 #121246, 0.6px 0.6px 0 #121246;
            }

            .rating-form {
                flex-direction: column;
                align-items: flex-start;
            }

            .rating-submit {
                font-size: 12px;
                padding: 4px 8px;
            }

            .rating-close {
                font-size: 12px;
                width: 20px;
                height: 20px;
            }

            .rating-display {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="transaction-container">
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <div class="hover-area" role="button" aria-label="Open sidebar" tabindex="0"></div>
        <div class="sidebar" aria-expanded="false">
            @include('layouts.navigation')
        </div>
        <main class="transaction-page" aria-nav-expanded="false">
            <div class="rectangle-5">
                <div class="transaction">BORROWED BOOKS</div>
            </div>
            <section class="due-amount-section" aria-label="Due amount">
                <div class="due-amount-here">
                    Due Amount: ${{ number_format(max(0, $dueAmount), 2) }}
                    @if($dueAmount > 0)
                        <form action="{{ route('pay') }}" method="POST">
                            @csrf
                            <button type="submit" class="pay-button">Pay Now</button>
                        </form>
                    @endif
                </div>
            </section>
            <section class="books-due-section" aria-label="All borrowed books">
                <h2 class="books-that-are-due">All Borrowed Books</h2>
                @forelse($borrowedBooks as $book)
                    <article class="book-entry" style="--index: {{ $loop->index }}">
                        <div class="book-info">
                            <div class="book-name">Book: {{ $book->book->title }}</div>
                            <div class="due-date">Due: {{ $book->due_date->format('Y-m-d') }}</div>
                            @if($book->returned_at)
                                <div class="returned-date">Returned: {{ $book->returned_at->format('Y-m-d') }}</div>
                            @endif
                            @if($book->late_fee > 0 && !$book->returned_at)
                                <div class="late-fee">Late Fee: ${{ number_format($book->late_fee, 2) }}</div>
                            @endif
                            @if($book->returned_at)
                                @php
                                    $userRating = auth()->user()->ratings()->where('book_id', $book->book->id)->first()?->rating;
                                    $averageRating = $book->book->averageRating ?? 0;
                                @endphp
                                <form class="rating-form" action="{{ route('books.rate', $book->book->id) }}" method="POST" data-book-id="{{ $book->book->id }}">
                                    @csrf
                                    <div class="star-rating">
                                        <input type="radio" id="star5-{{ $book->id }}" name="rating" value="5" {{ $userRating == 5 ? 'checked' : '' }} required>
                                        <label for="star5-{{ $book->id }}" title="5 stars">★</label>
                                        <input type="radio" id="star4-{{ $book->id }}" name="rating" value="4" {{ $userRating == 4 ? 'checked' : '' }}>
                                        <label for="star4-{{ $book->id }}" title="4 stars">★</label>
                                        <input type="radio" id="star3-{{ $book->id }}" name="rating" value="3" {{ $userRating == 3 ? 'checked' : '' }}>
                                        <label for="star3-{{ $book->id }}" title="3 stars">★</label>
                                        <input type="radio" id="star2-{{ $book->id }}" name="rating" value="2" {{ $userRating == 2 ? 'checked' : '' }}>
                                        <label for="star2-{{ $book->id }}" title="2 stars">★</label>
                                        <input type="radio" id="star1-{{ $book->id }}" name="rating" value="1" {{ $userRating == 1 ? 'checked' : '' }}>
                                        <label for="star1-{{ $book->id }}" title="1 star">★</label>
                                    </div>
                                    <button type="submit" class="rating-submit">Submit Rating</button>
                                    <button type="button" class="rating-close" aria-label="Close rating form" data-book-id="{{ $book->book->id }}">×</button>
                                </form>
                            @endif
                        </div>
                        <div class="status {{ $book->returned_at ? 'returned' : ($book->due_date < now() && !$book->returned_at ? 'due' : 'borrowed') }}">
                            {{ $book->returned_at ? 'Returned' : ($book->due_date < now() && !$book->returned_at ? 'Due' : 'Borrowed') }}
                        </div>
                    </article>
                @empty
                    <p class="empty-message">You have not borrowed any books yet.</p>
                @endforelse
            </section>
            <section class="books-due-section" aria-label="Books that are due">
                <h2 class="books-that-are-due">Due</h2>
                @forelse($dueBooks as $book)
                    <article class="book-entry" style="--index: {{ $loop->index }}">
                        <div class="book-info">
                            <div class="book-name">Book: {{ $book->book->title }}</div>
                            <div class="due-date">Due: {{ $book->due_date->format('Y-m-d') }}</div>
                            <div class="late-fee">Late Fee: ${{ number_format($book->late_fee, 2) }}</div>
                        </div>
                        <div class="status due">Due</div>
                    </article>
                @empty
                    <p class="empty-message">No books are currently due.</p>
                @endforelse
            </section>
            <section class="payment-history-section" aria-label="Payment history">
                <h2 class="books-that-are-due">Payment History</h2>
                @forelse($paymentHistory as $payment)
                    <article class="book-entry" style="--index: {{ $loop->index }}">
                        <div class="book-info">
                            <div>Amount: ${{ number_format($payment->amount, 2) }}</div>
                            <div>Date: {{ $payment->created_at->format('Y-m-d H:i') }}</div>
                            <div>Description: {{ $payment->description ?? 'N/A' }}</div>
                        </div>
                    </article>
                @empty
                    <p class="empty-message">No payment history available.</p>
                @endforelse
            </section>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverArea = document.querySelector('.hover-area');
            const sidebar = document.querySelector('.sidebar');
            const transactionPage = document.querySelector('.transaction-page');
            const mobileNavToggle = document.querySelector('.mobile-nav-toggle');

            // Mobile navigation toggle
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                    const newExpandedState = !isExpanded;
                    sidebar.setAttribute('aria-expanded', newExpandedState);
                    mobileNavToggle.setAttribute('aria-expanded', newExpandedState);
                    transactionPage.setAttribute('aria-nav-expanded', newExpandedState);
                    mobileNavToggle.innerHTML = `<i class="fa ${newExpandedState ? 'fa-times' : 'fa-bars'}"></i>`;
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && sidebar.getAttribute('aria-expanded') === 'true' && !sidebar.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        mobileNavToggle.setAttribute('aria-expanded', 'false');
                        transactionPage.setAttribute('aria-nav-expanded', 'false');
                        mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                    }
                });

                // Close sidebar when clicking a link inside navigation
                sidebar.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            sidebar.setAttribute('aria-expanded', 'false');
                            mobileNavToggle.setAttribute('aria-expanded', 'false');
                            transactionPage.setAttribute('aria-nav-expanded', 'false');
                            mobileNavToggle.innerHTML = `<i class="fa fa-bars"></i>`;
                        }
                    });
                });
            }

            // Sidebar hover navigation for desktop
            if (hoverArea) {
                hoverArea.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        transactionPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                hoverArea.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768 && !sidebar.matches(':hover')) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        transactionPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                sidebar.addEventListener('mouseenter', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'true');
                        transactionPage.setAttribute('aria-nav-expanded', 'true');
                    }
                });

                sidebar.addEventListener('mouseleave', function() {
                    if (window.innerWidth > 768) {
                        sidebar.setAttribute('aria-expanded', 'false');
                        transactionPage.setAttribute('aria-nav-expanded', 'false');
                    }
                });

                hoverArea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ' && window.innerWidth > 768) {
                        e.preventDefault();
                        const isExpanded = sidebar.getAttribute('aria-expanded') === 'true';
                        sidebar.setAttribute('aria-expanded', !isExpanded);
                        transactionPage.setAttribute('aria-nav-expanded', !isExpanded);
                    }
                });
            }

            // Rating form submission handling
            const ratingForms = document.querySelectorAll('.rating-form');
            ratingForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    const bookId = form.getAttribute('data-book-id');
                    const submitButton = form.querySelector('.rating-submit');
                    if (submitButton) {
                        submitButton.textContent = 'Thanks for Rating';
                        submitButton.disabled = true;
                        form.style.display = 'none';
                    }
                    // Allow form submission to proceed
                });
            });

            // Rating form close handling
            const closeButtons = document.querySelectorAll('.rating-close');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = button.getAttribute('data-book-id');
                    const form = document.querySelector(`.rating-form[data-book-id="${bookId}"]`);
                    if (form) {
                        form.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>