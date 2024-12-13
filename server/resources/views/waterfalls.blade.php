<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 500px; /* Set a height for your map */
        }
    </style>
    <title>Waterfalls</title>
</head>
<body>
    <div id="map"></div>
    <input type="text" id="citySearch" placeholder="Search cities...">
    <div id="searchResults"></div>

    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        @foreach ($waterfalls as $waterfall)
            L.marker([{{ $waterfall->latitude }}, {{ $waterfall->longitude }}]).addTo(map)
                .bindPopup('<strong><a href="/waterfalls/{{ $waterfall->id }}">{{ $waterfall->name }}</a></strong><br>{{ $waterfall->location }}');
        @endforeach
    </script>

    <script>
        document.getElementById('citySearch').addEventListener('input', function() {
            var query = this.value;
            fetch(`/api/cities/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    var container = document.getElementById('searchResults');
                    container.innerHTML = ''; // Clear previous results
                    data.forEach(city => {
                        var div = document.createElement('div');
                        div.textContent = city.name;
                        div.style.cursor = 'pointer'; // Adds a pointer cursor on hover
                        div.onclick = function() {
                            document.getElementById('citySearch').value = city.name; // Update the input field with the city name
                            map.panTo(new L.LatLng(city.latitude, city.longitude)); // Pan the map to the selected city
                            container.style.display = 'none'; // Hide the search results container
                        };
                        container.appendChild(div);
                    });
                    if (data.length > 0) {
                        container.style.display = 'block'; // Only display the container if there are results
                    } else {
                        container.style.display = 'none'; // Hide if no results
                    }
                });
        });

        // Optionally, add an event listener to refocus and show results when the input is clicked
        document.getElementById('citySearch').addEventListener('focus', function() {
            var container = document.getElementById('searchResults');
            if (this.value.length > 0 && container.innerHTML !== '') {
                container.style.display = 'block'; // Show the container if there are items and the field is not empty
            }
        });

        // Add a listener to hide the results if the user clicks anywhere else on the page
        document.addEventListener('click', function(event) {
            var container = document.getElementById('searchResults');
            if (!container.contains(event.target) && event.target !== document.getElementById('citySearch')) {
                container.style.display = 'none'; // Hide the search results
            }
        });
    </script>
   
</body>
</html>
