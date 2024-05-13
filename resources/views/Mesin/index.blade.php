@extends('Component.app')

@section('Data Mesin')

@section('contents')

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="mb-0">Data Mesin</h2>
                @if(auth()->user()->role != "staff")
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-lg">
                        <i class="fa-solid fa-square-plus"></i> Tambah Data 
                    </button>
                @endif
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Mesin</th>
                                    <th>Nama Mesin</th>
                                    @if(auth()->user()->role != "staff")
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                        </tbody>
                            <tr>
                                <?php $no = 1; ?>
                                @foreach ($mesin as $msn)
                                    <td>{{ $no++}}</td>
                                    <td>{{ $msn->id_mesin}}</td>
                                    <td>{{ $msn->nama_mesin}}</td>
                                    @if(auth()->user()->role != "staff")
                                        <td>
                                            <form action="{{ url('dashboard-delete-mesin', $msn->id) }}"
                                                method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <a href="{{ 'dashboard-edit-mesin/' . $msn->id}}"
                                                    class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#modal-lg-edit{{ $msn->id}}">
                                                    <i class="fa-solid fa-pencil"></i> Edit</a>
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modal-lg-edit{{ $msn->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data Mesin</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ url('dashboard-edit-mesin', $msn->id) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="form-group">
                                                            <label>ID Mesin</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="ID Mesin" name="id_mesin"
                                                                value="{{ $msn->id_mesin }}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Mesin</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Nama Mesin" name="nama_mesin"
                                                                value="{{ $msn->nama_mesin }}">
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
<!--Modal Tambah Mesin-->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Mesin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="dashboard-tambah-mesin" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="{{Auth::user()->user_id}}" name="user_id">
                        </div>
                        <div class="form-group">
                            <label>Nama Mesin</label>
                            <input type="text" class="form-control" placeholder="Nama Mesin" name="nama_mesin">
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