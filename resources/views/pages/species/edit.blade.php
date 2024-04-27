@extends('layout.app')
@section('species', 'active');

@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="pagetitle">
                <h3>Tambah Spesies</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Edit Species</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ route('species.update', $species->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @include('pages.species.form')
            </form>
        </div>
    </div>
@endsection
