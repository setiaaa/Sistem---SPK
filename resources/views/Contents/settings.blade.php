@extends('Component.app')

@section('title', 'Pengaturan')

@section('contents')
    <div class="card shadow mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php $no = 1; ?>
                    @foreach ($users as $usr)
                        @if ($usr->user_id == Auth::user()->user_id)
                            <form action="{{ url('settings-edit', Auth::user()->user_id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" class="form-control" placeholder="User ID" name="user_id"
                                    value="{{ $usr->user_id }}" readonly>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="namalengkap"
                                        value="{{ $usr->namalengkap }}">
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Kata Sandi</label>
                                    <input type="password" class="form-control" placeholder="Kata Sandi" name="password"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="col btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
