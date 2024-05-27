@extends('Component.app')

@section('Dashboard')

@section('contents')
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="mb-0">Dashboard</h2>
        </div>
        <div class="row">
            @include('Component.TodoCard')
            @include('Component.RunningCard')
            @include('Component.DoneCard')
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                @include('Contents.bar-chart')
            </div>
            <div class="col-xl-4 col-lg-5">
                @include('Contents.donut-chart')
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="d-flex align-items-center justify-content-end mt-2 mr-3 ">
                @if(auth()->user()->role != "staff")
                    <button type="button" class="btn btn-primary" data-toggle="modal"data-target="#modal-lg">
                        {!! file_get_contents('icons/add-square.svg') !!}     Tambah Data 
                    </button>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SPK ID</th>
                                <th>Order ID</th>
                                <th>Nama Order</th>
                                <th>Status</th>
                                <th>Tenggat Waktu</th>
                                @if(auth()->user()->role != "staff")
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        </tbody>
                        <tr>
                        <?php $no = 1; ?>
                        @foreach ($data as $spkview)
                            <td>{{ $no++}}</td>
                            <td>{{ $spkview->spk_id}}</td>
                            <td>{{ $spkview->order_id}}</td>
                            <td>{{ $spkview->nama_order}}</td>
                            <td>{{ $spkview->status}}</td>
                            <td>{{ $spkview->deadline_produksi}}</td>
                            @if(auth()->user()->role != "staff")
                                <td>
                                    <form action="{{ url('dashboard-delete-spk', $spkview->spk_id) }}"
                                        method="post" style="width:fit-content">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ 'dashboard-edit-spk/'.$spkview->spk_id}}"
                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-lg-edit{{ $spkview->spk_id}}">
                                            {!! file_get_contents('icons/edit.svg') !!} Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            {!! file_get_contents('icons/trash.svg') !!} Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="modal-lg-edit{{ $spkview->spk_id }}">
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
                                                action="{{ url('dashboard-edit-spk', $spkview->spk_id) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="spk_id" class="form-label form-label-sm">SPK ID</label>
                                                    <input type="text" readonly class="form-control" 
                                                            id="spk_id" name="spk_id"
                                                            value="{{ $spkview->spk_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                                                    <select class="custom-select rounded-0" name="order_id" id="order_id"
                                                        aria-label="Default select example" required>
                                                        <option value="Tidak Menyebutkan" selected disabled>Nama Order</option>
                                                        @foreach ($odr as $order)
                                                            {{-- <option value="{{ $order->id }}" {{ $spkview->order_id == $order->id ? 'selected' : '' }}>
                                                                {{ $order->nama_order }} --}}
                                                            @if($spkview->order_id == $order->order_id)
                                                                <option value="{{ $order->order_id }}" selected>{{ $order->nama_order }}</option>
                                                            @else
                                                                <option value="{{ $order->order_id }}">{{ $order->nama_order }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">    
                                                    <label>Status</label>
                                                    <select class="custom-select rounded-0" name="order_id" id="order_id"
                                                        aria-label="Default select example" required>
                                                        <option value="Tidak Menyebutkan" selected disabled>Status</option>
                                                        <option value="Todo">Todo</option>
                                                        <option value="Running">Running</option>
                                                        <option value="Done">Done</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <input type="date" class="form-control" placeholder="Tanggal" name="tanggal"
                                                            value="{{ $spkview->tanggal }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tenggat Waktu</label>
                                                    <input type="date" class="form-control" placeholder="Deadline" name="deadline_produksi"
                                                    value="{{ $spkview->deadline_produksi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Lokasi</label>
                                                    <input type="text" class="form-control" placeholder="Lokasi" name="lokasi_produksi"
                                                    value="{{ $spkview->lokasi_produksi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kirim</label>
                                                    <input type="date" class="form-control" placeholder="Kirim" name="kirim"
                                                    value="{{ $spkview->kirim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ekspedisi</label>
                                                    <input type="text" class="form-control" placeholder="Ekspedisi" name="ekspedisi"
                                                    value="{{ $spkview->ekspedisi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Mesin</label>
                                                    <input type="text" class="form-control" placeholder="Nama Mesin" name="nama_mesin"
                                                    value="{{ $spkview->nama_mesin }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Cetak</label>
                                                    <input type="text" class="form-control" placeholder="Cetak" name="cetak"
                                                    value="{{ $spkview->cetak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ukuran</label>
                                                    <input type="text" class="form-control" placeholder="Ukuran" name="ukuran_bahan"
                                                    value="{{ $spkview->ukuran_bahan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Set</label>
                                                    <input type="text" class="form-control" placeholder="Set" name="set"
                                                    value="{{ $spkview->set }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan1"
                                                    value="{{ $spkview->keterangan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah Cetak</label>
                                                    <input type="text" class="form-control" placeholder="Jumlah cetak" name="jumlah_cetak"
                                                    value="{{ $spkview->jumlah_cetak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Hasil Cetak</label>
                                                    <input type="text" class="form-control" placeholder="Jumlah Cetak" name="hasil_cetak"
                                                    value="{{ $spkview->hasil_cetak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat Cetak</label>
                                                    <input type="text" class="form-control" placeholder="Tempat Cetak" name="tempat_cetak"
                                                    value="{{ $spkview->tempat_cetak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Acuan Cetak</label>
                                                    <input type="text" class="form-control" placeholder="Acuan Cetak" name="acuan_cetak"
                                                    value="{{ $spkview->acuan_cetak }}">
                                                </div>
                                                <div class="form-group ">
                                                    <label>Jumlah Order</label>
                                                    <input type="text" class="form-control" placeholder="Jumlah Order" name="jumlah_order"
                                                    value="{{ $spkview->jumlah_order }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Finishing</label>
                                                    <input type="text" class="form-control" placeholder="Finishing" name="finishing"
                                                    value="{{ $spkview->finishing }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Laminasi</label>
                                                    <input type="text" class="form-control" placeholder="Laminasi" name="laminasi"
                                                    value="{{ $spkview->laminasi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Potong Jadi</label>
                                                    <input type="text" class="form-control" placeholder="Potong Jadi" name="potong_jadi"
                                                    value="{{ $spkview->potong_jadi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan"
                                                    value="{{ $spkview->keterangan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Bahan</label>
                                                    <input type="text" class="form-control" placeholder="Nama Bahan" name="nama_bahan"
                                                    value="{{ $spkview->nama_bahan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ukuran Plano</label>
                                                    <input type="text" class="form-control" placeholder="Ukuran Plano" name="ukuran_plano"
                                                    value="{{ $spkview->ukuran_plano }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah Bahan</label>
                                                    <input type="text" class="form-control" placeholder="Jumlah Bahan" name="jumlah_bahan"
                                                    value="{{ $spkview->jumlah_bahan }}"> 
                                                </div>
                                                <div class="form-group">
                                                    <label>Ukuran Potong</label>
                                                    <input type="text" class="form-control" placeholder="Ukuran Potong" name="ukuran_potong"
                                                    value="{{ $spkview->ukuran_potong }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Satu Plano</label>
                                                    <input type="text" class="form-control" placeholder="Satu Plano" name="satu_plano"
                                                    value="{{ $spkview->satu_plano }}">
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
                <form action="dashboard-tambah-spk" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                        <select class="custom-select rounded-0" name="order_id" id="order_id"
                            aria-label="Default select example" required>
                            <option value="Tidak Menyebutkan" selected disabled>Pilih Order</option>
                            {{-- <option value="20240520001">Manajer Produksi</option>
                            <option value="admin">SPV Produksi</option>
                            <option value="staff">Staff Produksi</option> --}}
                            @foreach ($odr as $order)
                                <option value="{{ $order->order_id }}">{{ $order->nama_order }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">    
                        <label>Status</label>
                        <select class="custom-select rounded-0" name="status" id="order_id"
                            aria-label="Default select example" required>
                            <option value="Tidak Menyebutkan" selected disabled>Status</option>
                            <option value="Todo">Todo</option>
                            <option value="Running">Running</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label>Deadline</label>
                        <input type="date" class="form-control" placeholder="Deadline" name="deadline_produksi">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" placeholder="Lokasi" name="lokasi_produksi">
                    </div>
                    <div class="form-group">
                        <label>Kirim</label>
                        <input type="date" class="form-control" placeholder="Kirim" name="kirim">
                    </div>
                    <div class="form-group">
                        <label>Ekspedisi</label>
                        <input type="text" class="form-control" placeholder="Ekspedisi" name="ekspedisi">
                    </div>
                    <div class="form-group">
                        <label>Nama Mesin</label>
                        <input type="text" class="form-control" placeholder="Nama Mesin" name="nama_mesin">
                    </div>
                    <div class="form-group">
                        <label>Cetak</label>
                        <input type="text" class="form-control" placeholder="Cetak" name="cetak">
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" class="form-control" placeholder="Ukuran" name="ukuran_bahan">
                    </div>
                    <div class="form-group">
                        <label>Set</label>
                        <input type="text" class="form-control" placeholder="Set" name="set">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Cetak</label>
                        <input type="text" class="form-control" placeholder="Jumlah cetak" name="jumlah_cetak">
                    </div>
                    <div class="form-group">
                        <label>Hasil Cetak</label>
                        <input type="text" class="form-control" placeholder="Jumlah Cetak" name="hasil_cetak">
                    </div>
                    <div class="form-group">
                        <label>Tempat Cetak</label>
                        <input type="text" class="form-control" placeholder="Tempat Cetak" name="tempat_cetak">
                    </div>
                    <div class="form-group">
                        <label>Acuan Cetak</label>
                        <input type="text" class="form-control" placeholder="Acuan Cetak" name="acuan_cetak">
                    </div>
                    <div class="form-group ">
                        <label>Jumlah Order</label>
                        <input type="text" class="form-control" placeholder="Jumlah Order" name="jumlah_order">
                    </div>
                    <div class="form-group">
                        <label>Finishing</label>
                        <input type="text" class="form-control" placeholder="Finishing" name="finishing">
                    </div>
                    <div class="form-group">
                        <label>Laminasi</label>
                        <input type="text" class="form-control" placeholder="Laminasi" name="laminasi">
                    </div>
                    <div class="form-group">
                        <label>Potongan Jadi</label>
                        <input type="text" class="form-control" placeholder="Potongan Jadi" name="potong_jadi">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan</label>
                        <input type="text" class="form-control" placeholder="Nama Bahan" name="nama_bahan">
                    </div>
                    <div class="form-group">
                        <label>Ukuran Plano</label>
                        <input type="text" class="form-control" placeholder="Ukuran Plano" name="ukuran_plano">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Bahan</label>
                        <input type="text" class="form-control" placeholder="Jumlah Bahan" name="jumlah_bahan"> 
                    </div>
                    <div class="form-group">
                        <label>Ukuran Potong</label>
                        <input type="text" class="form-control" placeholder="Ukuran Potong" name="ukuran_potong">
                    </div>
                    <div class="form-group">
                        <label>Satu Plano</label>
                        <input type="text" class="form-control" placeholder="Satu Plano" name="satu_plano">
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