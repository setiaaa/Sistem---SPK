<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use App\Models\SPKMesin;
use App\Models\SPKNota;
use App\Models\Produksi;
use App\Models\Finishing;
use App\Models\Bahan;
use App\Models\Order;
use App\Models\Mesin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SPKController extends Controller
{
    public function index(){
        $spk = SPK::with(['spkMesin.produksi', 'spkMesin.finishing', 'spkMesin.bahan','spkNota', 'order', 'user'])->orderBy('tanggal', 'desc')->get();
        $odr = Order::all();
        $msn = Mesin::all();

        $card = DB::table('spk')
        ->select(
        DB::raw('status'),
        DB::raw('COUNT(*) as count')
        )->whereYear('tanggal', date('Y'))
        ->OrderBy(
            DB::raw('CASE 
                WHEN status = "Todo" THEN 1
                WHEN status = "Running" THEN 2
                WHEN Status = "Done" THEN 3
                END')
        )->groupBy('status')->get();

        $barChart = 
        DB::table('spk')
        ->selectRaw('MONTHNAME(tanggal) AS month, COUNT(*) AS count')
        ->groupBy('month')
        ->orderBy(
            DB::raw('CASE 
                WHEN month = "January" THEN 1
                WHEN month = "February" THEN 2
                WHEN month = "March" THEN 3
                When month = "April" THEN 4
                WHEN month = "May" THEN 5
                WHEN month = "June" THEN 6
                WHEN month = "July" THEN 7
                WHEN month = "August" THEN 8
                WHEN month = "September" THEN 9
                WHEN month = "October" THEN 10
                WHEN month = "November" THEN 11
                WHEN month = "December" THEN 12
                END'))->get();
        $barLabels = $barChart->pluck('month');
        $barCount = $barChart->pluck('count');
        
        $donutChart = DB::table('spk')
                ->select(
                DB::raw('status'),
                DB::raw('COUNT(*) as count')
                )
                ->whereYear('tanggal', date('Y'))
                // ->whereMonth('tanggal', date('m'))
                ->OrderBy(
                    DB::raw('CASE 
                        WHEN status = "Todo" THEN 1
                        WHEN status = "Running" THEN 2
                        WHEN Status = "Done" THEN 3
                        END')
                )->groupBy('status')
                ->get();
        $status = $donutChart->pluck('status');
        $count = $donutChart->pluck('count');
        $colors = ['#FFD623', '#3AC441', '#5889F4'];
        $hovers = ['#B79211', '#1D8D36', '#2C4DAF'];

        // dd($card);

        if ($spk) {
            return view('contents.dashboard', [
                'card' => $card,
                'SPK' => $spk,
                'odr' => $odr,
                'msn' => $msn,
                'barlabels' => $barLabels,
                'barcount' => $barCount,
                'donutstatus' => $status,
                'donutcount' => $count,
                'donutcolors' => $colors,
                'donuthovers' => $hovers,
            ]);
        } else {
            return response()->json(['message' => 'SPK tidak ditemukan'], 404);
        }
    }

    public function index2(){
        $spk = SPK::with(['spkMesin.produksi', 'spkMesin.finishing', 'spkMesin.bahan','spkNota', 'order', 'user'])->orderBy('tanggal', 'desc')->get();
        $odr = Order::all();
        $msn = Mesin::all();
        if ($spk) {
            return view('spk.index', [
                'SPK' => $spk,
                'odr' => $odr,
                'msn' => $msn,
            ]);
        } else {
            return response()->json(['message' => 'SPK tidak ditemukan'], 404);
        }
    }

    public function print($spk_id) {
        $spk = SPK::with(['spkMesin.produksi', 'spkMesin.finishing', 'spkMesin.bahan','spkNota', 'order', 'user'])->orderBy('tanggal', 'desc')
        ->get();
        return view('Utilities.print' , [
            'spk' => $spk,
            'spk_id' => $spk_id
        ]);
    }

    public function storeSPKNota(Request $request){
        $input = $request->all();
        $input['tanggal'] = date('Y-m-d');
        try{
            $input['spk_id'] = $this->generateMesinId(); // Generate the automatic ID SPK
            SPK::create($input);
            SPKNota::create($input);
            session()->flash('success', 'Data added successfully.');
            return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan');  
        }
        catch (\Exception $e) {
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    public function storeSPKMesin(Request $request){
        $input = $request->all();
        $input['spk_id'] = $this->generateMesinId(); // Generate the automatic ID SPK
        $input['tanggal'] = Carbon::now();
        $input['cetak'] = json_encode($request->cetak);
        $input['finishing'] = json_encode($request->finishing);
        $input['laminasi'] = json_encode($request->laminasi);
        try{
            $spk = SPK::create([
                'spk_id' => $input['spk_id'],
                'order_id' => $input['order_id'],
                'user_id' => $input['user_id'],
                'status' => $input['status'],
                'tanggal' => $input['tanggal'],
                'deadline_produksi' => $input['deadline_produksi'],
                'lokasi_produksi' => $input['lokasi_produksi']
            ]);

            $spkMesin = SPKMesin::create([
                'spk_id' => $input['spk_id'],
                'kirim' => $input['kirim'],
                'ekspedisi' => $input['ekspedisi']
            ]);

            $produksi = Produksi::create([
                'spk_id' => $input['spk_id'],
                'id_mesin' => $input['id_mesin'],
                'cetak' => $input['cetak'],
                'ukuran_bahan' => $input['ukuran_bahan'],
                'set' => $input['set'],
                'keterangan' => $input['keterangan'],
                'jumlah_cetak' => $input['jumlah_cetak'],
                'hasil_cetak' => $input['hasil_cetak'],
                'tempat_cetak' => $input['tempat_cetak'],
                'acuan_cetak' => $input['acuan_cetak'],
                'jumlah_order' => $input['jumlah_order']
            ]);

            $finishing = Finishing::create([
                'spk_id' => $input['spk_id'],
                'finishing' => $input['finishing'],
                'laminasi' => $input['laminasi'],
                'potong_jadi' => $input['potong_jadi'],
                'keterangan' => $input['keterangan']
            ]);

            $bahan = Bahan::create([
                'spk_id' => $input['spk_id'],
                'nama_bahan' => $input['nama_bahan'],
                'ukuran_plano' => $input['ukuran_plano'],
                'jumlah_bahan' => $input['jumlah_bahan'],
                'ukuran_potong' => $input['ukuran_potong'],
                'satu_plano' => $input['satu_plano'],
            ]);

            session()->flash('success', 'Data added successfully.');
            return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan');    
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    public function edit($spk_id)
    {
        // Cari SPK berdasarkan spk_id
        $spk = SPK::find($spk_id);

        return view('content.user.dashboard-edit-spk', $spk);
    }

    // Fungsi untuk mengupdate data SPK dan SPKMesin
    public function update(Request $request, $spk_id){
        $input = $request->all();
        // $input['tanggal'] = Carbon::now();
        // dd($input);
        try{
            $spk = SPK::where('spk_id', $spk_id);
            if($input['child'] == 'spkmesin'){
                $input['cetak'] = json_encode($request->cetak);
                $spk->update([
                    'order_id' => $input['order_id'],
                    'user_id' => $input['user_id'],
                    'status' => $input['status'],
                    'deadline_produksi' => $input['deadline_produksi'],
                    'lokasi_produksi' => $input['lokasi_produksi']
                ]);
                $spkMesin = SPKMesin::where('spk_id', $spk_id);
                $spkMesin->update([
                    'kirim' => $input['kirim'],
                    'ekspedisi' => $input['ekspedisi']
                ]);
                $produksi = Produksi::where('spk_id', $spk_id);
                $produksi->update([
                    'id_mesin' => $input['id_mesin'],
                    'cetak' => $input['cetak'],
                    'ukuran_bahan' => $input['ukuran_bahan'],
                    'set' => $input['set'],
                    'keterangan' => $input['keterangan'],
                    'jumlah_cetak' => $input['jumlah_cetak'],
                    'hasil_cetak' => $input['hasil_cetak'],
                    'tempat_cetak' => $input['tempat_cetak'],
                    'acuan_cetak' => $input['acuan_cetak'],
                    'jumlah_order' => $input['jumlah_order']
                ]);
                $finishing = Finishing::where('spk_id', $spk_id);
                $finishing->update([
                    'finishing' => $input['finishing'],
                    'laminasi' => $input['laminasi'],
                    'potong_jadi' => $input['potong_jadi'],
                    'keterangan' => $input['keterangan']
                ]);
                $bahan = Bahan::where('spk_id', $spk_id);
                $bahan->update([
                    'nama_bahan' => $input['nama_bahan'],
                    'ukuran_plano' => $input['ukuran_plano'],
                    'jumlah_bahan' => $input['jumlah_bahan'],
                    'ukuran_potong' => $input['ukuran_potong'],
                    'satu_plano' => $input['satu_plano'],
                ]);
            }
            else if($input['child'] == 'spknota'){
                $spk->update([
                    'order_id' => $input['order_id'],
                    'user_id' => $input['user_id'],
                    'status' => $input['status'],
                    'deadline_produksi' => $input['deadline_produksi'],
                    'lokasi_produksi' => $input['lokasi_produksi']
                ]);
                $spkNota = SPKNota::where('spk_id', $spk_id);
                $spkNota->update([
                    'nama_bahan' => $input['nama_bahan'],
                    'tebal_bahan' => $input['tebal_bahan'],
                    'ukuran' => $input['ukuran'],
                    'jumlah_cetak' => $input['jumlah_cetak'],
                    'ukuran_jadi' => $input['ukuran_jadi'],
                    'rangkap' => $input['rangkap'],
                    'warna_rangkap' => $input['warna_rangkap'],
                    'cetak' => $input['cetak'],
                    'warna' => $input['warna'],
                    'finishing' => $input['finishing'],
                    'numerator' => $input['numerator'],
                    'keterangan' => $input['keterangan']
                ]);
            }
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.', $e);
            return redirect()->back();
        }
    }

    public function delete($id, Request $request)
    {
        $spk = [
            SPK::find($id),
            SPKNota::find($id),
            SPKMesin::find($id),
            Produksi::find($id),
            Finishing::find($id),
            Bahan::find($id)
        ];
        try {
                Bahan::where('spk_id', $id)->delete();
                Produksi::where('spk_id', $id)->delete();
                Finishing::where('spk_id', $id)->delete();
                SPKMesin::where('spk_id', $id)->delete();
                SPKNota::where('spk_id', $id)->delete();    
                SPK::where('spk_id', $id)->delete();
            session()->flash('successDeleted', 'Data deleted successfully.');
            return redirect('dashboard')->with('successDeleted', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete data.');
            return redirect()->back();
        }
    }

    protected function generateMesinId()
    {
        $lastSPK = SPK::latest('spk_id')->first();
        if (!$lastSPK) {
            return 'SPK-001'; // If no previous 'mesin' exists, start with KRW-001
        }
        $lastId = intval(substr($lastSPK->spk_id, 4)); // Extract the numeric portion of the last ID
        $newId = $lastId + 1;
        $paddedNewId = str_pad($newId, 3, '0', STR_PAD_LEFT); // Pad the new ID with leading zeros if necessary
        $generatedId = 'SPK-' . $paddedNewId;

        return $generatedId;
    }
    
}
