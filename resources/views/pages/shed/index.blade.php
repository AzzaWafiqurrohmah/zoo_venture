@extends('layout.app')
@section('shed', 'active')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="pagetitle">
                <h1>Daftar Area</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Area</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <button class="btn btn-primary" id="newShed" name="newShed">New Shed</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover"  id="sheds-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
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
    @include('component.shedModal')
@endsection

@push('script')
    <script>
        const shedTable = $('#sheds-table').DataTable({
            serverSide: true,
            rendering: true,
            ajax: '{{ route('sheds.datatables') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', orderable: false, searchable: false},
            ],
        });


        const shedModal = new bootstrap.Modal('#shed-modal');
        let editID = 0;

        function fillForm() {
            $.ajax({
                url: `/sheds/${editID}`,
                success: (res) => fillFormdata(res.data),
            });
        }

        function saveItem() {
            const url = editID != 0 ?
                `/sheds/${editID}/update` :
                `/sheds/store`;

            const method = editID != 0 ? 'PUT' : 'POST';
            console.log(method);

            $.ajax({
                url,
                method,
                data: $('#shed-form').serialize(),
                success(res) {
                    shedTable.ajax.reload();
                    shedModal.hide();


                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });
                },
                error(err) {
                    if(err.status == 422) {
                        displayFormErrors(err.responseJSON.data);
                        return;
                    }

                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                },
            });
        }

        function deleteItem(id) {
            $.ajax({
                url: `/sheds/${id}`,
                method: 'DELETE',
                success(res) {
                    shedTable.ajax.reload();

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

        $('#shed-modal').on('show.bs.modal', function (event) {
            $('#shed-modal-title').text(editID ? 'Edit Data Area' : 'Tambah Data Area');
            if(editID != 0)
                fillForm();
        });

        $('#shed-modal').on('hidden.bs.modal', function (event) {
            editID = 0;

            removeFormErrors();
            $('#shed-form').trigger('reset');
        });

        $('#shed-form').submit(function(e) {
            e.preventDefault();

            removeFormErrors();
            saveItem();
        });

        $('#sheds-table').on('click', '.btn-edit', function(e) {
            editID = this.dataset.id;
            shedModal.show();
        });

        $('#newShed').on('click', function (e) {
            shedModal.show();
        });


        $('#sheds-table').on('click', '.btn-delete', function(e) {
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

