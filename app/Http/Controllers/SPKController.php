<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use App\Models\SPKMesin;
use App\Models\SPKNota;
use App\Models\Produksi;
use App\Models\Finishing;
use App\Models\Bahan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SPKController extends Controller
{
    public function index(){
        $spk = SPK::with(['spkMesin.produksi', 'spkMesin.finishing', 'spkMesin.bahan','spkNota', 'order', 'user'])->get();
        if ($spk) {
            return response()->json([
                'spk' => $spk
            ]);
        } else {
            return response()->json(['message' => 'SPK tidak ditemukan'], 404);
        }
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
        } catch (Exception $e) {
            console.log($e);
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
        } catch (Exception $e) {
            session()->flash('error', 'Failed to update data.', $e);
            document.write($e);
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
