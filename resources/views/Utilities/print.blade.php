<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            @foreach ($spk as $spkview)
                @if($spkview->spk_id == $spk_id)
                    {{ $spkview->spk_id }}
                    {{ $spkview->order_id }}
                    {{ $spkview->order->nama_order }}
                    {{ $spkview->status }}
                    {{ $spkview->deadline_produksi }}
                    {{ $spkview->user->namalengkap }}
                    @if($spkview->spkMesin != null)
                        {{ $spkview->spkMesin->kirim }}
                        {{ $spkview->spkMesin->ekspedisi }}
                        {{ $spkview->spkMesin->produksi->id_mesin }}
                        {{ $spkview->spkMesin->produksi->cetak }}
                        {{ $spkview->spkMesin->produksi->ukuran_bahan }}
                        {{ $spkview->spkMesin->produksi->set }}
                        {{ $spkview->spkMesin->produksi->keterangan }}
                        {{ $spkview->spkMesin->produksi->jumlah_cetak }}
                        {{ $spkview->spkMesin->produksi->hasil_cetak }}
                        {{ $spkview->spkMesin->produksi->tempat_cetak }}
                        {{ $spkview->spkMesin->produksi->acuan_cetak }}
                        {{ $spkview->spkMesin->produksi->jumlah_order }}
                        {{ $spkview->spkMesin->finishing->finishing}}
                        {{ $spkview->spkMesin->finishing->laminasi}}
                        {{ $spkview->spkMesin->finishing->potong_jadi }}
                        {{ $spkview->spkMesin->finishing->keterangan }}
                        {{ $spkview->spkMesin->bahan->nama_bahan }}
                        {{ $spkview->spkMesin->bahan->ukuran_plano }}
                        {{ $spkview->spkMesin->bahan->jumlah_bahan }}
                        {{ $spkview->spkMesin->bahan->ukuran_potong }}
                        {{ $spkview->spkMesin->bahan->satu_plano }}
                    @elseif($spkview->spkNota != null)
                        {{ $spkview->spkNota->nama_bahan }}
                        {{ $spkview->spkNota->tebal_bahan }}
                        {{ $spkview->spkNota->ukuran }}
                        {{ $spkview->spkNota->jumlah_cetak }}
                        {{ $spkview->spkNota->ukuran_jadi }}
                        {{ $spkview->spkNota->rangkap }}
                        {{ $spkview->spkNota->warna_rangkap }}
                        {{ $spkview->spkNota->cetak }}
                        {{ $spkview->spkNota->warna }}
                        {{ $spkview->spkNota->finishing }}
                        {{ $spkview->spkNota->numerator }}
                        {{ $spkview->spkNota->keterangan }}
                    @endif
                @endif
            @endforeach
        </tr>
        <script>
            window.print()
        </script>
</body>

</html>