@extends('backend.layout.main')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('anggota.index') }}" class="btn btn-outline-dark px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Buku</a></div>
              <div class="breadcrumb-item">Tambah Anggota</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Anggota</h4>
                  </div>
                  <div class="card-body">
                    <form id="formtambah" action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                            <div class="col-md-4">
                                <img src="{{ asset('assets/gambar/thumbnail.jpg'); }}" class="img-fluid img-preview">
                                @error('avatar')
                                    Gambar {{ $message }}
                                @enderror
                                <p class="text-small text-danger pt-2">*Gambar maksimum 2mb</p>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <input type="file" onchange="gambarpreview()" class="custom-file-input gambar-file" name="avatar"  id="customFile">
                                <label class="custom-file-label text-small" for="customFile">Pilih Gambar</label>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nis</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="number" name="nis" value="{{ old('nis')  }}" class="form-control @error('nis') is-invalid  @enderror" required autofocus>
                               @error('nis')
                                <div class="invalid-feedback ">
                                    Nis {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="nama" value="{{ old('nama')  }}" class="form-control @error('nama') is-invalid  @enderror" required autofocus>
                               @error('nis')
                                <div class="invalid-feedback ">
                                    Nama {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="email" name="email" value="{{ old('email')  }}" class="form-control @error('email') is-invalid  @enderror" required autofocus>
                               @error('email')
                                <div class="invalid-feedback ">
                                    Email {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                            <div class="col-sm-12 col-md-6">
                              <select name="role" class="form-control @error('role') is-invalid  @enderror"  required autofocus>
                                <option selected disabled>--Pilih Role--</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Admin">Admin</option>
                              </select>
                               @error('role')
                                <div class="invalid-feedback ">
                                    Role {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="password" name="password1" value="{{ old('password1')  }}" class="form-control @error('password1') is-invalid  @enderror" required autofocus>
                               @error('password1')
                                <div class="invalid-feedback ">
                                    Password {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="password" name="password2" value="{{ old('password2')  }}" class="form-control @error('password2') is-invalid  @enderror" required autofocus>
                               @error('password2')
                                <div class="invalid-feedback ">
                                    Password {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row my-5">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-dark col-5">Tambah</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
    </div>
    

      @section('script')
        <script src="{{ asset('assets/js/page/uploadpreview.js') }}"></script>
        <script>
        function gambarpreview(){
            const sampul = document.querySelector('#customFile');
            const preview = document.querySelector('.img-preview');

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e){
              preview.src = e.target.result;
            }
        }
        </script>
      @endsection
@endsection