let map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let marker = L.marker([51.505, -0.09]).addTo(map);

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        const latLng = [lat, lng];
        map.setView(latLng, 13);
        marker.setLatLng(latLng);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        reverseGeocode(lat, lng);
    }, function () {
        document.getElementById('error-message').textContent = "Unable to retrieve your location";
    });
} else {
    document.getElementById('error-message').textContent = "Geolocation is not supported by your browser";
}

map.on('click', function (e) {
    const latLng = e.latlng;

    marker.setLatLng(latLng);
    map.setView(latLng);

    document.getElementById('latitude').value = latLng.lat;
    document.getElementById('longitude').value = latLng.lng;

    reverseGeocode(latLng.lat, latLng.lng);
});

document.getElementById('address').addEventListener('blur', function () {
    const address = this.value;
    if (address) {
        forwardGeocode(address);
    }
});

function reverseGeocode(lat, lng) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.display_name) {
                document.getElementById('address').value = data.display_name;
            }
        })
        .catch(error => console.log('Error:', error));
}

function forwardGeocode(address) {
    const url = `https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(address)}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data[0]) {
                const latLng = [data[0].lat, data[0].lon];
                map.setView(latLng, 13);
                marker.setLatLng(latLng);

                document.getElementById('latitude').value = data[0].lat;
                document.getElementById('longitude').value = data[0].lon;
            }
        })
        .catch(error => console.log('Error:', error));
}
