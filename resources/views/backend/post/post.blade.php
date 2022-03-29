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
              <div class="breadcrumb-item">Data Post</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Post</h1>

            <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link {{ (!request('status')) ? 'active' : '' }}" href="{{ route('post.index') }}">Semua <span class="badge {{ (!request('status')) ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Publish') ? 'active' : '' }}" href="{{ route('post.index') }}?status=Publish">Publish <span class="badge {{ (request('status')=='Publish') ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->where('status', 'Publish')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Draft') ? 'active' : '' }}" href="{{ route('post.index') }}?status=Draft">Draft <span class="badge {{ (request('status')=='Draft') ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->where('status', 'Draft')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Pending') ? 'active' : '' }}" href="{{ route('post.index') }}?status=Pending">Pending <span class="badge {{ (request('status')=='Pending') ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->where('status', 'Pending')->count() }}</span></a>
                      </li>
                  </ul>
                </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>@if(request('status'))
                      {{ request('status') }}
                      @else
                      Semua
                    @endif post</h4>
                  </div>
                  <div class="card-body">
                      <a href="{{ route('post.create') }}" class="link">
                        <button class="btn btn-dark mb-3"><i class="fa fa-edit"></i> Tambah Post</button>
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
                      <table class="table table-striped border-0" id="table-post">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                             @if(Auth::user()->role == 'Admin')
                            <th>Author</th>
                            @endif
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $row)
                            <tr>
                                <td>{{ $row->judul }}</td>
                                <td style="cursor:pointer;" data-toggle="modal"  data-target="#gambar_post{{ $row->id }}" ><img src="{{ asset('storage/'.$row->thumbnail) }}" style="width:150px; border-radius:6px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);"></td>
                                 @if(Auth::user()->role == 'Admin')
                                <td>{{ $row->user->nama }}</td>
                                @endif
                                <td><a href="">{{ $row->kategori->kategori }}</a></td>
                                <td><div class="badge @if($row->status == 'Publish') badge-primary  @elseif($row->status == 'Pending') badge-secondary @elseif($row->status == 'Draft') badge-dark @endif" style="font-weight: 450 !important;">{{ $row->status }}</div></td>
                                <td><i class="fas fa-eye"></i> {{ $row->views }} views</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-none dropdown-toggle" type="button" id="petugasdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop">
                                            <a class="dropdown-item" href="{{ route('post.edit', $row->id) }}"><i class="fa fa-edit"></i> Edit post</a>
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> Lihat post</a>
                                            <a class="dropdown-item hapusPost" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('post.destroy', $row->id) }}" method="POST" id="hapusPost{{ $row->id }}">
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
                      {{ $post->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </section>
      </div>


      <!-- Modal -->
    @foreach($post as $row)
    <div class="modal fade" id="gambar_post{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  shadow-none" style="background:none !important;">
            <img src="{{ asset('storage/'.$row->thumbnail) }}" class="img-thumbnail">
        </div>
      </div>
    </div>
    @endforeach
    

      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusPost").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Post',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusPost${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });

           @if(!$post->count())
             $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Post tidak ditemukan</h5></td>');
          @endif

        </script>
      @endsection
@endsection