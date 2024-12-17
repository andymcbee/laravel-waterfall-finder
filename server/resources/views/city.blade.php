<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $city->name }}</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-gray-900 hover:text-gray-700 transition">
                Waterfalls of Canada
            </a>

            <nav class="space-x-6">
                <a href="#" class="text-gray-600 hover:text-gray-900 transition">Home</a>
                <a href="#" class="text-gray-600 hover:text-gray-900 transition">About</a>
                <a href="#" class="text-gray-600 hover:text-gray-900 transition">Contact</a>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-12">
        {{-- Hero Section --}}
        <section class="grid md:grid-cols-2 gap-12 items-center mb-16">
            {{-- Left Column: Text --}}
            <div>
                <h1 class="text-4xl font-bold mb-6 text-gray-900">
                    Explore Waterfalls in {{ $city->name }}
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Your engaging introduction paragraph goes here. Highlight your unique value proposition and what makes you stand out.
                </p>
            </div>

            <div>
                <div id="map" class="w-full h-[400px] rounded-xl shadow-lg"></div>
            </div>
        </section>

        <section>
            <h2 class="text-3xl font-bold mb-8 text-center">All Waterfalls near {{ $city->name }}</h2>
            
            <div class="grid md:grid-cols-3 gap-6">
               

                @foreach($waterfalls as $waterfall)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold mb-3 text-gray-900">
                            {{ $waterfall->name }}
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ $waterfall->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}
                        </p>
                        
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    {{-- Leaflet JS --}}
    
    <script>
        const map = L.map('map').setView([{{ $city->latitude }}, {{ $city->longitude }}], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

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