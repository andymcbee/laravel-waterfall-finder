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
        <div>
            <h2 class="text-2xl font-bold mb-4">City Waterfall Counts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($waterfalls as $waterfall)
                    <div class="bg-white p-6 rounded shadow-lg max-w-xs mx-auto">
                        <h3 class="text-lg font-bold mb-2">{{ $waterfall->name }}</h3>
                        <p class="text-gray-600 text-sm">Description: {{ $waterfall->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
                        <p class="text-gray-600 text-sm">Type: {{ $waterfall->type ?? 'Plunge' }}</p>
                        <p class="text-gray-600 text-sm">Height: {{ $waterfall->height ?? '100 ft' }}</p>
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
