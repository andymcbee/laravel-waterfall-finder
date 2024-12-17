<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $city->name }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.css" rel="stylesheet" />
    <style>
        #map {
            height: 300px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">


<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Container -->
    <div class="container mx-auto p-4 space-y-8">
        <!-- Header Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Title and Info -->
            <div>
                <h1 class="text-3xl font-bold mb-4">Waterfalls Near {{ $city->name }}</h1>
                <p class="text-gray-600">Country: <span class="font-semibold">{{ $city->country_name }}</span></p>
                <p class="text-gray-600">{{ $city->slug}}</p>
                <p class="text-gray-600">Explore the most stunning waterfalls in the area and plan your adventure!</p>
            </div>
            <!-- Map -->
            <div>
                <div id="map" class="rounded shadow-lg"></div>
            </div>
        </div>

        <!-- Waterfall Cards -->

        <div class='flex justify-center flex-col items-center'>
            <h2 class="text-2xl font-bold mb-4">City Waterfall Counts</h2>
            <div class="grid grid-cols-1 gap-6">
                @foreach ($waterfalls as $waterfall)
                    <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $waterfall->name }}
                        </h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {{ $waterfall->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}
                        </p>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Initialize the Leaflet Map
        const map = L.map('map').setView([{{ $city->latitude }}, {{ $city->longitude }}], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors',
        }).addTo(map);

        // Add markers for each waterfall (if you have coordinates for them)
        @foreach ($waterfalls as $waterfall)
            @if ($waterfall->latitude && $waterfall->longitude)
                L.marker([{{ $waterfall->latitude }}, {{ $waterfall->longitude }}])
                    .addTo(map)
                    .bindPopup('<strong>{{ $waterfall->name }}</strong><br>{{ $waterfall->description ?? "No description available" }}');
            @endif
        @endforeach
    </script>
</body>
</html>
