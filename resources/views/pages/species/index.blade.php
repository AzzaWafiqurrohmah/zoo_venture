@extends('layout.app')
@section('species', 'active')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="pagetitle">
                <h3>Daftar Spesies</h3>
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
                        <button class="btn btn-primary" id="newSpecies" name="newSpecies">New Species</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover"  id="species-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ilmiah</th>
                                <th>Nama Hewan</th>
                                <th>Asal</th> 
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
@endsection

@push('script')
    <script>
        const shedTable = $('#species-table').DataTable({
            serverSide: true,
            rendering: true,
            ajax: '{{ route('species.datatables') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'scientific_name', name: 'scientific_name'},
                {data: 'name', name: 'name'},
                { data: 'origin', name: 'origin'},
                {data: 'action', orderable: false, searchable: false},
            ],
        });

    

        function deleteItem(id) {
            $.ajax({
                url: `/species/${id}`,
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


        $('#species-table').on('click', '.btn-edit', function(e) {
            editID = this.dataset.id;
            window.location.href = "{{ route('species.edit', 'VALUE') }}".replace('VALUE', editID);
        });

        $('#newSpecies').on('click', function (e) {
            window.location.href = "{{ route('species.create') }}";
        });


        $('#species-table').on('click', '.btn-delete', function(e) {
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