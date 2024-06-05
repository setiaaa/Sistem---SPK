<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use App\Models\SpkMesin;
use App\Models\SPKNota;
use App\Models\Produksi;
use App\Models\Finishing;
use App\Models\Bahan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SPKController extends Controller
{
    public function indexSPKMesin(){
        // $search_text = $request->input['query'];
        return $data['spk'] = DB::table(DB::raw(
        'spk
        JOIN orders ON spk.order_id = orders.order_id
        JOIN spkmesin ON spk.spk_id = spkmesin.spk_id
        JOIN produksi ON spkmesin.spk_id = produksi.spk_id
        JOIN finishing ON spkmesin.spk_id = finishing.spk_id
        JOIN bahan ON spkmesin.spk_id = bahan.spk_id'))
        ->select('spk.*', 'orders.*', 'spkmesin.*', 'produksi.*', 'finishing.*', 'bahan.*')
        ->get();
        // return view('Contents.dashboard');
    }

    public function indexSPKNota(){
        return $data['spk'] = DB::table(DB::raw(
            'spk
            JOIN orders ON spk.order_id = orders.order_id
            JOIN spknota ON spk.spk_id = spknota.spk_id'))
            ->select('spk.*', 'orders.*', 'spknota.*')
            ->get();
    }
    public function index(){
        $data = SPK::all();
        return $data;
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
        catch (Exception $e) {
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    public function storeSPKMesin(Request $request){
        $input = $request->all();
        try{
            $input['spk_id'] = $this->generateMesinId(); // Generate the automatic ID SPK
            $input['tanggal'] = date('Y-m-d');
            // $input['nama_order'] = "Test";
            SPK::create($input);
            SpkMesin::create($input);
            Produksi::create($input);
            Finishing::create($input);
            Bahan::create($input);
            session()->flash('success', 'Data added successfully.');
            return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan');    
        } catch (Exception $e) {
            console.log($e);
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $data['spk'] = [
            SPK::find($id),
            SPKNota::find($id),
            SPKMesin::find($id),
            Produksi::find($id),
            Finishing::find($id),
            Bahan::find($id)];
            return route('dashboard', compact('data'));
    }
    public function editSPKNota($id)
    {
        $data['spk'] = [
            SPK::find($id),
            SPKNota::find($id),
        ];
    }

    public function update($id, Request $request)
    {
        // dd($input);
        $input = $request->all();
        try {
            // dd($input);
            // SPK::find($id)->update([
            //     'order_id' -> $input['order_id'],
            //     'status' => $input['status'],
            //     'tanggal' => $input['tanggal'],
            //     'deadline_produksi' => $input['deadline_produksi'],
            //     'lokasi_produksi' => $input['lokasi_produksi']
            // ]);
            
            // dd($input['ekspedisi']);
            // DB::table('spk')
            // ->where('spk_id', $id)
            // ->update(['status' => $input['status']]);
        
            // $spkmesin = DB::table('spkmesin')
            // ->where('spk_id', $id)
            // ->update(['ekspedisi' => $input['ekspedisi']]);
            // $spk = SPK::find($id);
            // $spk->update($input);
            // $dataSPKMesin = DB::table('spk')
            // ->join('spkmesin', 'spk.spk_id', '=', 'spkmesin.spk_id')
            // ->whereRaw('spk_id', '=', $id)
            // ->update([
            //     'spk.order_id' => $input['order_id'],
            //     'spk.status' => $input['status'],
            //     'spk.tanggal' => $input['tanggal'],
            //     'spk.deadline_produksi' => $input['deadline_produksi'],
            //     'spk.lokasi_produksi' => $input['lokasi_produksi'],
            //     'spkmesin.kirim' => $input['kirim'],
            //     'spkmesin.ekspedisi' => $input['ekspedisi']
            // ]);
            
            // $data = DB::table('spk')
            // ->join('spkmesin', 'spk.spk_id', '=', 'spkmesin.spk_id')
            // ->join('produksi', 'spkmesin.spk_id', '=', 'produksi.spk_id')
            // ->join('finishing', 'spkmesin.spk_id', '=', 'finishing.spk_id')
            // ->join('bahan', 'spkmesin.spk_id', '=', 'bahan.spk_id')
            // ->where('spk.spk_id', 'SPK-001')
            // ->update([
            //     'spk.status' => $input['status'],
            //     'spkmesin.ekspedisi' => $input['ekspedisi']
            
                // 'spk.order_id' => $input['order_id'],
                // 'spk.status' => $input['status'],
                // 'spk.tanggal' => $input['tanggal'],
                // 'spk.deadline_produksi' => $input['deadline_produksi'],
                // 'spk.lokasi_produksi' => $input['lokasi_produksi'],
                // 'spkmesin.kirim' => $input['kirim'],
                // 'spkmesin.ekspedisi' => $input['ekspedisi'],
                // 'produksi.nama_mesin' => $input['nama_mesin'],
                // 'produksi.cetak' => $input['cetak'],
                // 'produksi.ukuran_bahan' => $input['ukuran_bahan'],
                // 'produksi.set' => $input['set'],
                // 'produksi.keterangan' => $input['keterangan'],
                // 'produksi.jumlah_cetak' => $input['jumlah_cetak'],
                // 'produksi.hasil_cetak' => $input['hasil_cetak'],
                // 'produksi.tempat_cetak' => $input['tempat_cetak'],
                // 'produksi.acuan_cetak' => $input['acuan_cetak'],
                // 'produksi.jumlah_order' => $input['jumlah_order'],
                // 'finishing.finishing' => $input['finishing'],
                // 'finishing.laminasi' => $input['laminasi'],
                // 'finishing.potong_jadi' => $input['potong_jadi'],
                // 'finishing.keterangan' => $input['keterangan1'],
                // 'bahan.nama_bahan' => $input['nama_bahan'],
                // 'bahan.ukuran_plano' => $input['ukuran_plano'],
                // 'bahan.jumlah_bahan' => $input['jumlah_bahan'],
                // 'bahan.ukuran_potong' => $input['ukuran_potong'],
                // 'bahan.satu_plano' => $input['satu_plano']
            // ]);
            // $input = $request->all();
            // dd($input);
            // DB::table('spk')
            // ->join('spkmesin', 'spk.spk_id', '=', 'spkmesin.spk_id')
            // SPKMesin::find($id)->update($input);
            // SPKNota::find($id)->update($input);
            // Produksi::find($id)->update($input);
            // Finishing::find($id)->update($input);
            // Bahan::find($id)->update($input);
            // dd($spk)
            // $spk->update($input);
            // $spkmesin->update($input);
            // $spknota->update($input);
            // $produksi->update($input);
            // $finishing->update($input);
            // $bahan->update($input);
                // dd($data);
                $query = "
                UPDATE spk
                JOIN spkmesin ON spk.spk_id = spkmesin.spk_id
                JOIN produksi ON spkmesin.spk_id = produksi.spk_id
                JOIN finishing ON spkmesin.spk_id = finishing.spk_id
                JOIN bahan ON spkmesin.spk_id = bahan.spk_id
                SET 
                    spk.status = ?,
                    spkmesin.ekspedisi = ?
                WHERE spk.spk_id = ?
            ";

        
            DB::statement($query, [$input['status'], $input['ekspedisi'], $id]);
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.');
            return redirect()->back();
        }
    }public function updateSPKNota($id, Request $request)
    {
        try {
            $input = $request->all();
            // $data = DB::table('spk')
            // ->join('spknota', 'spk.spk_id', '=', 'spknota.spk_id')
            // ->where('spk.spk_id', $id)
            // ->update([
            //     'spk.order_id' => $input['order_id'],
            //     'spk.status' => $input['status'],
            //     'spk.tanggal' => $input['tanggal'],
            //     'spk.deadline_produksi' => $input['deadline_produksi'],
            //     'spk.lokasi_produksi' => $input['lokasi_produksi'],
            //     'spk.lokasi_produksi' => $input['lokasi_produksi'],
            //     'spknota.nama_bahan' => $input['nama_bahan'],
            //     'spknota.tebal_bahan' => $input['tebal_bahan'],
            //     'spknota.ukuran_bahan' => $input['ukuran_bahan'],
            //     'spknota.jumlah_cetak' => $input['jumlah_cetak'],
            //     'spknota.ukuran_jadi' => $input['ukuran_jadi'],
            //     'spknota.rangkap' => $input['rangkap'],
            //     'spknota.warna_rangkap' => $input['warna_rangkap'],
            //     'spknota.cetak' => $input['cetak'],
            //     'spknota.warna' => $input['warna'],
            //     'spknota.finishing' => $input['finishing'],
            //     'spknota.numerator' => $input['numerator'],
            //     'spknota.keterangan ' => $input['keterangan']
            // ]);
            
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.');
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
