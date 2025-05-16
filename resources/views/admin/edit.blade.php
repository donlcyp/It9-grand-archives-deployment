<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Grand Archives</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    @vite(['resources/css/app.css'])

    <style>
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
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #ded9c3;
            border-radius: 8px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #121246;
            font-size: 30px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #121246;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
            background: #d9d9d9;
            color: #121246;
            outline: 2px solid #121246;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: 2px solid #b5835a;
        }

        .form-group input[type="file"] {
            display: none; /* Hide default file input */
        }

        .current-image {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .current-image p {
            color: #121246;
            margin-bottom: 5px;
        }

        .current-image img {
            max-width: 500px;
            border-radius: 4px;
            border: 1px solid #121246;
            align-self: center;
        }

        .change-cover-btn {
            display: inline-block;
            width: 100%;
            padding: 8px;
            background: #d4a373;
            color: #ffffff !important; /* White text, override any conflicting styles */
            border: none;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
            text-decoration: none;
        }

        .change-cover-btn:hover {
            background: #b5835a;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #d4a373;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .submit-btn:hover {
            background: #b5835a;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            background: #d4a373;
            color: #ffffff;
            border-radius: 4px;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #b5835a;
        }

        .error {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 5px;
        }

        .error-message {
            background: #ff6b6b;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Enhanced Genre Checkboxes Styling */
        .genre-controls {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .genre-controls button {
            padding: 5px 10px;
            background: #d4a373;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }

        .genre-controls button:hover {
            background: #b5835a;
        }

        .genre-search {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
            background: #ffffff;
            color: #121246;
            font-size: 0.9rem;
            outline: 2px solid #121246;
        }

        .genre-search:focus {
            outline: 2px solid #b5835a;
            background: #e0e0e0;
            box-shadow: 0 0 5px rgba(212, 163, 115, 0.5);
        }

        .genre-checkboxes {
            max-height: 150px;
            overflow-y: auto;
            padding: 10px;
            background: #ececec;
            border: 1px solid #b5835a;
            border-radius: 4px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
            scrollbar-width: thin;
            scrollbar-color: #d4a373 #ececec;
        }

        .genre-checkboxes::-webkit-scrollbar {
            width: 8px;
        }

        .genre-checkboxes::-webkit-scrollbar-track {
            background: #ececec;
            border-radius: 4px;
        }

        .genre-checkboxes::-webkit-scrollbar-thumb {
            background: #d4a373;
            border-radius: 4px;
        }

        .genre-checkboxes label {
            display: flex;
            align-items: center;
            padding: 8px 5px;
            color: #121246;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .genre-checkboxes label:hover {
            background: rgba(212, 163, 115, 0.15);
        }

        .genre-checkboxes input[type="checkbox"] {
            margin-right: 12px;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .genre-checkboxes input[type="checkbox"]:focus {
            outline: 2px solid #d4a373;
            outline-offset: 2px;
        }

        .selected-counter {
            font-size: 0.85rem;
            color: #121246;
            margin-top: 5px;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .form-container {
                margin: 20px;
                padding: 15px;
            }

            .genre-checkboxes {
                max-height: 120px;
                padding: 8px;
            }

            .genre-controls button {
                padding: 4px 8px;
                font-size: 0.8rem;
            }

            .genre-search {
                font-size: 0.8rem;
                padding: 6px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                font-size: 0.9rem;
                padding: 6px;
            }

            .submit-btn,
            .back-btn,
            .change-cover-btn {
                padding: 8px;
                font-size: 0.9rem;
            }

            .selected-counter {
                font-size: 0.8rem;
            }

            .current-image img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="{{ route('admin.index') }}" class="back-btn">Back to Dashboard</a>
        <h2>Edit Book</h2>
        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}">
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}">
                @error('author')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}">
                @error('publisher')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Book Description</label>
                <textarea name="description" id="description" rows="8" style="width: 100%;">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <div class="current-image">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                </div>
                <input type="file" name="cover_image" id="cover_image">
                <label for="cover_image" class="change-cover-btn">Change Cover</label>
                @error('cover_image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="genres">Genres</label>
                <div class="genre-controls">
                    <button type="button" onclick="selectAllGenres()">Select All</button>
                    <button type="button" onclick="clearAllGenres()">Clear All</button>
                </div>
                <input type="text" class="genre-search" placeholder="Search genres..." onkeyup="filterGenres()">
                <div class="genre-checkboxes" role="listbox" aria-label="Select genres">
                    @foreach ($genres as $genre)
                        <label role="option">
                            <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}" {{ (collect(old('genre_ids', $book->genres->pluck('id')))->contains($genre->id)) ? 'checked' : '' }} onchange="updateCounter()">
                            {{ $genre->name }}
                        </label>
                    @endforeach
                </div>
                <div class="selected-counter" id="selectedCounter">Selected: 0</div>
                @error('genre_ids')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-btn">Update Book</button>
        </form>
    </div>

    <script>
        function selectAllGenres() {
            const checkboxes = document.querySelectorAll('input[name="genre_ids[]"]');
            checkboxes.forEach(checkbox => {
                if (checkbox.parentElement.style.display !== 'none') {
                    checkbox.checked = true;
                }
            });
            updateCounter();
        }

        function clearAllGenres() {
            const checkboxes = document.querySelectorAll('input[name="genre_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateCounter();
        }

        function filterGenres() {
            const searchInput = document.querySelector('.genre-search').value.toLowerCase();
            const labels = document.querySelectorAll('.genre-checkboxes label');

            labels.forEach(label => {
                const text = label.textContent.toLowerCase();
                label.style.display = text.includes(searchInput) ? '' : 'none';
            });
            updateCounter();
        }

        function updateCounter() {
            const selectedCount = document.querySelectorAll('input[name="genre_ids[]"]:checked').length;
            document.getElementById('selectedCounter').textContent = `Selected: ${selectedCount}`;
        }

        // Initialize counter on page load
        document.addEventListener('DOMContentLoaded', updateCounter);
    </script>
</body>
</html>