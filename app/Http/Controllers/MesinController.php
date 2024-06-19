<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesin;
use App\Models\User;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan parameter sorting dan arah sorting
        $sort = $request->input('sort', 'id_mesin');
        $direction = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 5);

        // Query dasar untuk model Mesin
        $query = Mesin::query();

        // Menambahkan kondisi pencarian jika ada input search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id_mesin', 'LIKE', "%{$search}%")
                ->orWhere('nama_mesin', 'LIKE', "%{$search}%");
        }

        // Menambahkan kondisi sorting
        $query->orderBy($sort, $direction);

        // Menjalankan query dengan paginasi menggunakan nilai per_page yang diberikan
        $data['mesin'] = $query->paginate($perPage);

        // Mengirimkan data ke view
        return view('Mesin.index', $data);
        
    }

    public function spk()
    {
        $odr['order'] = Mesin::all();
        // return view('Contents.dashboard', $odr);
        return $odr['order'];
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $input['id_mesin'] = $this->generateMesinId(); // Generate the automatic ID Mesin
            Mesin::create($input);
            session()->flash('success', 'Data added successfully.');
            return redirect('dashboard-mesin')->with('success', true);
        } catch (Exception $e) {
            console.log($e);
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    protected function generateMesinId()
    {
        $lastMesin = Mesin::latest('id_mesin')->first();

        if (!$lastMesin) {
            return 'MSN-001'; // If no previous 'mesin' exists, start with KRW-001
        }

        $lastId = intval(substr($lastMesin->id_mesin, 4)); // Extract the numeric portion of the last ID
        $newId = $lastId + 1;
        $paddedNewId = str_pad($newId, 3, '0', STR_PAD_LEFT); // Pad the new ID with leading zeros if necessary
        $generatedId = 'MSN-' . $paddedNewId;

        return $generatedId;
    }

    public function edit($id)
    {
        $data['mesin'] = Mesin::find($id);
        return view('content.user.dashboard-edit-mesin', $data);
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->all();
            Mesin::find($id)->update($input);
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard-mesin')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.');
            return redirect()->back();
        }
    }

    public function delete($id, Request $request)
    {
        $mesin = Mesin::find($id);
        try {
            $mesin->delete($request->all());
            session()->flash('successDeleted', 'Data deleted successfully.');
            return redirect('dashboard-mesin')->with('successDeleted', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete data.');
            return redirect()->back();
        }
    }

}
