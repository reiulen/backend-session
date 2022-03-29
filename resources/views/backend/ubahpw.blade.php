@extends('backend.layout.main')

@section('content')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
<div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="">Admin</a></div>
              <div class="breadcrumb-item">Ubah Password</div>
            </div>
          </div>

          <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Password</h4>
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div class="row py-4">
                            <div class="col-lg-8 col-md-12 mx-auto">
                                <form action="{{ route('pubahpassword') }}" method="POST" class="needs-validation form-edit" novalidate="">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="PasswordLama">Password Lama</label>
                                        <input type="password" value="{{ old('pwlama') }}" name="pwlama" class="form-control @error('pwlama') is-invalid @enderror" required autofocus>
                                        @error('pwlama')
                                            <div class="invalid-feedback">
                                                *Password Lama {{ $message }}
                                            </div>
                                        @enderror
                                        @if(session('pesan'))
                                        <div class="invalid-feedback">
                                          {{ session('pesan') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="PasswordLama">Password</label>
                                        <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" required autofocus>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                *Password {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Email">Konfirmasi Password</label>
                                        <input type="password" value="{{ old('password1') }}" name="password1" class="form-control @error('password1') is-invalid @enderror" required autofocus>
                                        @error('password1')
                                            <div class="invalid-feedback">
                                                *Konfirmasi Password {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-dark col-md-6 Edit">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
    
        </section>
      </div>
@endsection