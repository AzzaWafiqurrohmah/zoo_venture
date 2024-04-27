@extends('layout.app')
@section('code', 'active');
@php
    $qrCode = isset($qrCode) ? $qrCode : null;
@endphp
@section('content')
    <div class="row">
        <div class="col-md-10" style="margin-top: 0px" >
            <div class="pagetitle">
                <h3>Kode Tiket</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">code</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
        <div>
            {{-- <form action="{{ route('code.create') }}" enctype="multipart/form-data" method="post">

                @csrf
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="row mb-3" style="margin-left: -10px; margin-top: 10px">
                                <div class="col-sm-6 d-flex flex-column justify-content-center">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <label for="code" class="form-label">Your Code</label>
                                        <input type="text" class="form-control" id="code" value="{{ old('code') }}" name="code" disabled>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button">Generate</button>
                                      </div>
                                </div>
                                <div class="col-sm-5" style="margin-top: 0px;">
                                    <div class="card">
                                        {{ $qrCode? $qrCode :''; }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form> --}}
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <button class="btn btn-primary" id="newCode" name="newCode">New QR code</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover"  id="codes-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Expired</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('component.codeModal')
@endsection

@push('script')
    <script>
        const codeTable = $('#codes-table').DataTable({
            serverSide: true,
            rendering: true,
            ajax: '{{ route('code.datatables') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'code', name: 'code'},
                {data: 'expired', name: 'expired'},
                {data: 'action', orderable: false, searchable: false},
            ],
        });

        const codeModal = new bootstrap.Modal('#code-modal');

        let ID = 0;

        $('#codes-table').on('click', '.btn-show', function(e) {
            const code = this.dataset.code;

            $.ajax({
                url: `/code/generate?code=${code}`,
                success(res) {
                    $('#qrCodeText').text(code);
                    $('#qrCodeImage').html(res);
                }
            });

            codeModal.show();
        });


        $('#newCode').on('click', function (e) {
            $.ajax({
                url: `/code/store`,
                method: 'POST',
                success(res) {
                    codeTable.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });

                    codeModal.show();
                },
                error(err) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                }
            });
        });

        function deleteItem(id) {
            $.ajax({
                url: `/code/${id}`,
                method: 'DELETE',
                success(res) {
                    codeTable.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });
                },
                error(err) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                },
            });
        }

        $('#codes-table').on('click', '.btn-delete', function(e) {
            Swal.fire({
                icon: 'question',
                text: 'Apakah anda yakin?',
                showCancelButton: true,
                cancelButtonText: 'Batal',
            }).then((res) => {
                if(res.isConfirmed)
                    deleteItem(this.dataset.id);
            });
        });


    </script>
@endpush
