@extends('layout.user')

@section('content')
<div class="min-h-screen w-full flex flex-col md:flex-row">
    <div class="h-[60vh] z-10 md:h-[100vh] md:w-full" id="map"></div>
    <div class="md:w-[40%] px-4 py-2 relative">
        <div class="w-100 h-9 bg-white absolute right-0 left-0 top-[-20px] z-30 rounded-t-3xl md:hidden"></div>

        <h5 class="text-xl font-semibold mt-2">
            <i class="ti ti-layout-dashboard-filled me-1 text-main-color"></i>
            Tempat Terdekat
        </h5>
        <div class="flex flex-col gap-2 mt-4">
            <div class="rounded-lg hover:bg-gray-100">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const map = L.map('map').setView([-7.296194429972056, 112.73681616791822], 80);
    let polygons = [
        {
            name: 'Reptil',
            color: 'red',
            coors: [
                [-7.296151072283195, 112.73754179477693],
                [-7.296049973609802, 112.73696780204774],
                [-7.295991442788456, 112.73695707321168],
                [-7.295326319280842, 112.73711264133455],
                [-7.295267788364856, 112.73715019226076],
                [-7.296151072283195, 112.73754179477693],
            ],
        },
        {
            name: 'Mamalia',
            color: 'blue',
            coors: [
                [-7.296789589692704, 112.73763298988344],
                [-7.296635281402228, 112.736833691597],
                [-7.295996763772535, 112.73693025112154],
                [-7.296220245046567, 112.73767054080965],
                [-7.296789589692704, 112.73763298988344],
            ],
        },
    ];

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    polygons = polygons.map((area) => {
        const polygon = L.polygon(area.coors, { color: area.color });

        polygon.bindTooltip(area.name, {permanent: true, direction:"center"});
        polygon.addTo(map);
    });

    $('.dropdown-btn').on('click', function() {
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
