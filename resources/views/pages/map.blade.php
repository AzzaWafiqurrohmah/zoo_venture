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

@include('component.species-modal')
@endsection

@push('script')
<script src="/assets/js/tracker.js"></script>
@endpush
