@extends('layouts.admin.app')
@section('title', 'Header')
@section('content')

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Foto</h2>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Something went wrong.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="col-lg-12 mt-4">
                    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Judul</strong>
                                    <input type="text" name="nama" value="{{ $foto->nama }}" class="form-control"
                                        placeholder="Input Judul" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Foto</strong>
                                    <input type="file" class="form-control form-control-md" name="foto"
                                        value="{{ $foto->foto }}" placeholder="Foto" />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-3">
                                <a class="btn btn-dark" href="{{ route('foto') }}"> Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
