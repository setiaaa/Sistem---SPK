@extends('Component.app')

@section('title', 'Data User')

@section('contents')
    <div class="d-flex align-items-center justify-content-end mt-3 mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            <i class="fa-solid fa-square-plus"></i> Tambah Data
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="/dashboard-user" class="d-flex align-items-center">
                    <label for="per_page" class="me-2">Show:
                        <select name="per_page" id="per_page" class="form-select form-select-sm me-2"
                            onchange="this.form.submit()">
                            <option value="5"{{ request('per_page') == 5 ? ' selected' : '' }}>5</option>
                            <option value="10"{{ request('per_page') == 10 ? ' selected' : '' }}>10</option>
                            <option value="15"{{ request('per_page') == 15 ? ' selected' : '' }}>15 </option>
                            <option value="20"{{ request('per_page') == 20 ? ' selected' : '' }}>20</option>
                        </select>
                        entries</label>
                </form>
                <form method="GET" action="/dashboard-user" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control form-control-sm me-2"
                        placeholder="Cari user..." value="{{ request('search') }}">
                    <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <a
                                    href="{{ '/dashboard-user' }}?sort=user_id&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    User ID
                                    @if (request('sort') == 'user_id')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ '/dashboard-user' }}?sort=namalengkap&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Nama
                                    @if (request('sort') == 'namalengkap')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ '/dashboard-user' }}?sort=username&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Username
                                    @if (request('sort') == 'username')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ '/dashboard-user' }}?sort=email&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Email
                                    @if (request('sort') == 'email')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a
                                    href="{{ '/dashboard-user' }}?sort=role&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Jabatan
                                    @if (request('sort') == 'role')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    </tbody>
                    <tr>
                        @if (session('successDeleted'))
                            <div class="alert alert-success">
                                {{ session('successDeleted') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <?php $no = 1; ?>
                        @foreach ($users as $usr)
                            <td>{{ $no++ }}</td>
                            <td>{{ $usr->user_id }}</td>
                            <td>{{ $usr->namalengkap }}</td>
                            <td>{{ $usr->username }}</td>
                            <td>{{ $usr->email }}</td>
                            <td>{{ $usr->role }}</td>
                            <td>
                                <form action="{{ url('dashboard-delete-user', $usr->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <a href="{{ 'dashboard-edit-user/' . $usr->id }}" class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#modal-lg-edit{{ $usr->id }}">
                                        <i class="fa-solid fa-pencil"></i> Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="modal-lg-edit{{ $usr->id }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('dashboard-edit-user', $usr->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <input type="text" class="form-control" placeholder="User ID" name="user_id"
                                                value="{{ $usr->user_id }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" placeholder="Nama Lengkap"
                                                name="namalengkap" value="{{ $usr->namalengkap }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username" value="{{ $usr->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="Email" name="email"
                                                value="{{ $usr->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="form-label form-label-sm">Jabatan</label>
                                            <select class="custom-select rounded-0" name="role" id="role"
                                                aria-label="Default select example">
                                                <option value="{{ $usr->role }}" selected disabled>{{ $usr->role }}
                                                </option>
                                                <option value="Manajer Produksi">Manajer Produksi</option>
                                                <option value="SPV Produksi">SPV Produksi</option>
                                                <option value="Staff Produksi">Staff Produksi</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                        changes</button>
                                </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach
                </table>
                <div>
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    </div>
    <!--Modal Tambah User-->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="dashboard-tambah-user" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="namalengkap">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-label form-label-sm">Jabatan</label>
                            <select class="custom-select rounded-0" name="role" id="role"
                                aria-label="Default select example" required>
                                <option value="Tidak Menyebutkan" selected disabled>Pilih Jabatan</option>
                                <option value="superadmin">Manajer Produksi</option>
                                <option value="admin">SPV Produksi</option>
                                <option value="staff">Staff Produksi</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
