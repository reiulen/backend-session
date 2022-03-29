@extends('backend.layout.main')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('gallery.index') }}" class="btn btn-outline-dark px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Buku</a></div>
              <div class="breadcrumb-item">Tambah Gallery</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Gallery</h4>
                  </div>
                  <div class="card-body">
                    <form id="formtambah" action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        <div class="input-group control-group increment row form-group mb-4" >
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                            <div class="col-md-6 row">
                                <div class="col-md-8">
                                    <input type="file" name="filename[]" class="form-control">
                                </div>
                                <div class="col-md-4 mx-auto">
                                    <button class="btn btn-dark" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah Foto</button>
                                </div>
                                @error('filename')
                                <p class="text-small text-danger px-4">Gambar {{ $message }}</p>
                                @enderror
                                <p class="text-small text-danger px-4">*Gambar maksimum 2mb</p>
                           </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group row form-group mb-4" style="margin-top:10px">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-md-6 row">
                                    <div class="col-md-8">
                                        <input type="file" onchange="gambarpreview()" name="filename[]" class="form-control">
                                    </div>
                                    <div class="input-group-btn col-md-4 mx-auto"> 
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                    @error('filename')
                                    <p class="text-small text-danger px-4">Gambar {{ $message }}</p>
                                    @enderror
                                    <p class="text-small text-danger px-4">*Gambar maksimum 2mb</p>
                                </div>
                            </div>
                        </div>
                        
  
                        {{-- <div class="form-group row mb-4 increment">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-md-4">
                                <img src="{{ asset('assets/gambar/thumbnail.jpg'); }}" class="img-fluid" id="img-preview">
                                @error('filename')
                                    Gambar {{ $message }}
                                @enderror
                                <p class="text-small text-danger pt-2">*Gambar maksimum 2mb</p>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <input type="file" onchange="gambarpreview()" class="custom-file-input gambar-file" name="filename[]" id="customFile">
                                <label class="custom-file-label text-small" for="customFile">Pilih Gambar</label>
                                <button class="btn btn-dark tambahFoto my-3" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah Foto</button>
                            </div>
                        </div>
                        <div class="clone hide"> 
                            <div class="form-group row mb-4 control-group">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="filename[]" name="image" id="image-upload" />
                                </div>
                            </div>
                            </div>
                        </div> --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="judul" value="{{ old('judul')  }}" class="form-control @error('judul') is-invalid  @enderror" required autofocus>
                               @error('judul')
                                <div class="invalid-feedback ">
                                    Judul {{ $message }}
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
        <script>
        function gambarpreview(){
            const sampul = document.getElementById('customFile');
            const preview = document.getElementById('img-preview');

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e){
              preview.src = e.target.result;
            }
        }

        $(document).ready(function() {
            $(".btn-dark").click(function(){ 
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
        </script>
      @endsection
@endsection