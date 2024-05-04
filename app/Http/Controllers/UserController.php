<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
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

}
