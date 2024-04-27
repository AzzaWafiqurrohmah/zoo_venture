@extends('layout.app')
@section('shed', 'active')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="pagetitle">
                <h3>Daftar Area</h3>
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

    

        $('#sheds-table').on('click', '.btn-edit', function(e) {
            editID = this.dataset.id;
            window.location.href = "{{ route('sheds.edit', 'VALUE') }}".replace('VALUE', editID);
        });

        $('#newShed').on('click', function (e) {
            window.location.href = "{{ route('sheds.create') }}";
        });


        $('#sheds-table').on('click', '.btn-delete', function(e) {
            console.log(this.dataset.id);
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

