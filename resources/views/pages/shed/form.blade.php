@php
    $shed = isset($shed) ? $shed : null;
@endphp

@csrf
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="row mb-3" style="margin-left: -10px; margin-top: 10px">
                    <div class="mb-3" style="font-size: 14px;">
                        <label for="name" class="form-label">Nama Area</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nme" value="{{ old('name', $shed?->name) }}" name="name">
                        @error('name')
                            <div class="invaid-feedback">
                                <small class="text-danger">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <label for="map" class="form-label">Pilih Lokasi Kandang</label>
                    <div id="map">
                    </div>

                    <div id="map-inputs" class="d-none"></div>

                    @error('coordinates')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror

                    <div class="mb-3 mt-3" style="display: flex; align-items: center;">
                        <label for="exampleColorInput" class="form-label" style="margin-right: 10px;">Pilih warna untuk lokasi</label>
                        <input type="color" class="form-control form-control-color" id="color" value="{{ old('color', $shed?->color) }}" name="color" title="Choose your color" style="width: 6%;">
                        @error('color')
                            <div class="invaid-feedback">
                                <small class="text-danger" style="margin-left: 3px">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div style="text-align: end">
                        <button type="submit" class="btn btn-primary @error('color') is-invalid @enderror"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Simpan</button>
                    </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        var polygons = [];

        var map = L.map('map').setView([-7.296194429972056, 112.73681616791822], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var polygon = L.polygon(polygons).addTo(map);
        polygon.bindPopup("SMK Mastrip");

        map.on('click', (e) => {
            const coordinat = e.latlng;

            polygons.push([coordinat.lat, coordinat.lng]);
            polygon.setLatLngs(polygons);

            map.removeLayer(polygon);
            polygon = L.polygon(polygons).addTo(map);
        });

        const shedForm = document.getElementById('shed-form');
        const mapInputs = document.getElementById('map-inputs');

        shedForm.addEventListener('submit', function(e) {
            e.preventDefault();

            polygons.map((polygon) => {
                const mapInput = document.createElement('input');

                mapInput.setAttribute('type', 'hidden');
                mapInput.setAttribute('name', 'coordinates[]');
                mapInput.value = polygon;

                mapInputs.append(mapInput);
            });

            shedForm.submit();
        });

        function generateRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        var colorInput = document.getElementById('color');
        colorInput.value = generateRandomColor();

    </script>
@endpush