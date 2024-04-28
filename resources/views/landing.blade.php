<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    @vite('resources/css/app.css')

    <style>
        .curve {}
    </style>
</head>
<body>
    <div class="bg-gradient-to-br from-main-color/20">
        <header class="container font-inter mx-auto px-10 md:px-24 py-4">
            <h3 class="text-main-color font-semibold text-2xl md:text-4xl">ZooVenture</h3>
        </header>
        <main class="px-10 md:px-24 pt-10 md:pt-16 flex">
            <div>
                <h1 class="text-6xl md:text-7xl font-bold mb-9 md:mb-11">Get a new experience with our application</h1>
                <img src="/assets/curve.svg" alt="" width="90%">
                <h3 class="text-lg md:text-xl font-medium mt-9 md:mt-11 curve-main">Kami di sini membantu anda untuk menemukan dan mempelajari setiap satwa di kebun binatang Surabaya.</h3>

                <div class="flex mt-10 gap-4">
                    <a href="{{ route('code.enter') }}" class="px-4 py-2 bg-main-color rounded-full text-white font-medium">Mulai Sekarang</a>
                    <a href="" class="px-4 py-2 font-medium"><i class="ti ti-player-play mr-1"></i> Lihat Video</a>
                </div>
            </div>
            <div class="hidden md:flex w-full justify-end">
                <img src="/assets/hero.png" alt="" class="h-full">
            </div>
        </main>
    </div>
    <div class="flex flex-col md:flex-row px-10 md:px-44 py-10">
        <div>
            <h3 class="text-3xl font-bold">Kemudahan yang akan didapatkan</h3>
            <div class="flex flex-col gap-4 mt-10">
                <p class="text-xl font-medium">
                    <i class="ti ti-rosette-discount-check-filled text-main-color text-2xl"></i>
                    Mudah menjelajahi Area
                </p>
                <p class="text-xl font-medium">
                    <i class="ti ti-rosette-discount-check-filled text-main-color text-2xl"></i>
                    Mengetahui beragram satwa
                </p>
                <p class="text-xl font-medium">
                    <i class="ti ti-rosette-discount-check-filled text-main-color text-2xl"></i>
                    Menemukan satwa dengan sangat mudah
                </p>
                <p class="text-xl font-medium">
                    <i class="ti ti-rosette-discount-check-filled text-main-color text-2xl"></i>
                    Navigasi dengan lebih leluasa
                </p>
                <p class="text-xl font-medium">
                    <i class="ti ti-rosette-discount-check-filled text-main-color text-2xl"></i>
                    Harga layanan yang lebih terjangkau
                </p>
            </div>
        </div>
        <div class="flex w-full justify-center">
            <img src="/assets/mockup.png" class="w-[100%] md:w-[80%]">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite('resources/js/app.js')
</body>
</html>
