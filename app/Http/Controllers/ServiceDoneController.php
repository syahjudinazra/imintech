<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

use Session;
use Carbon\Carbon;

use App\Imports\ServiceDoneImport;
use App\Exports\ServiceDoneExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ServiceDoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $barang = Barang::sortable()->orderBy('tanggal', 'desc')->paginate(20);
        return view('servicedone.index', compact('barang'));
        // return view('servicedone.index', [
        //     'barang' => DB::table('barangs')->paginate(20)
        // ]);
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;

    		// mengambil data dari table pegawai sesuai pencarian data
		$barang = DB::table('barangs')
        ->where('tanggal','like',"%".$cari."%")
        ->orWhere('serialnumber','like',"%".$cari."%")
        ->orWhere('pelanggan','like',"%".$cari."%")
        ->orWhere('model','like',"%".$cari."%")
        ->paginate();

		return view('servicedone.index',['barang' => $barang]);

	}

    public function export_excel()
	{
		return Excel::download(new ServiceDoneExport, 'DataServiceDone.xlsx');
	}

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_servicedone', $nama_file);

        // import data
        Excel::import(new ServiceDoneImport, public_path('/file_servicedone/' . $nama_file));

        return redirect('/servicedone')->with('sukses', 'Data telah di Import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicedone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'model' => 'required|max:255',
            'ram' => 'max:255',
            'android' => 'max:255',
            'kerusakan' => 'required|max:255',
            'kerusakanbawaan' => 'max:255',
            'teknisi' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'snkanibal' => 'required|max:255',
            'nosparepart' => 'required|max:255',
            'note' => 'max:255',
        ]);

        Barang::create($validatedData);

        return redirect('/servicedone')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function show(Barang $barang)
    {

        return view('servicedone.show', [
                'barang' => Barang::find($barang)
            ]);
        // $barang = Barang::find($barang);
        // return view('servicedone.show')->with('barang', $barang);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {

        return view('servicedone.edit', [
            'barang' => $barang

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {

        $validatedData = $request->validate([
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'model' => 'required|max:255',
            'ram' => 'max:255',
            'android' => 'max:255',
            'kerusakan' => 'required|max:255',
            'kerusakanbawaan' => 'max:255',
            'teknisi' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'snkanibal' => 'required|max:255',
            'nosparepart' => 'required|max:255',
            'note' => 'max:255',
        ]);

        Barang::where('id', $barang->id)
                  ->update($validatedData);

        return redirect('/servicedone')->with('success', 'Data telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('/servicedone')->with('success', 'Data telah dihapus');
    }
}
