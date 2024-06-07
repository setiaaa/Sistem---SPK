<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan parameter sorting dan arah sorting
        $sort = $request->input('sort', 'user_id');
        $direction = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 5);

        // Query dasar untuk model User
        $query = User::query();

        // Menambahkan kondisi pencarian jika ada input search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('user_id', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', '%' .$request->search. '%')
                ->orWhere('namalengkap', 'LIKE', '%' .$request->search. '%')
                ->orWhere('role', 'LIKE', '%' .$request->search. '%');
        }

        // Menambahkan kondisi sorting
        $query->orderBy($sort, $direction);

        // Menjalankan query dengan paginasi menggunakan nilai per_page yang diberikan
        $data['users'] = $query->paginate($perPage);

        // Mengirimkan data ke view
        return view('User.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $input['user_id'] = $this->generateUserId(); // Generate the automatic user ID
            User::create($input);
            session()->flash('success', 'Data added successfully.');
            return redirect('dashboard-user')->with('success', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    protected function generateUserId()
    {
        $lastUser = User::latest('user_id')->first();

        if (!$lastUser) {
            return 'USR-001'; // If no previous user exists, start with KRW-001
        }

        $lastId = intval(substr($lastUser->user_id, 4)); // Extract the numeric portion of the last ID
        $newId = $lastId + 1;
        $paddedNewId = str_pad($newId, 3, '0', STR_PAD_LEFT); // Pad the new ID with leading zeros if necessary
        $generatedId = 'USR-' . $paddedNewId;

        return $generatedId;
    }

    public function edit($id)
    {
        $data['users'] = User::find($id);
        return view('content.user.dashboard-edit-user', $data);
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->all();
            User::find($id)->update($input);
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard-user')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.');
            return redirect()->back();
        }
    }

    public function delete($id, Request $request)
    {
        $user = User::find($id);
        try {
            $user->delete($request->all());
            session()->flash('successDeleted', 'Data deleted successfully.');
            return redirect('dashboard-user')->with('successDeleted', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete data.');
            return redirect()->back();
        }
    }
    public function getID(){
        return $this->user_id;
    }

}
