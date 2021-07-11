<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reimburse;
use Illuminate\Http\Request;

class ReimburseAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin-reimburse', [
            'reimbures' => Reimburse::orderBy('status', 'asc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('pages.reimburse-validasi', [
            'reimbures' => Reimburse::where('order_id', $order->id)->paginate(100),
            'orders' => Order::where('id', $order->id)->get()

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        return view('pages.admin-reimburse-validasi', [
            'reimburse' => Reimburse::where('id', $id)->get()->first(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
            'order_id' => 'required',
            'pelanggan_id' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            // Cek jika ada input foto maka formatnya harus image
            'bukti_nota_admin' => request('bukti_nota_admin') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        Reimburse::where('id', $request->reimburse_id)
            ->update([
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'bukti_nota_admin' => $request->bukti_nota_admin ? request()->file('bukti_nota_admin')->store('images/reimburse-admin') : '',
                'updated_at' => now(),
                'status' => '2'
            ]);

        return redirect('/job-reimburse-admin')->with('berhasil', 'Reimburse berhasil di validasi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
