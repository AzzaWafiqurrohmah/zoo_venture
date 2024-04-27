@extends('layout.app')
@section('shed', 'active');
@section('content')
    <div class="row">
        <div class="col-md-11" style="margin-top: 0px" >
            <div class="pagetitle">
                <h3>Tambah Area</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">New Area</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
        <div>
            <form action="{{ route('sheds.store') }}" enctype="multipart/form-data" id="shed-form" method="post">
                @include('pages.shed.form')
            </form>
        </div>
    </div>
@endsection
