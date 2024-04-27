<div id="species-modal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 hidden justify-center items-top w-full inset-0 max-h-full bg-black/70">
    <div class="relative px-4 w-full max-w-2xl max-h-full mt-10">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow" id="species-modal-content">
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="w-full aspect-video bg-cover bg-center rounded-2xl" id="species-image"></div>

                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-center md:text-start">
                        <h3 class="text-xl font-bold mt-4" id="species-name">-</h3>
                        <p class="text-base font-semibold text-slate-700" id="species-scientific">-</p>
                    </div>
                    <div class="flex justify-center items-center">
                        <i class="ti ti-map-pin-filled text-2xl text-main-color"></i>
                        <p class="text-base font-semibold text-slate-800" id="species-origin">-</p>
                    </div>
                </div>

                <p class="mt-4 text-base font-medium text-slate-600 indent-10 text-justify" id="species-description">-</p>
                <p class="mt-1 text-base font-medium text-slate-600 indent-10 text-justify" id="species-article">-</p>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function(){
        $('#species-modal').click(function(event){
            event.stopPropagation(); // Mencegah penyebaran event
            toggleModal();
        });

        $('#species-modal-content').click(function(event){
            event.stopPropagation();
        });
    });


    function showSpeciesModal(species) {
        const modal = $('#species-modal');

        $('#species-image').css('background-image', `url(${species.image})`);
        $('#species-name').text(species.name);
        $('#species-scientific').text(species.scientific_name);
        $('#species-origin').text(species.origin);
        $('#species-description').text(species.description);
        $('#species-article').text(species.article);

        toggleModal();
    }

    function toggleModal() {
        const modal = $('#species-modal');
        const isShowed = modal.hasClass('flex');

        if (isShowed) {
            modal.removeClass('flex');
            modal.addClass('hidden');
            return;
        }

        modal.removeClass('hidden');
        modal.addClass('flex');
    }
</script>
@endpush
