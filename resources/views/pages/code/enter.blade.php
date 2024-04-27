@extends('layout.user')

@section('content')
<div class="min-h-screen relative">
    <div id="map-background" class="w-full h-screen z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-35% from-main-color to-main-color/60 z-30 md:from-20%"></div>

    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form class="relative bg-white rounded-2xl shadow" action="{{ route('code.check') }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 text-center">
                    <h3 class="text-xl font-bold">Masukkan Kode Tiket</h3>
                    <p class="text-base font-medium leading-relaxed text-gray-600">
                        Masukkan kode atau pindai QR yang tertera pada tiket.
                    </p>
                    <input type="text" class="outline outline-2 outline-gray-400 rounded-lg px-4 py-2 text-center tracking-wide block m-auto" name="code" value="{{ $code }}" autofocus>
                    @error('code')
                    <small class="text-red-700">{{ $message }}</small>
                    @enderror

                    <button type="submit" class="bg-main-color text-white px-6 py-2 rounded-xl font-bold block m-auto"><i class="ti ti-player-play-filled me-1"></i> Mulai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const map = L.map('map-background').setView([-7.296194429972056, 112.73681616791822], 80);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
@endpush
