<?php

namespace App\Http\Controllers;

use App\Models\{Pelanggan, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;


class PelangganController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pelanggans = Pelanggan::all();
        return view('pages.pelanggan', compact('pelanggans'));
    }

    public function create()
    {
        return view('partials.formPelanggan');
    }

    public function store()
    {
        request()->validate([
            'namaPerusahaan' => 'required',
            'email' => 'required',
            'alamatPerusahaan' => 'required',
            'gm' => 'required',
            'pm' => 'required'

        ]);

        Pelanggan::create([
            'nama' => request('namaPerusahaan'),
            'email' => request('email'),
            'alamat' => request('alamatPerusahaan'),
            'nama_pm' => request('pm'),
            'no_pm' => request('nopm'),
            'nama_gm' => request('gm'),
            'no_gm' => request('nogm'),
            'bast' => request('bast') ? request()->file('bast')->store('master-bast') : '',
        ]);

        User::create([
            'name' => request('namaPerusahaan'),
            'email' => request('email'),
            'password' => Hash::make('12345678'),
            'level' => 'client'
        ]);

        return redirect()->to('client')->with('berhasil', 'Data berhasil disimpan.');
    }

    // Edit kordinator dengan menerima Kordinator ID dari slug
    public function edit(Pelanggan $pelanggan)
    {
        return view('partials.formEditPelanggan',  [
            'client' => Pelanggan::where('id', $pelanggan->id)->get()->first(),
        ]);
    }
    public function update(Pelanggan $pelanggan)
    {
        request()->validate([
            'namaPerusahaan' => 'required',
            'alamatPerusahaan' => 'required',
            'gm' => 'required',
            'pm' => 'required'
        ]);

        if (request('bast')) {
            Storage::delete($pelanggan->bast);
            $bast = request()->file('bast')->store('master-bast');
        } elseif ($pelanggan->bast) {
            $bast = $pelanggan->bast;
        } else {
            $bast = null;
        }

        $pelanggan->update([
            'nama' => request('namaPerusahaan'),
            'alamat' => request('alamatPerusahaan'),
            'nama_pm' => request('pm'),
            'no_pm' => request('nopm'),
            'nama_gm' => request('gm'),
            'no_gm' => request('nogm'),
            'bast' => $bast
        ]);

        User::where('email', request('email'))->update([
            'name' => request('namaPerusahaan'),

        ]);

        return redirect()->to('/client')->with('berhasil', 'Data berhasil diubah.');
    }
    public function delete(Pelanggan $pelanggan)
    {

        $user = User::where('email', $pelanggan->email);
        $user->delete();
        $pelanggan->delete();
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus.');
    }
}
