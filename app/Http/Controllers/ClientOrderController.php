<?php

namespace App\Http\Controllers;

use App\Imports\OrderImport;
use App\Models\{jobActivity, JobPhoto, Order, Pelanggan, ResponsePhoto};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $client;
    public function index()
    {
        //
        return view('pages-client.client-order', [
            'orders' => Order::where('pelanggan_id', $this->getClientId())
                ->where('status', '>', '1')
                ->where('status', '<=', '5')
                ->paginate(100)
        ]);
        return view('client-order');
    }
    public function getClientId()
    {
        $this->client = Pelanggan::where('email', auth()->user()->email)->first();
        return $this->client->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages-client.create-order');
    }

    // Import
    public function import()
    {
        Excel::import(new OrderImport, 'order.xlsx');

        return redirect('/client-order')->with('success', 'All good!');
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
        request()->validate([
            'excel' => 'required'
        ]);
        Excel::import(new OrderImport, $request->file('excel'));

        return redirect('/client-order')->with('success', 'All good!');
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

    public function approve(Order $order)
    {

        $order->update([
            'status' => '7',
        ]);

        return redirect('/')->with('berhasil', 'Job Order berhasil di Approve!');
    }

    public function approveBast(Order $order)
    {

        // dd('tes');
        if (!$order->bast) {
            return redirect()->back()->with('warning', 'BAST belum tersedia');
        } else {
            $order->where('id', request('id'))->update([
                'status' => '9',
            ]);
            return redirect('/client-complete')->with('success', 'Job Order berhasil di Approve!');
        }
    }

    public function profile()
    {
        return view('pages-client.client-profile', [
            'client' => Pelanggan::where('email', auth()->user()->email)->get()->first()
        ]);
    }

    public function jobreport()
    {
        $orders = Order::where('pelanggan_id', $this->getClientId())->where('status', 6)->orWhere('status', 7)->paginate(100);

        return view('pages-client.client-jobreport', [
            'orders' => $orders
        ]);
    }

    public function cancel(Request $request)
    {
        //                            
        Order::where('id', $request->id)
            ->update([
                'joborder_id' => null,
                'kordinator_id' => null,
                'status' => '1'
            ]);

        return redirect()->back();
    }

    public function detailJobreport(Order $order)
    {

        return view('pages-client.client-jobreport-detail', [
            'order' => Order::where('id', $order->id)->get()->first(),
            'activities' => jobActivity::where('order_id', $order->id)->paginate(100),
            'jobphotos' => JobPhoto::where('order_id', $order->id)->paginate(100),
        ]);
    }

    public function fotoReport(JobPhoto $JobPhoto)
    {
        // dd($JobPhoto->id);
        return view('pages-client.foto-report', [
            'jobphoto' => JobPhoto::where('id', $JobPhoto->id)->get()->first()
        ]);
    }

    public function rejectJobreport(Request $request)
    {
        //            
        DB::transaction(function () use ($request) {

            JobPhoto::where('id', $request->job_photo_id)
                ->update([
                    'keterangan' => $request->keterangan,
                    'status' => '201'
                ]);
        }, 3);

        return redirect($request->order_id . '/jobreport-detail')->with('berhasil', 'Report Order Berhasil di Reject');
    }

    public function approveJobreport(Request $request)
    {
        //                    
        DB::transaction(function () use ($request) {

            JobPhoto::where('id', $request->job_photo_id)
                ->update(['status' => '2']);
        }, 3);

        return redirect($request->order_id . '/jobreport-detail')->with('berhasil', 'Report Berhasil di Approve');
    }

    public function finish()
    {
        return view('pages-client.client-finish', [
            'orders' => Order::where('pelanggan_id', $this->getClientId())->where('status', 7)->paginate(100)
        ]);
    }
    public function ready()
    {
        return view('pages-client.client-ready', [
            'orders' => Order::where('pelanggan_id', $this->getClientId())->where('status', 8)->paginate(100)
        ]);
    }
    public function complete()
    {
        return view('pages-client.client-complete', [
            'orders' => Order::where('pelanggan_id', $this->getClientId())->where('status', 8)->OrWhere('status', 9)->paginate(100)
        ]);
    }
}
