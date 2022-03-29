@extends('backend.layout.main')

@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/taginput/taginput.css') }}">
    <link href="{{ asset('assets/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('post.index') }}" class="btn btn-outline-dark px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Buku</a></div>
              <div class="breadcrumb-item">Edit Post</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Post</h4>
                  </div>
                  <div class="card-body">
                    <form id="formEdit" action="{{ route('post.update', $post->id ) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        @method('put')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' .$post->thumbnail); }}" class="img-fluid img-preview">
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Post</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" name="judul" value="{{ (old('judul') ? old('judul') : $post->judul)  }}" class="form-control @error('judul') is-invalid  @enderror" required autofocus>
                               @error('judul')
                                <div class="invalid-feedback ">
                                    Judul {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-6">
                               <select class="form-control @error('kategori_id') is-invalid  @enderror" name="kategori_id" required autofocus>
                                    <option value="{{ $post->kategori_id }}" selected>--{{ $post->kategori->kategori }}--</option>
                                    @foreach($kategori as $row)
                                        <option value="{{ $row->id }}">{{ $row->kategori }}</option>
                                    @endforeach
                               </select>
                               @error('kategori_id')
                                <div class="invalid-feedback ">
                                    Kategori {{ $message }}
                                </div>
                               @enderror
                            </div>
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#tambahKategori">
                              <i class="fas fa-plus"></i> Tambah Kategori
                            </button>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" value="{{ (old('tag') ? old('tag')  : $post->tag) }}" class="form-control inputtags" name="tag">
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-6">
                                <select name="status" class="form-control">
                                    <option value="{{ $post->status }}" selected>--{{ $post->status }}--</option>
                                    <option value="Publish">Publish</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-10 mx-auto">
                               <textarea name="content"  id="summernote" class="form-control @error('content') is-invalid  @enderror " required autofocus>{{ (old('content') ? old('content') : $post->isi) }}</textarea>
                               @error('content')
                                <div class="invalid-feedback ">
                                    Content {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row my-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-6 text-center">
                                <button type="button" onclick="document.getElementById('formEdit').submit()" class="btn btn-dark col-5">Edit</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
        <style>
            .modal-backdrop.show{
                z-index: 0 !important;
            }
        </style>
    </div>

     <!-- Modal -->
    <div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
             <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" id="kategori" class="form-control" name="kategori" required autofocus>
                            <div class="invalid-feedback">
                                Kategori tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                        <button class="btn btn-dark" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

      @section('script')
        <script src="{{ asset('assets/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('assets/taginput/taginput.js') }}"></script>
        <script>
        $(".inputtags").tagsinput('items');
        function gambarpreview(){
            const sampul = document.querySelector('#customFile');
            const preview = document.querySelector('.img-preview');

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e){
              preview.src = e.target.result;
            }
        }
        $('#summernote').summernote({
            tabsize: 2,
            height: 300,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete: function(target) {
                    $.delete(target[0].src);
                }
            },
        });
        $.upload = function(file) {
                let out = new FormData();
                out.append('file', file, file.name);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '{{ route('uploadgambar') }}',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function(img) {
                        $('#summernote').summernote('insertImage', img.imageUrl);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
        };
        $.delete = function(src) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '{{ route('deletegambar') }}',
                    cache: false,
                    data: {
                        src: src
                    },
                    success: function(response) {
                        console.log(response.res);
                    },
                });
        };
        </script>
      @endsection
@endsection