<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Grand Archives</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121246;
            color: #121246;
            margin: 0;
            padding: 10px;
            font-size: clamp(14px, 3.5vw, 16px);
        }
        .header {
            background: #ded9c3;
            padding: 15px;
            text-align: center;
            font-size: clamp(18px, 5vw, 22px);
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        .button {
            background: linear-gradient(90deg, #b5835a, #8c5f3f);
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 15px;
            transition: transform 0.1s ease, box-shadow 0.3s ease;
            font-size: clamp(14px, 3.5vw, 16px);
            display: inline-block;
            touch-action: manipulation;
        }
        .button:hover, .button:active {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(181, 131, 90, 0.3);
        }
        .section {
            margin-bottom: 30px;
            background: #ded9c3;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .section h2 {
            color: #121246;
            margin-bottom: 12px;
            font-size: clamp(16px, 4.5vw, 20px);
        }
        .toggle-button {
            display: none;
            background: #b5835a;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            font-size: clamp(14px, 3.5vw, 16px);
            margin-bottom: 10px;
            touch-action: manipulation;
            position: relative;
        }
        .toggle-button::after {
            content: '▼';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
        }
        .toggle-button.active::after {
            transform: translateY(-50%) rotate(180deg);
        }
        .toggle-button:hover, .toggle-button:active {
            background: #8c5f3f;
        }
        .collapsible-content {
            max-height: none;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 1;
        }
        .book-select-container, .user-select-container {
            display: none;
            margin-bottom: 15px;
        }
        .book-select-container label, .user-select-container label {
            display: block;
            color: #121246;
            font-size: clamp(13px, 3.2vw, 15px);
            margin-bottom: 5px;
        }
        .book-select-container select, .user-select-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #b5835a;
            border-radius: 5px;
            background: #f0f0e4;
            font-size: clamp(13px, 3.2vw, 15px);
            color: #121246;
            cursor: pointer;
            touch-action: manipulation;
        }
        .book-select-container select:focus, .user-select-container select:focus {
            outline: none;
            border-color: #8c5f3f;
            box-shadow: 0 0 5px rgba(181, 131, 90, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #f0f0e4;
            border-radius: 5px;
            overflow: hidden;
            display: block;
        }
        .scrollable-table {
            max-height: 300px;
            overflow-y: auto;
            display: block;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #b5835a;
            display: block;
            width: 100%;
            box-sizing: border-box;
        }
        th {
            background: #b5835a;
            color: #ffffff;
            font-weight: bold;
            display: none;
        }
        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            color: #b5835a;
            margin-bottom: 5px;
        }
        tr {
            display: block;
            margin-bottom: 15px;
            border-bottom: 2px solid #b5835a;
        }
        tr.hidden {
            display: none;
        }
        tr:hover {
            background: #e0dcc5;
        }
        .action-button {
            background: #b5835a;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px 5px 5px 0;
            transition: background 0.3s ease;
            font-size: clamp(13px, 3.2vw, 15px);
            touch-action: manipulation;
        }
        .action-button:hover, .action-button:active {
            background: #8c5f3f;
        }
        .action-button.delete {
            background: #ff3333;
        }
        .action-button.delete:hover, .action-button.delete:active {
            background: #cc0000;
        }
        .paid-button {
            background: #6aa933;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: clamp(13px, 3.2vw, 15px);
            touch-action: manipulation;
        }
        .paid-button:hover, .paid-button:active {
            background: #558b2f;
        }
        .message {
            text-align: center;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: clamp(13px, 3.2vw, 15px);
        }
        .message.success {
            background: #6aa933;
            color: #fff;
        }
        .message.error {
            background: #ff3333;
            color: #fff;
        }
        .note {
            color: #121246;
            font-style: italic;
            margin-top: 8px;
            text-align: center;
            font-size: clamp(12px, 3vw, 14px);
        }
        .genres-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 10px;
        }
        .genre-card {
            background: #f0f0e4;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .genre-card:hover, .genre-card:active {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(181, 131, 90, 0.3);
        }
        .genre-card h3 {
            margin: 0 0 8px;
            font-size: clamp(14px, 3.5vw, 16px);
            color: #121246;
        }
        .genre-card p {
            margin: 0 0 12px;
            font-size: clamp(12px, 3vw, 14px);
            color: #555;
        }
        .genre-card .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .search-container {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }
        .search-container input {
            padding: 10px 35px 10px 12px;
            width: 100%;
            border: 1px solid #b5835a;
            border-radius: 20px;
            font-size: clamp(13px, 3.2vw, 15px);
            background: #f0f0e4;
            transition: border-color 0.3s ease;
        }
        .search-container input:focus {
            outline: none;
            border-color: #8c5f3f;
            box-shadow: 0 0 5px rgba(181, 131, 90, 0.5);
        }
        .search-container input::placeholder {
            color: #999;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .search-container input:focus::placeholder {
            transform: translateX(10px);
            opacity: 0;
        }
        .search-container .clear-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b5835a;
            font-size: 1.1rem;
            cursor: pointer;
            display: none;
        }
        .search-container .clear-search:hover, .search-container .clear-search:active {
            color: #8c5f3f;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            overflow-y: auto;
        }
        .modal.show {
            opacity: 1;
        }
        .modal-content {
            background: #ded9c3;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 90%;
            width: 100%;
            margin: 10px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        .modal.show .modal-content {
            transform: scale(1);
        }
        .modal-content p {
            margin-bottom: 12px;
            font-size: clamp(13px, 3.2vw, 15px);
            color: #121246;
        }
        .modal-content .warning {
            color: #ff3333;
            font-size: clamp(12px, 3vw, 14px);
            margin-bottom: 15px;
            font-style: italic;
        }
        .modal-content button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: clamp(13px, 3.2vw, 15px);
            touch-action: manipulation;
        }
        .modal-content .confirm {
            background: #ff3333;
            color: #fff;
        }
        .modal-content .confirm:hover, .modal-content .confirm:active {
            background: #cc0000;
        }
        .modal-content .cancel {
            background: #6aa933;
            color: #fff;
        }
        .modal-content .cancel:hover, .modal-content .cancel:active {
            background: #558b2f;
        }
        .empty-state {
            background: #f0f0e4;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .empty-state p {
            margin: 0 0 10px;
        }
        .empty-state a {
            color: #b5835a;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .genres-container {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .genre-card {
                padding: 10px;
            }
            .genre-card h3 {
                font-size: clamp(13px, 3.2vw, 15px);
            }
            .genre-card p {
                font-size: clamp(12px, 3vw, 14px);
            }
            .genre-card .actions button {
                padding: 6px 12px;
                font-size: clamp(12px, 3vw, 14px);
            }
            .search-container input {
                max-width: 100%;
            }
            .button, .action-button, .paid-button {
                width: 100%;
                margin: 5px 0;
            }
            .modal-content {
                padding: 15px;
                margin: 5px;
            }
            .toggle-button {
                display: block;
            }
            .collapsible-content {
                max-height: 0;
                opacity: 0;
            }
            .collapsible-content.active {
                max-height: 1000px;
                opacity: 1;
            }
            .book-select-container, .user-select-container {
                display: block;
            }
            table {
                display: none;
            }
            table.active {
                display: block;
            }
        }
        @media (min-width: 769px) {
            table {
                display: table;
            }
            .scrollable-table {
                max-height: none;
                overflow-y: visible;
            }
            th, td {
                display: table-cell;
                width: auto;
            }
            th {
                display: table-cell;
            }
            td::before {
                content: none;
            }
            tr {
                display: table-row;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">Admin Dashboard</div>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <!-- Book Inventory Section -->
    <div class="section">
        <button class="toggle-button" aria-expanded="false" aria-controls="book-inventory-content">Book Inventory</button>
        <div class="collapsible-content" id="book-inventory-content">
            <h2>Book Inventory</h2>
            <a href="{{ route('admin.create') }}"><button class="button">Add New Book</button></a>
            <a href="{{ route('admin.suppliers.create') }}"><button class="button">Add New Supplier</button></a>
            @if($books->isEmpty())
                <p class="note">No books available in the inventory.</p>
            @else
                <div class="book-select-container">
                    <label for="bookSelect">Select a Book</label>
                    <select id="bookSelect" aria-label="Select a book to view and edit">
                        <option value="all">All Books</option>
                        @foreach($books as $book)
                            <option value="{{ $book->title }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                <table id="bookInventoryTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Quantity in Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr data-title="{{ $book->title }}">
                                <td data-label="Title">{{ $book->title }}</td>
                                <td data-label="Author">{{ $book->author ?? 'Unknown' }}</td>
                                <td data-label="Genre">
                                    @if($book->genres->isNotEmpty())
                                        {{ $book->genres->pluck('name')->join(', ') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td data-label="Quantity">{{ $book->quantity }}</td>
                                <td data-label="Actions">
                                    <a href="{{ route('admin.edit', $book) }}"><button class="action-button">Edit</button></a>
                                    <a href="{{ route('admin.adjustStock', $book) }}"><button class="action-button">Adjust Stock</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="note">Click "Adjust Stock" to view stock history for a book.</p>
            @endif
        </div>
    </div>

    <!-- Borrowed Books Section -->
    <div class="section">
        <button class="toggle-button" aria-expanded="false" aria-controls="borrowed-books-content">Borrowed Books</button>
        <div class="collapsible-content" id="borrowed-books-content">
            <h2>Borrowed Books</h2>
            @if($borrowedBooks->isEmpty())
                <div class="empty-state">
                    <p class="note">No borrowed books at the moment.</p>
                    <p>Check if borrow records are up to date or encourage users to borrow books.</p>
                    <a href="{{ route('admin.dashboard') }}">Refresh Dashboard</a>
                </div>
            @else
                <div class="user-select-container">
                    <label for="userSelect">Select a User</label>
                    <select id="userSelect" aria-label="Select a user to view their borrowed books">
                        <option value="all">All Users</option>
                        @foreach($borrowedBooks->pluck('user.name')->unique() as $userName)
                            <option value="{{ $userName }}">{{ $userName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="scrollable-table">
                    <table id="borrowedBooksTable">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>User</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Borrowed At</th>
                                <th>Due Date</th>
                                <th>Returned At</th>
                                <th>Late Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowedBooks as $borrowedBook)
                                <tr data-user="{{ $borrowedBook->user->name ?? 'Unknown' }}">
                                    <td data-label="Book Title">{{ $borrowedBook->book->title ?? 'N/A' }}</td>
                                    <td data-label="User">{{ $borrowedBook->user->name ?? 'Unknown' }}</td>
                                    <td data-label="Contact No">{{ $borrowedBook->user->contact_no ?? 'N/A' }}</td>
                                    <td data-label="Address">{{ $borrowedBook->user->address ?? 'N/A' }}</td>
                                    <td data-label="Status">{{ ucfirst($borrowedBook->status) ?? 'N/A' }}</td>
                                    <td data-label="Borrowed At">{{ $borrowedBook->borrowed_at ? $borrowedBook->borrowed_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td data-label="Due Date">{{ $borrowedBook->due_date ? $borrowedBook->due_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td data-label="Returned At">{{ $borrowedBook->returned_at ? $borrowedBook->returned_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td data-label="Late Fee">${{ number_format($borrowedBook->late_fee ?? 0, 2) }}</td>
                                    <td data-label="Actions">
                                        @if($borrowedBook->status === 'borrowed')
                                            <form action="{{ route('admin.updateBorrowStatus', $borrowedBook) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="returned">
                                                <button type="submit" class="action-button">Mark as Returned</button>
                                            </form>
                                        @endif
                                        @if(($borrowedBook->late_fee ?? 0) > 0)
                                            <form action="{{ route('admin.markAsPaid', $borrowedBook) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="paid-button">Mark as Paid</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="note">Use actions to mark books as returned or fees as paid.</p>
            @endif
        </div>
    </div>

    <!-- Genres Section -->
    <div class="section">
        <button class="toggle-button" aria-expanded="false" aria-controls="genres-content">Manage Genres</button>
        <div class="collapsible-content" id="genres-content">
            <h2>Manage Genres</h2>
            <a href="{{ route('admin.genres.create') }}"><button class="button">Add New Genre</button></a>
            @if($genres->isEmpty())
                <p class="note">No genres available.</p>
            @else
                <div class="search-container">
                    <input type="text" id="genreSearch" placeholder="Search genres..." onkeyup="searchGenres()">
                    <button class="clear-search" onclick="clearSearch()">✖</button>
                </div>
                <div class="genres-container" id="genresContainer">
                    @foreach($genres as $genre)
                        <div class="genre-card">
                            <h3>{{ $genre->name }}</h3>
                            <p>Books: {{ $genre->books->count() }}</p>
                            <div class="actions">
                                <a href="{{ route('admin.genres.edit', $genre) }}"><button class="action-button">Edit</button></a>
                                <button class="action-button delete" onclick="openModal('{{ $genre->id }}', '{{ $genre->name }}', {{ $genre->books->count() }})">Delete</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete the genre "<span id="genreName"></span>"?</p>
            <p class="warning" id="genreWarning"></p>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm">Yes, Delete</button>
                <button type="button" class="cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        // Search functionality for genres
        function searchGenres() {
            const input = document.getElementById('genreSearch').value.toLowerCase();
            const container = document.getElementById('genresContainer');
            const cards = container.getElementsByClassName('genre-card');
            const clearButton = document.querySelector('.clear-search');

            clearButton.style.display = input ? 'block' : 'none';

            for (let i = 0; i < cards.length; i++) {
                const genreName = cards[i].querySelector('h3').textContent.toLowerCase();
                if (genreName.includes(input)) {
                    cards[i].style.display = '';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }

        // Clear search input
        function clearSearch() {
            const input = document.getElementById('genreSearch');
            input.value = '';
            const clearButton = document.querySelector('.clear-search');
            clearButton.style.display = 'none';
            searchGenres();
        }

        // Modal functionality for delete confirmation
        function openModal(genreId, genreName, booksCount) {
            const modal = document.getElementById('deleteModal');
            const genreNameSpan = document.getElementById('genreName');
            const genreWarning = document.getElementById('genreWarning');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/genres/${genreId}`;
            genreNameSpan.textContent = genreName;
            genreWarning.textContent = booksCount > 0 ? `Warning: This genre is associated with ${booksCount} book(s). Deleting it may affect those books.` : '';
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('show'), 10);
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        // Toggle functionality for collapsible sections
        document.querySelectorAll('.toggle-button').forEach(button => {
            button.addEventListener('click', () => {
                const content = document.getElementById(button.getAttribute('aria-controls'));
                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                button.setAttribute('aria-expanded', !isExpanded);
                content.classList.toggle('active');
                button.classList.toggle('active');
            });
        });

        // Book selection functionality
        document.getElementById('bookSelect')?.addEventListener('change', function() {
            const selectedTitle = this.value;
            const table = document.getElementById('bookInventoryTable');
            const rows = table.querySelectorAll('tbody tr');

            if (selectedTitle === 'all') {
                table.classList.add('active');
                rows.forEach(row => row.classList.remove('hidden'));
            } else {
                table.classList.add('active');
                rows.forEach(row => {
                    if (row.getAttribute('data-title') === selectedTitle) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            }
        });

        // User selection functionality for borrowed books
        document.getElementById('userSelect')?.addEventListener('change', function() {
            const selectedUser = this.value;
            const table = document.getElementById('borrowedBooksTable');
            const rows = table.querySelectorAll('tbody tr');

            if (selectedUser === 'all') {
                table.classList.add('active');
                rows.forEach(row => row.classList.remove('hidden'));
            } else {
                table.classList.add('active');
                rows.forEach(row => {
                    if (row.getAttribute('data-user') === selectedUser) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>