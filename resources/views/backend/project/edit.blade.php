@extends('backend.layout.main')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('project.index') }}" class="btn btn-outline-dark px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Buku</a></div>
              <div class="breadcrumb-item">Tambah Project</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Project</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('project.update', $project->id ) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        @method('put')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' .$project->thumbnail); }}" class="img-fluid img-preview">
                                @error('thumbnail')
                                    Gambar {{ $message }}
                                @enderror
                                <p class="text-small text-danger pt-2">*Gambar maksimum 2mb</p>
                            </div>
                            <div class="col-sm-8 col-md-2 ">
                                <input type="file" onchange="gambarpreview()" class="custom-file-input gambar-file" name="thumbnail"  id="customFile">
                                <label class="custom-file-label text-small" for="customFile">Pilih Gambar</label>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Project</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="judul" value="{{ (old('judul')  ? old('judul') : $project->judul) }}" class="form-control @error('judul') is-invalid  @enderror" required autofocus>
                               @error('judul')
                                <div class="invalid-feedback ">
                                    Judul {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dibuat dengan</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="deskripsi" value="{{ (old('deskripsi')  ? old('deskripsi') : $project->deskripsi) }}" class="form-control @error('deskripsi') is-invalid  @enderror" required autofocus>
                               @error('deskripsi')
                                <div class="invalid-feedback ">
                                    Deskripsi {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="link" value="{{ (old('link')  ? old('link') : $project->link) }}" class="form-control @error('link') is-invalid  @enderror" required autofocus>
                               @error('link')
                                <div class="invalid-feedback ">
                                    Link {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row my-5">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-dark col-5">Edit</button>
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