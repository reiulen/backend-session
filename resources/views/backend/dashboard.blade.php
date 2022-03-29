@extends('backend.layout.main')
@section('content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
         <div class="section-header mt-4">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            @if(Auth::user()->role == 'Admin')
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-dark">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Author</h4>
                    </div>
                    <div class="card-body">
                      {{ App\Models\User::count() }}
                    </div>
                </div>
              </div>
            </div>
            @endif
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Post</h4>
                  </div>
                  <div class="card-body">
                    {{ (Auth::user()->role == 'Admin' ? App\Models\Post::count() : App\Models\Post::where('user_id', Auth::user()->id)->count()) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-images"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Galeri Foto</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Gallery::count() }}
                  </div>
                </div>
              </div>
            </div>               
          </div>
          <div class="row">
             <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Semua Artikel Populer</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="ChartSemuaArtikelPopuler"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Artikel Populer Olehmu</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="ChartArtikelPopuler"></canvas>
                  </div>
                </div>
              </div>
            @if(Auth::user()->role == 'Admin')
              <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Authors</h4>
                  </div>
                  <div class="card-body">
                    <div class="row pb-2">
                      @foreach(App\Models\User::latest()->get() as $row)
                      <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                        <div class="avatar-item">
                          <img alt="image" src="{{ asset($row->avatar) }}" class="img-fluid" data-toggle="tooltip" title="{{ $row->nama }}">
                          <div class="avatar-badge" title="{{ $row->role }}" data-toggle="tooltip">@if($row->role == 'Admin')
                            <i class="fas fa-cog"></i>
                          @else
                          <i class="fas fa-pencil-alt"></i>
                          @endif
                        </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
          <div class="row">
            <div class="col-lg-10 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Post Terbaru</h4>
                  <div class="card-header-action">
                    <a href="{{ route('post.index') }}" class="btn btn-dark">View All</a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Judul</th>
                          <th>Author</th>
                          <th>Views</th>
                        </tr>
                      </thead>
                      <tbody>                         
                        @foreach((Auth::user()->role == 'Admin' ? App\Models\Post::with(['user', 'kategori'])->latest()->limit(10)->get() : App\Models\Post::with(['user', 'kategori'])->where(['user_id' => Auth::user()->id])->latest()->limit(10)->get()) as $row)
                          <tr>
                            <td>
                              {{ substr($row->judul, 0, 50) }}..
                              <div class="table-links">
                                in <a href="#">{{ $row->kategori->kategori }}</a>
                                <div class="bullet"></div>
                                <a href="http://sessionclass.engineer">View</a>
                              </div>
                            </td>
                            <td>
                              <a href="#" class="font-weight-600"><img src="{{ asset($row->user->avatar) }}" alt="avatar" width="30" class="rounded-circle mr-1"> {{ $row->user->nama }}</a>
                            </td>
                            <td>
                              <i class="fas fa-eye"></i> {{ $row->views }}
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      @section('script')
        <script src="{{ asset('assets/js/page/chart.js') }}"></script>
        <script>
          $(document).ready(function(){
             var ctx = document.getElementById("ChartSemuaArtikelPopuler").getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: [@foreach(App\Models\Post::OrderByDesc('views')->limit(7)->get() as $row)"{{ substr($row->judul, 0,40)}}...", @endforeach],
                  datasets: [{
                    label: 'Views',
                    data: [@foreach(App\Models\Post::OrderByDesc('views')->limit(7)->get() as $row){{ $row->views }}, @endforeach],
                    backgroundColor: [
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                        '#191d21',
                    ],
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                  }]
                },
                options: {
                  legend: {
                    display: false
                  },
                  scales: {
                    yAxes: [{
                      gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                      },
                      ticks: {
                        beginAtZero: true,
                        stepSize: 150
                      }
                    }],
                    xAxes: [{
                      ticks: {
                        display: false
                      },
                      gridLines: {
                        display: false
                      }
                    }]
                  },
                }
              });
              var ctx = document.getElementById("ChartArtikelPopuler").getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: [@foreach(App\Models\Post::where('user_id', Auth::user()->id)->OrderByDesc('views')->limit(7)->get() as $row)"{{ substr($row->judul, 0,40)}}...", @endforeach],
                  datasets: [{
                    label: 'Views',
                    data: [@foreach(App\Models\Post::where('user_id', Auth::user()->id)->OrderByDesc('views')->limit(7)->get() as $row){{ $row->views }}, @endforeach],
                    backgroundColor: [
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                        '#191d21',
                    ],
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                  }]
                },
                options: {
                  legend: {
                    display: false
                  },
                  scales: {
                    yAxes: [{
                      gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                      },
                      ticks: {
                        beginAtZero: true,
                        stepSize: 150
                      }
                    }],
                    xAxes: [{
                      ticks: {
                        display: false
                      },
                      gridLines: {
                        display: false
                      }
                    }]
                  },
                }
              });
          });
          
        </script>
      @endsection
@endsection