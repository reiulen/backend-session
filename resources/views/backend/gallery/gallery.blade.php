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
              <div class="breadcrumb-item">Data Gallery</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Gallery</h1>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Semua Gallery</h4>
                  </div>
                  <div class="card-body">
                      <a href="{{ route('gallery.create') }}" class="link">
                        <button class="btn btn-dark mb-3"><i class="fa fa-edit"></i> Tambah Gallery</button>
                      </a>
                      <div class="float-right">
                        <form>
                          <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search">
                            @if(request('page'))
                                <input type="hidden" name="page" value="{{ request('page') }}">
                            @endif
                            <div class="input-group-append">
                              <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <div class="table-responsive py-2">
                      <table class="table table-striped border-0" id="table-gallery">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($gallery as $row)
                            <tr>
                                <td>{{ $row->judul }}</td>
                                <td>
                                    <div>
                                    @foreach($row->gambar as $gambar)
                                        <img src="{{ asset('storage/'.$gambar->filename) }}" data-toggle="modal"  data-target="#gambar_gallery{{ $gambar->id }}" style="width:150px; border-radius:6px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3); cursor:pointer;">
                                    @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-none dropdown-toggle" type="button" id="gallery" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="gallery">
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> Lihat gallery</a>
                                            <a class="dropdown-item hapusGallery" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('gallery.destroy', $row->id) }}" method="post" id="hapusGallery{{ $row->id }}">
                                              @csrf
                                              @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="float-right">
                      {{ $gallery->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>


      <!-- Modal -->
    @foreach($gallery as $row)
    @foreach($row->gambar as $gambar)
    <div class="modal fade" id="gambar_gallery{{ $gambar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  shadow-none" style="background:none !important;">
            <img src="{{ asset('storage/'.$gambar->filename) }}" class="img-thumbnail">
        </div>
      </div>
    </div>
    @endforeach
    @endforeach


      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusGallery").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Gallery',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusGallery${id}`).submit();
                          }
                      },
                      cancel: function () {

                      }
                  }
              });
          });

           @if(!$gallery->count())
             $('tbody').html('<td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Gallery tidak ditemukan</h5></td>');
          @endif

        </script>
      @endsection
@endsection
