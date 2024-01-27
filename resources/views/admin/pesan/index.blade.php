@extends('layouts.admin.app')
@section('title', 'Pesan')
@section('content')

    <div class="container-fluid">
        <div class="col-lg-12">

            <div class="row my-3">
                <div class="col-lg-6">
                    <h2>Pesan Masuk</h2>
                </div>
                {{-- <div class="col-lg-6 text-right">
                    <a class="btn btn-success" href="{{ route('contact.create') }}">
                        <i class="fas fa-plus"></i> Add Contact
                    </a>
                </div> --}}
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success text-center">
                    <h6>{{ $message }}</h6>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pesan Masuk</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="20px">No</th>
                                <th>Nama Pengirim</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Isi</th>
                                <th width="70px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesans as $pesan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesan->nama }}</td>
                                    <td>{{ $pesan->email }}</td>
                                    <td>{{ $pesan->subject }}</td>
                                    <td>{{ $pesan->message }}</td>

                                    <td>
                                        <form action="{{ route('pesan.destroy', $pesan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
