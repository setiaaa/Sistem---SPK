<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPK;
use App\Models\SpkMesin;
use App\Models\Produksi;
use App\Models\Finishing;
use App\Models\Bahan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SPKController extends Controller
{
    public function index(){
        
        // return view('Contents.dashboard', compact('data'));
        return $data['spk'] = DB::table('spk')
        ->join('spkmesin', 'spk.spk_id', '=', 'spkmesin.spk_id')
        ->join('orders', 'spk.order_id', '=', 'orders.order_id')
        ->join('produksi', 'spk.spk_id', '=', 'produksi.spk_id')
        ->join('finishing', 'spk.spk_id', '=', 'finishing.spk_id')
        ->join('bahan', 'spk.spk_id', '=', 'bahan.spk_id')
        ->select('spk.*', 'orders.*', 'spkmesin.*', 'produksi.*', 'finishing.*', 'bahan.*')
        ->get();
        
        return view('Contents.dashboard');
    }
    public function getData()
    {
        // $spk = SPK::select(
            $spk = 
            DB::table('spk')
            ->select(
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('status', '==', 'Done')
            ->groupBy('month')
            ->get();

        $labels = json_encode($spk->pluck('month'));
        $count = json_encode($spk->pluck('count'));

        return (compact('labels', 'count'));
    }

    public function store(Request $request){
        $input = $request->all();
        try{
            $input['spk_id'] = $this->generateMesinId(); // Generate the automatic ID Mesin
            // $input['nama_order'] = "Test";
            SPK::create(
                $input
                // $input['nama_order'],
                // $input['status'],
                // $input['tanggal']
            );
            SpkMesin::create(
                $input
                // input['order_id'],
                // input['nama_order'],
                // input['deadline_produksi'],
                // input['lokasi_produksi'],
                // input['kirim'],
                // input['ekspedisi']
            );
            Produksi::create(
                $input
            //     input['nama_mesin'],
            //     input['cetak'],
            //     input['ukuran_bahan'],
            //     input['set'],
            //     input['keterangan'],
            //     input['jumlah_cetak'],
            //     input['hasil_cetak'],
            //     input['tempat_cetak'],
            //     input['acuan_cetak'],
            //     input['jumlah_order']
            );
            Finishing::create(
                $input
            //     input['finishing'],
            //     input['laminasi'],
            //     input['potongan_jadi'],
            //     input['keterangan'],
            );
            Bahan::create(
                $input
            //     input['spk_id'],
            //     input['nama_bahan'],
            //     input['ukuran_plano'],
            //     input['jumlah_bahan'],
            //     input['ukuran_potong'],
            //     input['satu_plano']
            );
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
        $data['spk'][] = [
            SPK::find($id),
            SPKMesin::find($id),
            Produksi::find($id),
            Finishing::find($id),
            Bahan::find($id)];
        return view('content.user.dashboard-spk-edit', $data);
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->all();
            
            // SPK::find($id)->update($input);
            // SPKMesin::find($id)->update($input);
            // Produksi::find($id)->update($input);
            // Finishing::find($id)->update($input);
            // Bahan::find($id)->update($input);
            
            $data = DB::table('spk')
                ->join('spkmesin', 'spk.spk_id', '=', 'spkmesin.spk_id')
                ->join('orders', 'spk.order_id', '=', 'orders.order_id')
                ->join('produksi', 'spk.spk_id', '=', 'produksi.spk_id')
                ->join('finishing', 'spk.spk_id', '=', 'finishing.spk_id')
                ->join('bahan', 'spk.spk_id', '=', 'bahan.spk_id')
                ->where('spk.spk_id', $id)
                ->update([
                    'spk.order_id' => $input['order_id'],
                    'spk.status' => $input['status'],
                    'spk.tanggal' => $input['tanggal'],
                    'spkmesin.deadline_produksi' => $input['deadline_produksi'],
                    'spkmesin.lokasi_produksi' => $input['lokasi_produksi'],
                    'spkmesin.kirim' => $input['kirim'],
                    'spkmesin.ekspedisi' => $input['ekspedisi'],
                    'produksi.nama_mesin' => $input['nama_mesin'],
                    'produksi.cetak' => $input['cetak'],
                    'produksi.ukuran_bahan' => $input['ukuran_bahan'],
                    'produksi.set' => $input['set'],
                    'produksi.keterangan' => $input['keterangan'],
                    'produksi.jumlah_cetak' => $input['jumlah_cetak'],
                    'produksi.hasil_cetak' => $input['hasil_cetak'],
                    'produksi.tempat_cetak' => $input['tempat_cetak'],
                    'produksi.acuan_cetak' => $input['acuan_cetak'],
                    'produksi.jumlah_order' => $input['jumlah_order'],
                    'finishing.finishing' => $input['finishing'],
                    'finishing.laminasi' => $input['laminasi'],
                    'finishing.potong_jadi' => $input['potong_jadi'],
                    'finishing.keterangan' => $input['keterangan1'],
                    'bahan.nama_bahan' => $input['nama_bahan'],
                    'bahan.ukuran_plano' => $input['ukuran_plano'],
                    'bahan.jumlah_bahan' => $input['jumlah_bahan'],
                    'bahan.ukuran_potong' => $input['ukuran_potong'],
                    'bahan.satu_plano' => $input['satu_plano']
                ]);
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
            SPKMesin::find($id),
            Produksi::find($id),
            Finishing::find($id),
            Bahan::find($id)        
        ];
        try {
            $data = function() { 
                DB::table('spk')
                ->where('spk_id', $id)
                ->delete();
                DB::table('bahan')
                ->where('spk_id', $id)
                ->delete();
                DB::table('produksi')
                ->where('spk_id', $id)
                ->delete();
                DB::table('finishing')
                ->where('spk_id', $id)
                ->delete();
                DB::table('spkmesin')
                ->where('spk_id', $id)
                ->delete();
            };
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
