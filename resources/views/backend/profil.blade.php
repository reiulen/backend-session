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
              <div class="breadcrumb-item">Profil</div>
            </div>
          </div>

          <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Profil</h4>
                    </div>
                    <div class="col-md-8 mx-auto">
                        <div class="row py-4">
                            <div class="col-lg-5 col-md-12 mt-3 text-center">
                                <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" style="height: 200px">
                                <button type="button" class="btn btn-dark my-2" style="font-weight: 400 !important;" data-toggle="modal" data-target="#updateFoto">
                                    Ubah foto
                                </button>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <form action="{{ route('ubahprofil') }}" method="POST" class="needs-validation form-edit" novalidate="">
                                    @csrf
                                    <input type="hidden" name="a" value="a">
                                    <div class="form-group mb-4">
                                        <label>Nis</label>
                                        <input value="{{ Auth::user()->nis }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Nama">Nama</label>
                                        <input type="text" value="{{ Auth::user()->nama }}" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                *Nama {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Email">Email</label>
                                        <input type="text" value="{{ Auth::user()->email }}" name="email" class="form-control @error('email') is-invalid @enderror" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                *Email {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-dark col-md-6 Edit">Ubah Profil</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
    
        </section>
      </div>

                    <div class="modal fade" id="updateFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah foto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('ubahprofil') }}" enctype="multipart/form-data" method="POST" >
                                    @csrf
                                    <div class="modal-body">
                                        <div class="foto-user text-center mb-3">
                                            <img src="{{ asset(Auth::user()->avatar) }}" class="img-thumbnail img-preview rounded-circle" style="height: 200px; width:200px; object-fit:cover;">
                                        </div>
                                        <span class="text-small text-danger p-3">*Max upload gambar 2MB</span>
                                        <input type="file" onchange="gambarpreview()" class="form-control gambar-file" name="foto"  id="customFile">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


    

                        @section('script')
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
                        <script>
                            $(".Edit").click(function(e){
                                id = e.target.dataset.id;
                                $.confirm({
                                    title: 'Ubah Profil',
                                    content: 'Apakah yakin ingin mengubah?',
                                    type: 'green',
                                    autoClose: 'cancel|8000',
                                    buttons: {
                                        deleteUser: {
                                            text: 'Ubah',
                                            btnClass: 'btn-green',
                                            action: function () {
                                                $(`.form-edit`).submit();
                                            }
                                        },
                                        cancel: function () {
                                            
                                        }
                                    }
                                });
                            });

                                function gambarpreview(){
                                    const sampul = document.querySelector('#customFile');
                                    const preview = document.querySelector('.img-preview');

                                    const fileSampul = new FileReader();
                                    fileSampul.readAsDataURL(sampul.files[0]);

                                    fileSampul.onload = function(e){
                                    preview.src = e.target.result;
                                    }
                                }
                                 $("#idnis").keypress(function(e) {
                                        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                            return false;
                                        }
                                    });	
                             </script>
                        @endsection
@endsection