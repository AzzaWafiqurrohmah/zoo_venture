<div class="modal fade" id="code-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <form action="" id="code-form"> --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="shed-modal-title">Kode Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    {{-- {{ $qrCode }} --}}
                    <p id="qrCodeText"></p>
                    <!-- Tambahkan tag img dengan URL QR Code sebagai src -->
                    <div id="qrCodeImage"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
