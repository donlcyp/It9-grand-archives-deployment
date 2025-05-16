<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier - Grand Archives</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" />
    @vite(['resources/css/app.css'])

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "Inter", sans-serif;
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

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
            background: #d9d9d9;
            color: #121246;
            outline: 2px solid #121246;
        }

        .form-group input:focus {
            outline: 2px solid #b5835a;
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

        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .message.success {
            background: #6aa933;
            color: #fff;
        }

        .message.error {
            background: #ff6b6b;
            color: #fff;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .form-container {
                margin: 20px;
                padding: 15px;
            }

            .form-group input {
                font-size: 0.9rem;
                padding: 6px;
            }

            .submit-btn,
            .back-btn {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="{{ route('admin.index') }}" class="back-btn">Back to Dashboard</a>
        <h2>Add Supplier</h2>
        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="message error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Supplier Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required />
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" />
                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" />
                @error('contact_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-btn">Add Supplier</button>
        </form>
    </div>
</body>
</html>