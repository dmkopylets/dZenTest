<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Commenting Demo' }}</title>
    <meta name="author" content="TheCodeholic">
    <meta name="description" content="{{ $metaDescription }}">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-family-karla">


<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{route('home')}}">
            Commenting Demo
        </a>
        <p class="text-lg text-gray-600">

        </p>
    </div>
</header>


<div class="container mx-auto py-6">

    {{ $slot }}

</div>

<footer class="w-full border-t bg-white pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="uppercase py-6">&copy; myblog.com</div>
    </div>
</footer>

@livewireScripts
</body>
</html>
