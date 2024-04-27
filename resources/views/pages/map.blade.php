@extends('layout.user')

@section('content')
<div class="min-h-screen w-full flex flex-col md:flex-row">
    <div class="h-[60vh] z-10 md:h-[100vh] md:w-full" id="map"></div>
    <div class="md:w-[40%] px-4 py-2 relative">
        <div class="w-100 h-9 bg-white absolute right-0 left-0 top-[-20px] z-30 rounded-t-3xl md:hidden"></div>

        <h5 class="text-xl font-semibold mt-2">
            <i class="ti ti-layout-dashboard-filled me-1 text-main-color"></i>
            Area Terdekat
        </h5>
        <div class="flex flex-col gap-2 mt-4" id="nearest-container">
            {{-- <div class="rounded-lg hover:bg-gray-100">
                <div class="flex gap-3 items-center px-4 py-3 cursor-pointer dropdown-btn">
                    <div class="w-12 h-12 rounded-full bg-[#80BCBD]"></div>
                    <div>
                        <h4 class="text-base font-semibold mb-1 text-gray-800">Kandang Mamalia</h4>
                        <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">3 spesies</span>
                    </div>
                    <div class="flex-auto">
                        <i class="ti ti-chevron-down text-xl float-right dropdown-icon"></i>
                    </div>
                </div>
                <div class="hidden flex-col pl-10 dropdown-menu">
                    <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-2 rounded-lg cursor-pointer">
                        <div class="w-11 h-11 rounded-full bg-[#FF90BC]"></div>
                        <div>
                            <h4 class="text-[1rem] font-semibold mb-1 text-gray-800">Jerapah</h4>
                        </div>
                    </div>
                    <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-2 rounded-lg cursor-pointer">
                        <div class="w-11 h-11 rounded-full bg-[#FF90BC]"></div>
                        <div>
                            <h4 class="text-[1rem] font-semibold mb-1 text-gray-800">Zebra</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-3 rounded-lg cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-[#FF90BC]"></div>
                <div>
                    <h4 class="text-base font-semibold mb-1 text-gray-800">Kandang Reptil</h4>
                    <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">3 spesies</span>
                </div>
                <div class="flex-auto">
                    <i class="ti ti-chevron-down text-xl float-right"></i>
                </div>
            </div>
            <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-3 rounded-lg cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-[#C2DEDC]"></div>
                <div>
                    <h4 class="text-base font-semibold mb-1 text-gray-800">Kandang Monyet</h4>
                    <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">1 spesies</span>
                </div>
                <div class="flex-auto">
                    <i class="ti ti-chevron-down text-xl float-right dropdown-icon"></i>
                </div>
            </div>
            <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-3 rounded-lg cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-[#537188]"></div>
                <div>
                    <h4 class="text-base font-semibold mb-1 text-gray-800">Kandang Harimau</h4>
                    <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">5 spesies</span>
                </div>
                <div class="flex-auto">
                    <i class="ti ti-chevron-down text-xl float-right"></i>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const map = L.map('map').setView([-7.296194429972056, 112.73681616791822], 80);

    let isPanned = false;
    let marker;
    let sheds;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    function createNearestArea(details) {
        let elements = '';
        let drds = '';

        details.map((detail) => {
            const chevron = detail.total_specs < 1 ? '' :
            `<div class="flex-auto">
                <i class="ti ti-chevron-down text-xl float-right dropdown-icon"></i>
            </div>`;

            detail.specs.map((spec) => {
                drds += `<div class="hidden flex-col pl-10 dropdown-menu">
                    <div class="flex gap-3 items-center hover:bg-gray-100 px-4 py-2 rounded-lg cursor-pointer">
                        <div class="w-11 h-11 rounded-full bg-[#FF90BC]"></div>
                        <div>
                            <h4 class="text-[1rem] font-semibold mb-1 text-gray-800">${spec.name}</h4>
                        </div>
                    </div>
                </div>`;
            });

            elements += `
            <div class="rounded-lg hover:bg-gray-100">
                <div class="flex gap-3 items-center px-4 py-3 cursor-pointer dropdown-btn">
                    <div class="w-12 h-12 rounded-full" style="background-color: ${detail.color}"></div>
                    <div>
                        <h4 class="text-base font-semibold mb-1 text-gray-800">${detail.name}</h4>
                        <span class="bg-slate-200 px-3 py-0.5 rounded-full text-xs font-semibold">${detail.total_specs} spesies</span>
                    </div>
                    ${chevron}
                </div>
                ${drds}
            </div>
            `;
        });

        $('#nearest-container').html(elements);
    }

    function renderNearestArea(distances) {
        const treshold = 0.1;
        const closests = distances.filter((d) => d.distance < treshold || d.isInside == true);

        createNearestArea(closests);
    }

    function getCurrLocation() {
        navigator.geolocation.getCurrentPosition((position) => {
            const coord = [position.coords.latitude, position.coords.longitude];

            if(marker)
                map.removeLayer(marker);

            marker = L.marker(coord).addTo(map);

            const distances = sheds.map((shed) => {
                const coordinates = shed.coordinates.map((coor) => {
                    return coor.map((c) => Number(c));
                });

                const turfPolygon = turf.polygon([[...coordinates]]);
                const vertices = turf.explode(turfPolygon);
                const closestVertex = turf.nearest(coord, vertices);

                shed.isInside = turf.inside(coord, turfPolygon);
                shed.distance = turf.distance(coord, closestVertex, {unit: 'kilometers'});

                return shed;
            });

            if(!isPanned) {
                map.panTo(coord, 25);
                isPanned = true;
            }

            renderNearestArea(distances);
        });
    }

    $.ajax({
        url: '/api/sheds',
        success(res) {
            sheds = res.data;
            res.data.map((shed) => {
                const polygon = L.polygon(shed.coordinates, { color: shed.color });

                polygon.bindTooltip(shed.name, {permanent: true, direction:"center"});
                polygon.addTo(map);
            });

            if (navigator.geolocation)
                // setInterval(() => {
                getCurrLocation();
                // }, 200);
        },
    });

    $('#nearest-container').on('click', '.dropdown-btn', function() {
        const drdMenu = $(this).next();
        const drdIcon = $(this).find('.dropdown-icon');
        const isHidden = drdMenu.hasClass('hidden');

        if(isHidden) {
            drdMenu.removeClass('hidden');
            drdMenu.addClass('flex');

            drdIcon.removeClass('ti-chevron-down');
            drdIcon.addClass('ti-chevron-up')
        } else {
            drdMenu.addClass('hidden');
            drdMenu.removeClass('flex');

            drdIcon.removeClass('ti-chevron-up');
            drdIcon.addClass('ti-chevron-down')
        }
    });
</script>
@endpush
