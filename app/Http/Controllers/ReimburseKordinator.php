<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reimburse;
use Illuminate\Http\Request;

class ReimburseKordinator extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('pages-kordinator.kordinator-reimburse', [
            'reimbures' => Reimburse::where('order_id', $order->id)->paginate(100),
            'orders' => Order::where('id', $order->id)->get()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'order_id' => 'required',
            'pelanggan_id' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            // Cek jika ada input foto maka formatnya harus image
            'bukti_nota_kordinator' => request('bukti_nota_kordinator') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        Reimburse::create([
            'order_id' => request('order_id'),
            // 'pelanggan_id' => request('pelanggan_id'),
            'nominal' => request('nominal'),
            'keterangan' => request('keterangan'),
            'status' => '1',
            // Cek jika ada input foto maka simpan ke database, dan storage
            'bukti_nota_kordinator' => request('bukti_nota_kordinator') ? request()->file('bukti_nota_kordinator')->store('images/reimburse-kordinator') : ''
        ]);

        return redirect()->back()->with('berhasil', 'Reimburse berhasil di tambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
