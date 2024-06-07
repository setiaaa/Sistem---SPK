<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan parameter sorting dan arah sorting
        $sort = $request->input('sort', 'order_id');
        $direction = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 5);

        // Query dasar untuk model Mesin
        $query = Order::query();

        // Menambahkan kondisi pencarian jika ada input search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('order_id', 'LIKE', "%{$search}%")
                ->orWhere('nama_order', 'LIKE', '%' .$request->search. '%')
                ->orWhere('deadline', 'LIKE', '%' .$request->search. '%')
                ->orWhere('lokasi', 'LIKE', '%' .$request->search. '%');
        }

        // Menambahkan kondisi sorting
        $query->orderBy($sort, $direction);

        // Menjalankan query dengan paginasi menggunakan nilai per_page yang diberikan
        $data['order'] = $query->paginate($perPage);

        // Mengirimkan data ke view
        return view('Order.index', $data);
    }

    public function spk()
    {
        $odr['order'] = Order::all();
        // return view('Contents.dashboard', $odr);
        return $odr['order'];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $input['order_id'] = $this->generateOrderId(); // Generate the automatic Order ID
            Order::create($input);
            session()->flash('success', 'Data added successfully.');
            return redirect('dashboard-order')->with('success', true);
        } catch (Exception $e) {
            session()->flash('error', 'Failed to add data.');
            return redirect()->back();
        }
    }

    protected function generateOrderId()
    {
        $lastOrder = Order::latest('order_id')->first();
        
        if (!$lastOrder) {
            return date('Ymd') . '001'; // If no previous 'order' exists, start with ORD-001
        }
        if (substr($lastOrder->order_id, 0, 8) != date('Ymd')) {
            return date('Ymd') . '001'; // If the last order was created on a different day, start with ORD-001
        }
        $lastId = intval(substr($lastOrder->order_id, 8)); // Extract the numeric portion of the last ID
        $newId = $lastId + 1;
        $paddedNewId = str_pad($newId, 3, '0', STR_PAD_LEFT); // Pad the new ID with leading zeros if necessary
        $generatedId = date('Ymd') . $paddedNewId;

        return $generatedId;
        
    }  

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $data['order'] = Order::find($id);
        return view('content.user.dashboard-edit-order', $data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            Order::find($id)->update($input);
            session()->flash('successUpdate', 'Data updated successfully.');
            return redirect('dashboard-order')->with('successUpdate', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update data.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id, Request $request)
    {
        $order = Order::find($id);
        try {
            Order::find($id)->delete();
            session()->flash('success', 'Data deleted successfully.');
            return redirect('dashboard-order')->with('success', true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete data.');
            return redirect()->back();
        }
    }
}
