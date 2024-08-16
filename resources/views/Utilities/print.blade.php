<!DOCTYPE html>
<html>
<head>
    @include('Utilities.kopsurat')
    <title>Surat Perintah Kerja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .page-break {
            page-break-before: always;
        }
        p {
            font-size: 12px; 
            line-height: 0.8; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            font-size: 12px;
        }
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:11px;
            overflow:hidden;padding:5px 5px;word-break:normal;}
        .tg .tg-0lax{text-align:left;vertical-align:top}
        
        @media print {
            .highlight {
                background-color: lightgrey !important;
                -webkit-print-color-adjust: exact; /* Untuk Chrome dan Safari */
                print-color-adjust: exact; /* Untuk browser lain */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($spk)
            @if ($printType === 'mesin')
                <!-- Printout untuk SPK Mesin -->
                <div class="header">
                    <h3>Surat Perintah Kerja - Mesin Besar/Kecil</h3>
                    <p><b>SPK ID: {{ $spk->spk_id }}</b></p>
                    <p>Tanggal: {{ date('d F Y', strtotime($spk->tanggal))}}</p>
                </div>
                <div class="content">
                    <h4>Detail Utama SPK</h4>
                    <table>
                        <tr>
                            <td style="width:70%;"><b>Order ID</b> : {{ $spk->order->order_id ?? 'N/A' }}</td>
                            <td style="width:30%;"><b>Lokasi Produksi</b> : {{ $spk->lokasi_produksi ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td style="width:70%;"><b>Nama Order</b> : {{ $spk->order->nama_order ?? 'N/A' }}</td>
                            <td style="width:30%;"><b>Kirim</b> : {{ $spk->spkmesin->kirim ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td style="width:70%;"><b>Deadline Produksi</b> : {{ $spk->deadline_produksi ?? 'N/A' }}</td>
                            <td style="width:30%;"><b>Ekspedisi</b> : {{ $spk->spkmesin->ekspedisi ?? 'N/A' }}</td>
                        </tr>
                    </table>
                    <br>
                    <!-- Informasi SPK Mesin -->
                    <table class="tg">
                        {{-- PRODUKSI --}}
                        <tr class="highlight" style="text-align: center; font-weight: bold;">
                            <td class="tg-0lax" colspan="3" style="text-align: center;">PRODUKSI</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Nama Mesin</b> : {{ $spk->spkmesin->produksi->mesin->nama_mesin ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Cetak</b> : {{ $spk->spkmesin->produksi->cetak ?? 'N/A' }}</td>
                            <td><b>Ukuran Bahan</b> : {{ $spk->spkmesin->produksi->ukuran_bahan ?? 'N/A' }}</td>
                            <td><b>Set</b> : {{ $spk->spkmesin->produksi->set ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Keterangan</b> : {{ $spk->spkmesin->produksi->keterangan ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Cetak</b> : {{ $spk->spkmesin->produksi->jumlah_cetak ?? 'N/A' }}</td>
                            <td><b>Hasil Cetak</b> : {{ $spk->spkmesin->produksi->hasil_cetak ?? 'N/A' }}</td>
                            <td><b>Jumlah Order</b> : {{ $spk->spkmesin->produksi->jumlah_order ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Tempat Cetak</b> : {{ $spk->spkmesin->produksi->tempat_cetak ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Acuan Cetak</b> : {{ $spk->spkmesin->produksi->acuan_cetak ?? 'N/A' }}</td>
                        </tr>
                        {{-- FINISHING --}}
                        <tr class="highlight" style="text-align: center; font-weight: bold;">
                            <td class="tg-0lax" colspan="3" style="text-align: center">FINISHING</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Finishing</b> : {{ $spk->spkmesin->finishing->finishing ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Laminasi</b> : {{ $spk->spkmesin->finishing->laminasi ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Potong Jadi</b> : {{ $spk->spkmesin->finishing->potong_jadi ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Keterangan</b> : {{ $spk->spkmesin->finishing->keterangan ?? 'N/A' }}</td>
                        </tr>
                        {{-- BAHAN --}}
                        <tr class="highlight" style="text-align: center; font-weight: bold;">
                            <td class="tg-0lax" colspan="3" style="text-align: center">BAHAN</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Nama Bahan</b> : {{ $spk->spkmesin->bahan->nama_bahan ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Ukuran Plano</b> : {{ $spk->spkmesin->bahan->ukuran_plano ?? 'N/A' }}</td>
                            <td><b>Jumlah Bahan</b> : {{ $spk->spkmesin->bahan->jumlah_bahan ?? 'N/A' }}</td>
                            <td><b>1 Plano Jadi</b> : {{ $spk->spkmesin->bahan->satu_plano ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Ukuran Potong</b> : {{ $spk->spkmesin->bahan->ukuran_potong ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

            @elseif ($printType === 'nota')
                <!-- Printout untuk SPK Nota -->
                <div class="header">
                    <h3>Surat Perintah Kerja - Nota</h3>
                    <p><b>SPK ID: {{ $spk->spk_id }}</b></p>
                    <p>Tanggal: {{ date('d F Y', strtotime($spk->tanggal))}}</p>
                </div>
                <div class="content">
                    <h4>Detail Utama SPK</h4>
                    <table>
                        <tr>
                            <td style="width:60%;"><b>Order ID</b> : {{ $spk->order->order_id ?? 'N/A' }}</td>
                            <td style="width:40%;"><b>Deadline Produksi</b> : {{ date('d F Y', strtotime($spk->deadline_produksi)) ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td style="width:60%;"><b>Nama Order</b> : {{ $spk->order->nama_order ?? 'N/A' }}</td>
                            <td style="width:40%;"><b>Lokasi Produksi</b> : {{ $spk->lokasi_produksi ?? 'N/A' }}</td>
                        </tr>
                    </table>
                    <br>
                    <!-- Informasi SPK Nota-->
                    <table class="tg">
                        {{-- PRODUKSI --}}
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Nama Bahan</b> : {{ $spk->spknota->nama_bahan ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="1"><b>Tebal Bahan</b> : {{ $spk->spknota->tebal_bahan ?? 'N/A' }}</td>
                            <td class="tg-0lax" colspan="2"><b>Ukuran</b> : {{ $spk->spknota->ukuran ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Cetak</b> : {{ $spk->spknota->jumlah_cetak ?? 'N/A' }}</td>
                            <td><b>Ukuran Jadi</b> : {{ $spk->spknota->ukuran_jadi ?? 'N/A' }}</td>
                            <td><b>Rangkap</b> : {{ $spk->spknota->rangkap ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Warna Rangkap</b> : {{ $spk->spknota->warna_rangkap ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Cetak</b> : {{ $spk->spknota->cetak ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Warna</b> : {{ $spk->spknota->warna ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Finishing</b> : {{ $spk->spknota->finishing ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Numerator (Mulai dari)</b> : {{ $spk->spknota->numerator ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="tg-0lax" colspan="3"><b>Keterangan</b> : {{ $spk->spknota->keterangan ?? 'N/A' }}</td>
                        </tr>
                        
                    </table>
                </div>
            @else
                <!-- Pesan jika tidak termasuk dalam SPK Mesin atau Nota -->
                <div class="header">
                    <h1>Surat Perintah Kerja</h1>
                    <p>SPK ID: {{ $spk->spk_id }}</p>
                    <p>Tanggal: </p>
                </div>
                <div class="content">
                    <p>SPK tidak ditemukan dalam kategori Mesin atau Nota.</p>
                </div>
            @endif
            <br>
            <div class="footer" style="text-align: left">
                <p> {{ $spk->lokasi_produksi }}, {{ date('d F Y', strtotime($spk->tanggal)) }}
                <p>
                    @if($spk->user->role === 'superadmin')
                        Manajer Produksi
                    @elseif($spk->user->role === 'admin')
                        SPV Produksi
                    @elseif ($spk->user->role === 'staff')
                        Staff Lapangan Produksi
                    @else
                        {{ $spk->user->role }}
                    @endif
                </p>
                <br>
                <p>_________________</p>
                <p>{{ $spk->user->namalengkap }}</p>
            </div>
        @else
            <p>SPK tidak ditemukan.</p>
        @endif
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
