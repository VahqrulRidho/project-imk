@extends('layouts.admin.app')
@section('title', 'Contact')
@section('content')

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Contact</h2>
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
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Alamat</strong>
                                    <input type="text" name="alamat" value="{{ $contact->alamat }}" class="form-control"
                                        placeholder="Alamat Lengkap">
                                </div>
                                <div class="form-group">
                                    <strong>Email</strong>
                                    <input type="email" name="email" value="{{ $contact->email }}" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <strong>Nomor Handphone</strong>
                                    <input type="number" name="no_hp" value="{{ $contact->no_hp }}" class="form-control"
                                        placeholder="Nomor Hp">
                                </div>
                                <div class="form-group">
                                    <strong>Link Maps</strong>
                                    <input type="text" name="link_maps" value="{{ $contact->link_maps }}"
                                        class="form-control" placeholder="Link Maps">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-3">
                                <a class="btn btn-dark" href="{{ route('contact') }}"> Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
