@extends('layout.app')
@section('species', 'active');
@section('content')
    <div class="row">
        <div class="col-md-11" style="margin-top: 0px" >
            <div class="pagetitle">
                <h3>Tambah Spesies</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">New Species</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
        <div>
            <form action="{{ route('species.store') }}" enctype="multipart/form-data" method="post">
                @include('pages.species.form')
            </form>
        </div>
    </div>
@endsection
