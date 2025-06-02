<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang di Lapor PKL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center text-gray-900">

    <div class="max-w-md w-full p-10 bg-white rounded-2xl shadow-lg border border-gray-200 text-center">
        <h1 class="text-4xl font-extrabold mb-4 tracking-tight">
            Selamat Datang di <span class="text-gray-700">Lapor PKL</span>
        </h1>
        <p class="text-gray-600 mb-10">
            Platform untuk melaporkan dan memantau pkl anda.
        </p>

        <div class="flex justify-center gap-6">
            <a href="{{ route('login') }}"
               class="px-8 py-3 rounded-full bg-gray-900 text-white font-semibold shadow-md
                      hover:bg-gray-700 transition duration-300">
                Masuk
            </a>
            <a href="{{ route('register') }}"
               class="px-8 py-3 rounded-full border-2 border-gray-900 text-gray-900 font-semibold
                      hover:bg-gray-900 hover:text-white transition duration-300">
                Daftar
            </a>
        </div>
    </div>

</body>
</html>
