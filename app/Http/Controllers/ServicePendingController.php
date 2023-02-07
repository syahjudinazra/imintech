<?php

namespace App\Http\Controllers;

use App\Models\Barangsp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\ServicePendingExport;
use Maatwebsite\Excel\Facades\Excel;

class ServicePendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $barangsp = Barangsp::sortable()->orderBy('tanggal', 'desc')->paginate(20);
        return view('servicepending.index', compact('barangsp'));
        // return view('servicepending.index', [
        //     'barangsp' => DB::table('barangsps')->paginate(20)
        // ]);
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;

    		// mengambil data dari table pegawai sesuai pencarian data
		$barangsp = DB::table('barangsps')
        ->where('tanggal','like',"%".$cari."%")
        ->orWhere('serialnumber','like',"%".$cari."%")
        ->orWhere('pelanggan','like',"%".$cari."%")
        ->orWhere('model','like',"%".$cari."%")
		->paginate();

    		// mengirim data pegawai ke view index
		return view('servicepending.index',['barangsp' => $barangsp]);

	}

    public function export_excel()
	{
		return Excel::download(new ServicePendingExport, 'ServicePendingData.xlsx');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicepending.create');
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

        Barangsp::create($validatedData);

        return redirect('/servicepending')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barangsp  $barangsp
     * @return \Illuminate\Http\Response
     */
    public function show(Barangsp $barangsp)
    {
        return view('servicepending.show', [
            'barangsp' => Barangsp::find($barangsp)
        ]);
        // $barangsp = Barangsp::find($barangsp);
        // return view('servicepending.show')->with('barangsp', $barangsp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barangsp  $barangsp
     * @return \Illuminate\Http\Response
     */
    public function edit(Barangsp $barangsp)
    {

        // $barang = Barangsp::findOrFail($barangsp);
        // return view('servicepending.edit', [
        //     'barangsp' => $barangsp
        // ]);
        return view('servicepending.edit', [
            'barangsp' => $barangsp

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barangsp  $barangsp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barangsp $barangsp)
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

        Barangsp::where('id', $barangsp->id)
                  ->update($validatedData);

        return redirect('/servicepending')->with('success', 'Data telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barangsp  $barangsp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangsp $barangsp)
    {
        Barangsp::destroy($barangsp->id);
        return redirect('/servicepending')->with('success', 'Data telah dihapus');
    }

    //move data table
    public function finish(Request $request, Barangsp $barangsp){
    //    echo $barangsp->id;
       $user = DB::table('barangsps')->where('id', ''. $barangsp->id .'')->first();

    //    echo $user->serialnumber;
    DB::table('barangs')->insert(
        array(
               'tanggal'     =>   $barangsp->tanggal,
               'serialnumber'   =>   $barangsp->serialnumber,
               'pelanggan'   =>   $barangsp->pelanggan,
               'model'   =>   $barangsp->model,
               'ram'   =>   $barangsp->ram,
               'android'   =>   $barangsp->android,
               'kerusakan'   =>   $barangsp->kerusakan,
               'kerusakanbawaan'  =>   $barangsp->kerusakanbawaan,
               'teknisi'   =>   $barangsp->teknisi,
               'perbaikan'   =>   $barangsp->perbaikan,
               'snkanibal'   =>   $barangsp->snkanibal,
               'nosparepart'   =>   $barangsp->nosparepart,
               'note'   =>   $barangsp->note,
        )
   );
   DB::table('barangsps')->where('id', $barangsp->id)->delete();
    return redirect('/servicedone')->with('success', 'Data telah dipindahkan');
    }
}
