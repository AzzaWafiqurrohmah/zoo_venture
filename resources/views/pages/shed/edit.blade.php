@extends('layout.app')
@section('sheds', 'active');

@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="pagetitle">
                <h3>Tambah Area</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Edit Area</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ route('sheds.update', $shed->id) }}" enctype="multipart/form-data" id='shed-form' method="post">
                @method('PUT')
                @include('pages.shed.form')
            </form>
        </div>
    </div>
@endsection
