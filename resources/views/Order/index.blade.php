@extends('Component.app')

@section('Data Order')

@section('contents')

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Data Order</h2>
        @if(auth()->user()->role != "staff")
            <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#modal-lg">
                <i class="fa-solid fa-square-plus"></i> Tambah Data 
            </button>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" action="/dashboard-order" class="d-flex align-items-center">
                    <label for="per_page" class="me-2">Show:
                    <select name="per_page" id="per_page" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                        <option value="5"{{ request('per_page') == 5 ? ' selected' : '' }}>5</option>
                        <option value="10"{{ request('per_page') == 10 ? ' selected' : '' }}>10</option>
                        <option value="15"{{ request('per_page') == 15 ? ' selected' : '' }}>15 </option>
                        <option value="20"{{ request('per_page') == 20 ? ' selected' : '' }}>20</option>
                    </select>
                    entries</label>
                </form>
                <form method="GET" action="/dashboard-order" class="d-flex align-items-center">
                    <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari order..." value="{{ request('search') }}">
                    <button class="btn btn-primary btn-sm" type="submit">Cari</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <a href="{{ ('/dashboard-order') }}?sort=order_id&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Order ID
                                    @if(request('sort') == 'order_id')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ ('/dashboard-order') }}?sort=nama_order&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Nama Order
                                    @if(request('sort') == 'nama_order')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ ('/dashboard-order') }}?sort=deadline&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Tenggat Waktu
                                    @if(request('sort') == 'deadline')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ ('/dashboard-order') }}?sort=lokasi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}&per_page={{ request('per_page') }}&search={{ request('search') }}">
                                    Lokasi
                                    @if(request('sort') == 'lokasi')
                                        <i class="fa fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            @if(auth()->user()->role != "staff")
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    </tbody>
                    <tr>
                    <?php $no = 1; ?>
                    @foreach ($order as $odr)
                        <td>{{ $no++}}</td>
                        <td>{{ $odr->order_id}}</td>
                        <td>{{ $odr->nama_order}}</td>
                        <td>{{ $odr->deadline}}</td>
                        <td>{{ $odr->lokasi}}</td>
                        @if(auth()->user()->role != "staff")
                            <td>
                                <form action="{{ url('dashboard-delete-order', $odr->id) }}"
                                    method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <a href="{{ 'dashboard-edit-order/' . $odr->id }}"
                                        class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modal-lg-edit{{ $odr->id }}">
                                        <i class="fa-solid fa-pencil"></i> Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')"><i
                                            class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal-lg-edit{{ $odr->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Data Order</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ url('dashboard-edit-order', $odr->id) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group">
                                                <label>Order ID</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Order ID" name="order_id"
                                                    value="{{ $odr->order_id }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Order</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Nama Order" name="namaorder"
                                                    value="{{ $odr->nama_order }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tenggat Waktu</label>
                                                <input type="date" class="form-control"
                                                    placeholder="deadline" name="deadline"
                                                    value="{{ $odr->deadline }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Lokasi" name="lokasi"
                                                    value="{{ $odr->lokasi }}">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                    {{ $order->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    </div>
    <!--Modal Tambah Order-->
    <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="dashboard-tambah-order" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" class="form-control" value="{{Auth::user()->user_id}}" name="user_id">
                </div>
                <div class="form-group">
                    <label>Nama Order</label>
                    <input type="text" class="form-control" placeholder="Nama Order" name="nama_order">
                </div>
                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" class="form-control" placeholder="Deadline" name="deadline">
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" placeholder="Lokasi" name="lokasi">
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