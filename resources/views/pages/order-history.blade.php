@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-semibold">📄 Riwayat Pemesanan Gas</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada pesanan yang dibuat.
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-bordered shadow-sm">
                <thead class="table-light text-center">
                    <tr class="fw-semibold">
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>3 Kg</th>
                        <th>12 Kg</th>
                        <th>Metode</th>
                        <th>Alamat Pengiriman</th>
                        <th>Lacak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</td>
                        <td class="text-center">{{ $order->qty_3kg }} tabung</td>
                        <td class="text-center">{{ $order->qty_12kg }} tabung</td>
                        <td class="text-center">
                            <span class="badge bg-secondary text-uppercase">{{ $order->payment_method }}</span>
                        </td>
                        <td>{{ $order->address }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" onclick="trackCourier('{{ $order->_id }}')">Lacak Kurir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal Pelacakan Kurir -->
<div id="trackingModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">📍 Pelacakan Kurir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div id="map" style="height: 400px;"></div>
        </div>
      </div>
    </div>
</div>

@push('scripts')
<script>
    // Menyimpan lokasi pengiriman dari setiap order
    const ordersUserLocations = @json($orders->mapWithKeys(function ($order) {
        return [
            (string) $order->_id => [
                'lat' => $order->delivery_lat,
                'lng' => $order->delivery_lng,
            ]
        ];
    }));

    let map, marker, userMarker, polyline, jarakPopup, interval;

    function trackCourier(orderId) {
        const modal = new bootstrap.Modal(document.getElementById('trackingModal'));
        modal.show();

        setTimeout(() => {
            if (!map) {
                map = L.map('map').setView([0, 0], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
            }

            if (marker) map.removeLayer(marker);
            if (userMarker) map.removeLayer(userMarker);
            if (polyline) map.removeLayer(polyline);
            if (jarakPopup) map.closePopup(jarakPopup);
            if (interval) clearInterval(interval);

            fetchLocation(orderId);
            interval = setInterval(() => fetchLocation(orderId), 5000);
        }, 300);
    }

    function fetchLocation(orderId) {
        fetch(`/api/courier-location/${orderId}`)
            .then(response => {
                if (!response.ok) throw new Error('Response not OK');
                return response.json();
            })
            .then(data => {
                if (data.lat && data.lng) {
                    const latLng = [data.lat, data.lng];

                    if (!marker) {
                        marker = L.marker(latLng).addTo(map).bindPopup("📦 Kurir di sini").openPopup();
                    } else {
                        marker.setLatLng(latLng);
                    }

                    const userLocation = ordersUserLocations[orderId];
                    if (userLocation && userLocation.lat && userLocation.lng) {
                        if (!userMarker) {
                            userMarker = L.marker([userLocation.lat, userLocation.lng], {
                                icon: L.icon({
                                    iconUrl: 'user-icon.png',
                                    iconSize: [30, 30]
                                })
                            }).addTo(map).bindPopup("📍 Lokasi Pengiriman");
                        } else {
                            userMarker.setLatLng([userLocation.lat, userLocation.lng]);
                        }

                        if (polyline) map.removeLayer(polyline);
                        polyline = L.polyline([latLng, [userLocation.lat, userLocation.lng]], {
                            color: 'blue',
                            weight: 3
                        }).addTo(map);

                        const jarakMeter = L.latLng(latLng).distanceTo(L.latLng([userLocation.lat, userLocation.lng]));
                        const jarakKm = (jarakMeter / 1000).toFixed(2);

                        if (!jarakPopup) {
                            jarakPopup = L.popup()
                                .setLatLng(map.getCenter())
                                .setContent(`📏 Jarak ke lokasi: ${jarakKm} km`)
                                .openOn(map);
                        } else {
                            jarakPopup.setLatLng(map.getCenter()).setContent(`📏 Jarak ke lokasi: ${jarakKm} km`).openOn(map);
                        }
                    }

                    map.setView(latLng, 15);
                } else {
                    console.warn('Data lokasi tidak lengkap:', data);
                }
            })
            .catch(err => {
                console.error('Gagal ambil lokasi:', err);
            });
    }
</script>
@endpush
@endsection
