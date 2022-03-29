
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand my-2">
            <a class="link" href="{{ url('admin/dashboard') }}" style="font-size: 20px"><b>SESSION BLOG</b></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a class="link" href="{{ url('admin/dashboard') }}">SE</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="{{ ($title == 'Dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link link active"><i class="fas fa-columns"></i><span>Dashboard</span></a>
              </li>
              @if(Auth::user()->role == 'Admin')
              <li class="menu-header">Pengelolaan Pengguna</li>
              <li class="nav-item dropdown {{ ($title == 'Data Anggota' || $title == 'Tambah Anggota' || $title == 'Edit Anggota' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Anggota</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Data Anggota') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('anggota.index') }}">Data Anggota</a></li>
                  <li {{ ($title == 'Tambah Anggota') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('anggota.create') }}">Tambah Anggota</a></li>
                </ul>
              </li>
              @endif
              <li class="menu-header">Konten</li>
              <li class="nav-item dropdown {{ ($title == 'Post' || $title == 'Tambah Post' || $title == 'Edit Post' || $title == 'Kategori' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>Post</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Post') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('post.index') }}">Data Post</a></li>
                  <li {{ ($title == 'Kategori') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('kategori.index') }}">Kategori</a></li>
                  <li {{ ($title == 'Tambah Post') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('post.create') }}">Tambah Post</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ ($title == 'Project' || $title == 'Tambah Project' || $title == 'Edit Project' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-desktop"></i> <span>Project</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Project') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('project.index') }}">Data Project</a></li>
                  <li {{ ($title == 'Tambah Project') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('project.create') }}">Tambah Project</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ ($title == 'Gallery' || $title == 'Tambah Gallery' || $title == 'Edit Gallery' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-images"></i> <span>Gallery</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Gallery') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('gallery.index') }}">Data Gallery</a></li>
                  <li {{ ($title == 'Tambah Gallery') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('gallery.create') }}">Tambah Gallery</a></li>
                </ul>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="/" class="btn btn-dark btn-lg btn-block btn-icon-split text-light">
                <i class="fas fa-rocket"></i> Lihat Web
              </a>
            </div>
        </aside>
      </div>
