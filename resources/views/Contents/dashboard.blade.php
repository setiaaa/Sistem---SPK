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
            @if (auth()->user()->role != 'staff')
                <button type="button" class="btn btn-primary" data-toggle="modal"data-target="#modal-lg">
                    {!! file_get_contents('icons/add-square.svg') !!} Tambah Data
                </button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h4>SPK Mesin</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SPK ID</th>
                            <th>Order ID</th>
                            <th>Nama Order</th>
                            <th>Status</th>
                            <th>Tenggat Waktu</th>
                            @if (auth()->user()->role != 'staff')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    </tbody>
                    <tr>
                        <?php $noSPKMesin = 1; ?>
                        @foreach ($dataSPKMesin as $spkview)
                            <td>{{ $noSPKMesin++ }}</td>
                            <td>{{ $spkview->spk_id }}</td>
                            <td>{{ $spkview->order_id }}</td>
                            <td>{{ $spkview->nama_order }}</td>
                            <td>{{ $spkview->status }}</td>
                            <td>{{ $spkview->deadline_produksi }}</td>
                            @if (auth()->user()->role != 'staff')
                                <td>
                                    <form action="{{ url('dashboard-delete-spk', $spkview->spk_id) }}" method="post"
                                        style="width:fit-content">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ 'dashboard-edit-spk/'.$spkview->spk_id}}"
                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-md-edit{{ $spkview->spk_id }}">
                                            {!! file_get_contents('icons/edit.svg') !!} Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            {!! file_get_contents('icons/trash.svg') !!} Hapus</button>
                                    </form>
                                </td>
                            @endif
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="modal-md-edit{{ $spkview->spk_id }}">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data Order</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                            <input type="text" readonly class="form-control" id="spk_id"
                                                name="spk_id" value="{{ $spkview->spk_id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                                            <select class="custom-select rounded-0" name="order_id" id="order_id"
                                                aria-label="Default select example" required>
                                                <option value="Tidak Menyebutkan" selected disabled>Nama Order</option>
                                                @foreach ($odr as $order)
                                                    {{-- <option value="{{ $order->id }}" {{ $spkview->order_id == $order->id ? 'selected' : '' }}>
                                                                    {{ $order->nama_order }} --}}
                                                    @if ($spkview->order_id == $order->order_id)
                                                        <option value="{{ $order->order_id }}" selected>
                                                            {{ $order->nama_order }}</option>
                                                    @else
                                                        <option value="{{ $order->order_id }}">
                                                            {{ $order->nama_order }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="custom-select rounded-0" name="order_id" id="order_id"
                                                aria-label="Default select example" required>
                                                <option value="Tidak Menyebutkan" selected disabled>Status</option>
                                                <option value="Todo" {{ $spkview->status == 'Todo' ? 'selected' : '' }}>Todo</option>
                                                <option value="Running" {{ $spkview->status == 'Running' ? 'selected' : '' }}>Running</option>
                                                <option value="Done"{{ $spkview->status == 'Done' ? 'selected' : '' }}>
                                                    Done</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name="tanggal"
                                                value="{{ $spkview->tanggal }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Deadline</label>
                                            <input type="date" class="form-control" placeholder="Deadline"
                                                name="deadline_produksi" value="{{ $spkview->deadline_produksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" placeholder="Lokasi"
                                                name="lokasi_produksi" value="{{ $spkview->lokasi_produksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Kirim</label>
                                            <input type="date" class="form-control" placeholder="Kirim" name="kirim"
                                                value="{{ $spkview->kirim }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Ekspedisi</label>
                                            <input type="text" class="form-control" placeholder="Ekspedisi"
                                                name="ekspedisi" value="{{ $spkview->ekspedisi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Mesin</label>
                                            <input type="text" class="form-control" placeholder="Nama Mesin"
                                                name="nama_mesin" value="{{ $spkview->nama_mesin }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Cetak</label>
                                            <input type="text" class="form-control" placeholder="Cetak"
                                                name="cetak" value="{{ $spkview->cetak }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran</label>
                                            <input type="text" class="form-control" placeholder="Ukuran"
                                                name="ukuran_bahan" value="{{ $spkview->ukuran_bahan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Set</label>
                                            <input type="text" class="form-control" placeholder="Set" name="set"
                                                value="{{ $spkview->set }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" placeholder="Keterangan"
                                                name="keterangan1" value="{{ $spkview->keterangan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Cetak</label>
                                            <input type="text" class="form-control" placeholder="Jumlah cetak"
                                                name="jumlah_cetak" value="{{ $spkview->jumlah_cetak }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Hasil Cetak</label>
                                            <input type="text" class="form-control" placeholder="Jumlah Cetak"
                                                name="hasil_cetak" value="{{ $spkview->hasil_cetak }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Cetak</label>
                                            <input type="text" class="form-control" placeholder="Tempat Cetak"
                                                name="tempat_cetak" value="{{ $spkview->tempat_cetak }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Acuan Cetak</label>
                                            <input type="text" class="form-control" placeholder="Acuan Cetak"
                                                name="acuan_cetak" value="{{ $spkview->acuan_cetak }}">
                                        </div>
                                        <div class="form-group ">
                                            <label>Jumlah Order</label>
                                            <input type="text" class="form-control" placeholder="Jumlah Order"
                                                name="jumlah_order" value="{{ $spkview->jumlah_order }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Finishing</label>
                                            <input type="text" class="form-control" placeholder="Finishing"
                                                name="finishing" value="{{ $spkview->finishing }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Laminasi</label>
                                            <input type="text" class="form-control" placeholder="Laminasi"
                                                name="laminasi" value="{{ $spkview->laminasi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Potong Jadi</label>
                                            <input type="text" class="form-control" placeholder="Potong Jadi"
                                                name="potong_jadi" value="{{ $spkview->potong_jadi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" placeholder="Keterangan"
                                                name="keterangan" value="{{ $spkview->keterangan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bahan</label>
                                            <input type="text" class="form-control" placeholder="Nama Bahan"
                                                name="nama_bahan" value="{{ $spkview->nama_bahan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran Plano</label>
                                            <input type="text" class="form-control" placeholder="Ukuran Plano"
                                                name="ukuran_plano" value="{{ $spkview->ukuran_plano }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Bahan</label>
                                            <input type="text" class="form-control" placeholder="Jumlah Bahan"
                                                name="jumlah_bahan" value="{{ $spkview->jumlah_bahan }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran Potong</label>
                                            <input type="text" class="form-control" placeholder="Ukuran Potong"
                                                name="ukuran_potong" value="{{ $spkview->ukuran_potong }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Satu Plano</label>
                                            <input type="text" class="form-control" placeholder="Satu Plano"
                                                name="satu_plano" value="{{ $spkview->satu_plano }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        @endforeach
                </table>
            </div>
            <div class="table-responsive">
                <h4>SPK Nota</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SPK ID</th>
                            <th>Order ID</th>
                            <th>Nama Order</th>
                            <th>Status</th>
                            <th>Tenggat Waktu</th>
                            @if (auth()->user()->role != 'staff')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    </tbody>
                    <tr>
                        <?php $noSPKMesin = 1; ?>
                        @foreach ($dataSPKNota as $spkview)
                            <td>{{ $noSPKMesin++ }}</td>
                            <td>{{ $spkview->spk_id }}</td>
                            <td>{{ $spkview->order_id }}</td>
                            <td>{{ $spkview->nama_order }}</td>
                            <td>{{ $spkview->status }}</td>
                            <td>{{ $spkview->deadline_produksi }}</td>
                            @if (auth()->user()->role != 'staff')
                                <td>
                                    <form action="{{ url('dashboard-delete-spk', $spkview->spk_id) }}" method="post"
                                        style="width:fit-content">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a href="{{ 'dashboard-edit-spk/' . $spkview->spk_id }}"
                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modal-lg-edit{{ $spkview->spk_id }}">
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
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data SPK Nota</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('dashboard-edit-spk', $spkview->spk_id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label for="spk_id" class="form-label form-label-sm">SPK ID</label>
                                            <input type="text" readonly class="form-control" id="spk_id"
                                                name="spk_id" value="{{ $spkview->spk_id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                                            <select class="form-control custom-select" name="order_id" id="order_id"
                                                aria-label="Default select example" required>
                                                <option value="Tidak Menyebutkan" selected disabled>Pilih Order</option>
                                                {{-- <option value="20240520001">Manajer Produksi</option>
                                                            <option value="admin">SPV Produksi</option>
                                                            <option value="staff">Staff Produksi</option> --}}
                                                @foreach ($odr as $order)
                                                    {{-- <option value="{{ $order->id }}" {{ $spkview->order_id == $order->id ? 'selected' : '' }}>
                                                                    {{ $order->nama_order }} --}}
                                                    @if ($spkview->order_id == $order->order_id)
                                                        <option value="{{ $order->order_id }}" selected>
                                                            {{ $order->nama_order }}</option>
                                                    @else
                                                        <option value="{{ $order->order_id }}">
                                                            {{ $order->nama_order }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="custom-select rounded-0" name="order_id" id="order_id"
                                                aria-label="Default select example" required>
                                                <option value="Tidak Menyebutkan" selected disabled>Status</option>
                                                <option value="Todo" {{ $spkview->status == 'Todo' ? 'selected' : '' }}>
                                                    Todo</option>
                                                <option value="Running"
                                                    {{ $spkview->status == 'Running' ? 'selected' : '' }}>Running</option>
                                                <option value="Done"{{ $spkview->status == 'Done' ? 'selected' : '' }}>
                                                    Done</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" placeholder="Tanggal"
                                                    name="tanggal" value="{{ $spkview->tanggal }}">
                                            </div>
                                            <div class="col">
                                                <label>Deadline</label>
                                                <input type="date" class="form-control" placeholder="Deadline"
                                                    name="deadline_produksi" value="{{ $spkview->deadline_produksi }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" placeholder="Lokasi"
                                                name="lokasi_produksi" value="{{ $spkview->lokasi_produksi }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bahan</label>
                                            <input type="text" class="form-control" placeholder="Nama Bahan"
                                                name="nama_bahan" value="{{ $spkview->nama_bahan }}">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col">
                                                <label>Tebal Bahan</label>
                                                <input type="text" class="form-control" placeholder="Tebal Bahan"
                                                    name="tebal_bahan" value="{{ $spkview->tebal_bahan }}">
                                            </div>
                                            <div class="form-group col">
                                                <label>Ukuran</label>
                                                <input type="text" class="form-control" placeholder="Ukuran"
                                                    name="ukuran" value="{{ $spkview->ukuran }}">
                                            </div>
                                            <div class="form-group col">
                                                <label>Jumlah Cetak</label>
                                                <input type="text" class="form-control" placeholder="Jumlah cetak"
                                                    name="jumlah_cetak" value="{{ $spkview->jumlah_cetak }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran Jadi</label>
                                            {{-- <input type="text" class="form-control" placeholder="Ukuran Jadi" name="ukuran_jadi"> --}}
                                            <div class="radio-button-container d-flex justify-content-between row">
                                                <div class="button col p-0">
                                                    <input type="radio" id="1" name="ukuran_jadi"
                                                        value="1">
                                                    <label class="btn" for="1">1</label>
                                                </div>
                                                <div class="button col p-0">
                                                    <input type="radio" id="1/2" name="ukuran_jadi"
                                                        value="1/2">
                                                    <label class="btn" for="1/2">1/2</label>
                                                </div>
                                                <div class="button col p-0">
                                                    <input type="radio" id="1/3" name="ukuran_jadi"
                                                        value="1/3">
                                                    <label class="btn" for="1/3">1/3</label>
                                                </div>
                                                <div class="button col p-0">
                                                    <input type="radio" id="1/4" name="ukuran_jadi"
                                                        value="1/4">
                                                    <label class="btn" for="1/4">1/4</label>
                                                </div>
                                                <div class="button col p-0">
                                                    <input type="radio" id="1/6" name="ukuran_jadi"
                                                        value="1/6">
                                                    <label class="btn" for="1/6">1/6</label>
                                                </div>
                                                <div class="button col p-0">
                                                    <input type="radio" id="1/8" name="ukuran_jadi"
                                                        value="1/8">
                                                    <label class="btn" for="1/8">1/8</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Rangkap</label>
                                            <input type="text" class="form-control" placeholder="Rangkap"
                                                name="rangkap" value="{{ $spkview->rangkap }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Warna Rangkap</label>
                                            <input type="text" class="form-control" placeholder="Warna Rangkap"
                                                name="warna_rangkap" value="{{ $spkview->warna_rangkap }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Cetak</label>
                                            <input type="text" class="form-control" placeholder="Cetak"
                                                name="cetak" value="{{ $spkview->cetak }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" class="form-control" placeholder="Warna"
                                                name="warna" value="{{ $spkview->warna }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Finishing</label>
                                            <input type="text" class="form-control" placeholder="Finishing"
                                                name="finishing" value="{{ $spkview->finishing }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Numerator</label>
                                            <input type="text" class="form-control" placeholder="Numerator"
                                                name="numerator" value="{{ $spkview->numerator }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" placeholder="Keterangan"
                                                name="keterangan" value="{{ $spkview->keterangan }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                </table>
            </div>
        </div>
    </div>

    </div>
    <!--Modal Tambah Order-->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data SPK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="tab-menu-button-container d-flex justify-content-center">
                    <button class="spkmesin-btn btn btn">SPK Mesin</button>
                    <button class="spknota-btn">SPK Nota</button>
                </div> --}}
                    <div class="tab-menu-button-container d-flex justify-content-center align-items-start mb-3">
                        <div
                            class="spkmesin-btn tab-button spkmesin-wrapper align-items-center d-flex justify-content-center">
                            <div class="spk-mesin">SPK Mesin</div>
                        </div>
                        <div
                            class="spknota-btn tab-button spknota-wrapper align-items-center d-flex justify-content-center">
                            <div class="spk-nota">SPK Nota</div>
                        </div>
                    </div>
                    <div class="spkmesinform">
                        <form action="dashboard-tambah-spk-mesin" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                                <select class="form-control custom-select" name="order_id" id="order_id"
                                    aria-label="Default select example" required>
                                    <option value="Tidak Menyebutkan" selected disabled>Pilih Order</option>
                                    @foreach ($odr as $order)
                                        <option value="{{ $order->order_id }}">{{ $order->nama_order }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Status</label>
                                    <select class="form-control custom-select" name="status" id="order_id"
                                        aria-label="Default select example" required>
                                        <option value="Tidak Menyebutkan" selected disabled>Status</option>
                                        <option value="Todo">Todo</option>
                                        <option value="Running">Running</option>
                                        <option value="Done">Done</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Deadline</label>
                                    <input type="date" class="form-control" placeholder="Deadline"
                                        name="deadline_produksi" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" placeholder="Lokasi" name="lokasi_produksi"
                                    required>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Kirim</label>
                                    <input type="text" class="form-control" placeholder="Kirim" name="kirim"
                                        required>
                                </div>
                                <div class="col-auto">
                                    <label>Ekspedisi</label>
                                    <input type="text" class="form-control" placeholder="Ekspedisi" name="ekspedisi"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Mesin</label>
                                <input type="text" class="form-control" placeholder="Nama Mesin" name="nama_mesin"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Cetak</label>
                                {{-- <input type="text" class="form-control" placeholder="Cetak" name="cetak"> --}}
                                <div class="radio-button-container d-flex justify-content-between row">
                                    <div class="button col p-0">
                                        <input type="radio" id="cetak1" name="cetak" value="1 Muka" required>
                                        <label class="btn" for="cetak1">1 Muka</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="cetak2" name="cetak" value="BBS" required>
                                        <label class="btn" for="cetak2">BBS</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="cetak3" name="cetak" value="BBB" required>
                                        <label class="btn" for="cetak4">BBB</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="cetak4" name="cetak" value="8 Plat" required>
                                        <label class="btn" for="cetak4">8 Plat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ukuran</label>
                                <input type="text" class="form-control" placeholder="Ukuran" name="ukuran_bahan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Set</label>
                                <input type="text" class="form-control" placeholder="Set" name="set" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan"
                                    required>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Jumlah Cetak</label>
                                    <input type="number" class="form-control" placeholder="Jumlah cetak"
                                        name="jumlah_cetak" required>
                                </div>
                                <div class="col">
                                    <label>Hasil Cetak</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Cetak"
                                        name="hasil_cetak" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Cetak</label>
                                <input type="text" class="form-control" placeholder="Tempat Cetak"
                                    name="tempat_cetak" required>
                            </div>
                            <div class="form-group">
                                <label>Acuan Cetak</label>
                                <input type="text" class="form-control" placeholder="Acuan Cetak" name="acuan_cetak"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Order</label>
                                <input type="number" class="form-control" placeholder="Jumlah Order"
                                    name="jumlah_order" required>
                            </div>
                            <div class="form-group">
                                <label>Finishing</label>
                                {{-- <input type="text" class="form-control" placeholder="Finishing" name="finishing"> --}}
                                <div class="radio-button-container d-flex justify-content-between row">
                                    <div class="button col p-0">
                                        <input type="radio" id="foil" name="finishing" value="Foil" required>
                                        <label class="btn" for="foil">Foil</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="embos" name="finishing" value="Embos" required>
                                        <label class="btn" for="embos">Embos</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="pond" name="finishing" value="Pond" required>
                                        <label class="btn" for="pond">Pond</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Laminasi</label>
                                {{-- <input type="text" class="form-control" placeholder="Laminasi" name="laminasi"> --}}
                                <div class="radio-button-container d-flex justify-content-between row">
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi1" name="laminasi" value="Doff">
                                        <label class="btn" for="laminasi1">Doff</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi2" name="laminasi" value="Glossy">
                                        <label class="btn" for="laminasi2">Glossy</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi3" name="laminasi" value="UV">
                                        <label class="btn" for="laminasi3">UV</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi4" name="laminasi" value="Spot UV">
                                        <label class="btn" for="laminasi4">Spot UV</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi5" name="laminasi" value="1 Muka">
                                        <label class="btn" for="laminasi5">1 Muka</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="checkbox" id="laminasi6" name="laminasi" value="2 Muka">
                                        <label class="btn" for="laminasi6">2 Muka</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Potongan Jadi</label>
                                <input type="text" class="form-control" placeholder="Potongan Jadi"
                                    name="potong_jadi" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Nama Bahan</label>
                                <input type="text" class="form-control" placeholder="Nama Bahan" name="nama_bahan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Ukuran Plano</label>
                                {{-- <input type="text" class="form-control" placeholder="Ukuran Plano" name="ukuran_plano"> --}}
                                <div class="radio-button-container d-flex justify-content-between row">
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano1" name="ukuran_plano" value="61x86"
                                            required>
                                        <label class="btn" for="ukuran_plano1">61x86</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano2" name="ukuran_plano" value="61x92"
                                            required>
                                        <label class="btn" for="ukuran_plano2">61x92</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano3" name="ukuran_plano" value="65x90"
                                            required>
                                        <label class="btn" for="ukuran_plano3">65x90</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano4" name="ukuran_plano" value="65x100"
                                            required>
                                        <label class="btn" for="ukuran_plano4">65x100</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano5" name="ukuran_plano" value="61x879x1096"
                                            required>
                                        <label class="btn" for="ukuran_plano5">79x109</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="ukuran_plano6" name="ukuran_plano" value="90x120"
                                            required>
                                        <label class="btn" for="ukuran_plano6">90x120</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label>Jumlah Bahan</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Bahan"
                                        name="jumlah_bahan" required>
                                </div>
                                <div class="col">
                                    <label>Ukuran Potong</label>
                                    <input type="text" class="form-control" placeholder="Ukuran Potong"
                                        name="ukuran_potong" required>
                                </div>
                                <div class="col">
                                    <label>Satu Plano</label>
                                    <input type="number" class="form-control" placeholder="Satu Plano"
                                        name="satu_plano" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="spknotaform">
                        <form action="dashboard-tambah-spk-nota" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="order_id" class="form-label form-label-sm">Nama Order</label>
                                <select class="form-control custom-select" name="order_id" id="order_id"
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
                                <select class="form-control custom-select" name="status" id="order_id"
                                    aria-label="Default select example" required>
                                    <option value="Tidak Menyebutkan" selected disabled>Status</option>
                                    <option value="Todo">Todo</option>
                                    <option value="Running">Running</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" placeholder="Tanggal" name="tanggal">
                                </div>
                                <div class="col">
                                    <label>Deadline</label>
                                    <input type="date" class="form-control" placeholder="Deadline"
                                        name="deadline_produksi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" placeholder="Lokasi" name="lokasi_produksi">
                            </div>
                            <div class="form-group">
                                <label>Nama Bahan</label>
                                <input type="text" class="form-control" placeholder="Nama Bahan" name="nama_bahan">
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Tebal Bahan</label>
                                    <input type="text" class="form-control" placeholder="Tebal Bahan"
                                        name="tebal_bahan">
                                </div>
                                <div class="form-group col">
                                    <label>Ukuran</label>
                                    <input type="text" class="form-control" placeholder="Ukuran" name="ukuran">
                                </div>
                                <div class="form-group col">
                                    <label>Jumlah Cetak</label>
                                    <input type="text" class="form-control" placeholder="Jumlah cetak"
                                        name="jumlah_cetak">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ukuran Jadi</label>
                                {{-- <input type="text" class="form-control" placeholder="Ukuran Jadi" name="ukuran_jadi"> --}}
                                <div class="radio-button-container d-flex justify-content-between row">
                                    <div class="button col p-0">
                                        <input type="radio" id="1" name="ukuran_jadi" value="1" />
                                        <label class="btn" for="1">1</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="1/2" name="ukuran_jadi" value="1/2" />
                                        <label class="btn" for="1/2">1/2</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="1/3" name="ukuran_jadi" value="1/3" />
                                        <label class="btn" for="1/3">1/3</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="1/4" name="ukuran_jadi" value="1/4" />
                                        <label class="btn" for="1/4">1/4</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="1/6" name="ukuran_jadi" value="1/6" />
                                        <label class="btn" for="1/6">1/6</label>
                                    </div>
                                    <div class="button col p-0">
                                        <input type="radio" id="1/8" name="ukuran_jadi" value="1/8" />
                                        <label class="btn" for="1/8">1/8</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Rangkap</label>
                                <input type="text" class="form-control" placeholder="Rangkap" name="rangkap">
                            </div>
                            <div class="form-group">
                                <label>Warna Rangkap</label>
                                <input type="text" class="form-control" placeholder="Warna Rangkap"
                                    name="warna_rangkap">
                            </div>
                            <div class="form-group">
                                <label>Cetak</label>
                                <input type="text" class="form-control" placeholder="Cetak" name="cetak">
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" placeholder="Warna" name="warna">
                            </div>
                            <div class="form-group">
                                <label>Finishing</label>
                                <input type="text" class="form-control" placeholder="Finishing" name="finishing">
                            </div>
                            <div class="form-group">
                                <label>Numerator</label>
                                <input type="text" class="form-control" placeholder="Numerator" name="numerator">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            const btn = document.querySelector(".spkmesin-btn");
            const btn2 = document.querySelector(".spknota-btn");
            const formSPKMesin = document.querySelector(".spkmesinform");
            const formSPKNota = document.querySelector(".spknotaform");
            const buttonWrapper = document.querySelector(".tab-menu-button-container");
            const button = document.querySelector(".tab-button");
            formSPKMesin.style.display = "block";
            formSPKNota.style.display = "none";
            btn.classList.add("tab-button-active");

            if (btn && btn2) {
                btn.addEventListener("click", () => {
                    btn2.style.transition = "linear 0.1s";
                    formSPKMesin.style.display = "block";
                    formSPKNota.style.display = "none";
                    btn.classList.add("tab-button-active");
                    btn2.classList.remove("tab-button-active");
                });
                btn2.addEventListener("click", () => {
                    btn.style.transition = "linear 0.1s";
                    formSPKMesin.style.display = "none";
                    formSPKNota.style.display = "block";
                    btn.classList.remove("tab-button-active");
                    btn2.classList.add("tab-button-active");
                });
            }
        });
    </script>
@endsection
