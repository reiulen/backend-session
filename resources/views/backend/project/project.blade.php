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
              <div class="breadcrumb-item">Data Project</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Project</h1>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Semua Project</h4>
                  </div>
                  <div class="card-body">
                      <a href="{{ route('project.create') }}" class="link">
                        <button class="btn btn-dark mb-3"><i class="fa fa-edit"></i> Tambah Project</button>
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
                      <table class="table table-striped border-0" id="table-project">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th>Link</th>
                            <th>Dibuat dengan</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($project as $row)
                            <tr>
                                <td>{{ $row->judul }}</td>
                                <td style="cursor:pointer;" data-toggle="modal"  data-target="#gambar_project{{ $row->id }}" ><img src="{{ asset('storage/'.$row->thumbnail) }}" style="width:150px; border-radius:6px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);"></td>
                                <td><a href="{{ $row->link }}">{{ $row->link }}</a></td>
                                <td>{{ $row->deskripsi }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-none dropdown-toggle" type="button" id="petugasdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop">
                                            <a class="dropdown-item" href="{{ route('project.edit', $row->id) }}"><i class="fa fa-edit"></i> Edit project</a>
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> Lihat project</a>
                                            <a class="dropdown-item hapusProject" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('project.destroy', $row->id) }}" method="post" id="hapusProject{{ $row->id }}">
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
                      {{ $project->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </section>
      </div>


      <!-- Modal -->
    @foreach($project as $row)
    <div class="modal fade" id="gambar_project{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          $(".hapusProject").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Project',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusProject${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });

           @if(!$project->count())
             $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Project tidak ditemukan</h5></td>');
          @endif

        </script>
      @endsection
@endsection