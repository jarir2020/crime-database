<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('logo/app.jpg') }}" type="image/x-icon">
    <title>Crime Database</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://via.placeholder.com/1500x900') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            text-align: center;
            color: white;
            padding: 40px;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for readability */
            border-radius: 8px;
        }

        .text-5xl {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
        }

        h1 {
            font-size: 4rem;
            color: #ffffff;
            margin-bottom: 20px;
        }

        a {
            color: #ffffff;
            text-decoration: none;
            background-color: #1D4ED8; /* Blue */
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2563EB;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
