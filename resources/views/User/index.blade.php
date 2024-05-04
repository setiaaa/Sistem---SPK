@extends('Component.app')

@section('Data User')

@section('contents')

            <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">Data User</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-lg">
                            <i class="fa-solid fa-square-plus"></i> Tambah Data 
                        </button>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            </tbody>
                            <tr>
                            <?php $no = 1; ?>
                            @foreach ($users as $usr)
                                <td>{{ $no++}}</td>
                                <td>{{ $usr->user_id}}</td>
                                <td>{{ $usr->namalengkap}}</td>
                                <td>{{ $usr->username}}</td>
                                <td>{{ $usr->email}}</td>
                                <td>{{ $usr->role}}</td>
                                <td>
                                    <form action="{{ url('dashboard-delete-user', $usr->id) }}"
                                        method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ 'dashboard-edit-user/' . $usr->id }}"
                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-lg-edit{{ $usr->id }}">
                                            <i class="fa-solid fa-pencil"></i> Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modal-lg-edit{{ $usr->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data User</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ url('dashboard-edit-user', $usr->id) }}"
                                                    method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <div class="form-group">
                                                        <label>User ID</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="User ID" name="user_id"
                                                            value="{{ $usr->user_id }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Nama Lengkap" name="namalengkap"
                                                            value="{{ $usr->namalengkap }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Username" name="username"
                                                            value="{{ $usr->username }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Email" name="email"
                                                            value="{{ $usr->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role"
                                                            class="form-label form-label-sm">Jabatan</label>
                                                        <select class="custom-select rounded-0"
                                                            name="role" id="role"
                                                            aria-label="Default select example">
                                                            <option value="{{ $usr->role }}"
                                                                selected disabled>{{ $usr->role }}
                                                            </option>
                                                            <option value="Manajer Produksi">Manajer Produksi</option>
                                                            <option value="SPV Produksi">SPV Produksi</option>
                                                            <option value="Staff Produksi">Staff Produksi</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
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
                                <option value="Manajer Produksi">Manajer Produksi</option>
                                <option value="SPV Produksi">SPV Produksi</option>
                                <option value="Staff Produksi">Staff Produksi</option>
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