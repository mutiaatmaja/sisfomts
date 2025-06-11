@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profil Pengguna</div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Nama</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
