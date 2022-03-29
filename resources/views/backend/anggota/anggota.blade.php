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
              <div class="breadcrumb-item">Data Anggota</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Anggota</h1>

            <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link {{ (!request('role')) ? 'active' : '' }}" href="{{ route('anggota.index') }}">Semua <span class="badge {{ (!request('role')) ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('role')=='Admin') ? 'active' : '' }}" href="{{ route('anggota.index') }}?role=Admin">Admin <span class="badge {{ (request('role')=='Admin') ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->where('role', 'Admin')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('role')=='Siswa') ? 'active' : '' }}" href="{{ route('anggota.index') }}?role=Siswa">Siswa <span class="badge {{ (request('role')=='Siswa') ? 'badge-white' : 'badge-dark' }}">{{ $jumlah->where('role', 'Siswa')->count() }}</span></a>
                      </li>
                  </ul>
                </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                
                  <div class="card-body">
                      <a href="{{ route('anggota.create') }}" class="link">
                        <button class="btn btn-dark mb-3"><i class="fa fa-edit"></i> Tambah Anggota</button>
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
                      <table class="table table-striped border-0" id="table-anggota">
                        <thead>
                          <tr>
                            <th>Avatar</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Post</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $row)
                            <tr>
                                <td style="cursor:pointer;" data-toggle="modal"  data-target="#gambar_anggota{{ $row->id }}">
                                    <img alt="image" src="{{ asset($row->avatar) }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                </td>
                                <td>{{ $row->nis }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->email }}</td>
                                <td><div class="badge @if($row->role == 'Admin') badge-primary  @elseif($row->role == 'Siswa') badge-secondary @endif" style="font-weight: 450 !important;">{{ $row->role }}</div></td>
                                <td><a href="">{{ $row->post->count() }} post</a></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-none dropdown-toggle" type="button" id="petugasdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop">
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> Lihat anggota</a>
                                           @if($row->role == 'Siswa')
                                            <a class="dropdown-item" href="{{ route('anggota.edit', $row->id) }}"><i class="fa fa-edit"></i> Edit anggota</a>
                                            <a class="dropdown-item hapusAnggota" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('anggota.destroy', $row->id) }}" method="post" id="hapusAnggota{{ $row->id }}">
                                              @csrf
                                              @method('delete')
                                            </form>
                                           @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="float-right">
                      {{ $anggota->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </section>
      </div>


      <!-- Modal -->
    @foreach($anggota as $row)
    <div class="modal fade" id="gambar_anggota{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          $(".hapusAnggota").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Anggota',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusAnggota${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });

           @if(!$anggota->count())
             $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Anggota tidak ditemukan</h5></td>');
          @endif

        </script>
      @endsection
@endsection