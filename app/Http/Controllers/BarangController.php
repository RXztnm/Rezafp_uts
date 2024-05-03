<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pageTitle = 'Item List';
        // ELOQUENT
        $barangs = barang::all();
        return view('barang.index', [
            'pageTitle' => $pageTitle,
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Barang';
        // RAW SQL Query
        $satuans = DB::select('select * from satuans');
        return view('barang.create', compact('pageTitle', 'satuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'kodeBarang' => 'required',
            'namaBarang' => 'required',
            'deskripsiBarang' => 'required',
            'hargaBarang' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        // INSERT QUERY
        DB::table('barangs')->insert([
            'kodeBarang' => $request->kodeBarang,
            'namaBarang' => $request->namaBarang,
            'deskripsiBarang' => $request->deskripsiBarang,
            'hargaBarang' => $request->hargaBarang,
            'satuan_id' => $request->satuan,
        ]);
        return redirect()->route('barangs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Barang Detail';
        // RAW SQL QUERY
        $barang = collect(DB::select('
 select *, barangs.id as barang_id, satuans.name as
satuan_name
 from barangs
 left join satuans on barangs.satuan_id = satuans.id
 where barangs.id = ?
 ', [$id]))->first();
        return view('barang.show', compact('pageTitle', 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        $barang = DB::table('barangs')->where('id', $id)->first();
        $satuans = DB::table('satuans')->get();

        //eloduent
        // $positions = Position::all();
        // $employee = Employee::find($id);

        return view('barang.edit', compact('pageTitle', 'barang', 'satuans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'kodeBarang' => 'required',
            'namaBarang' => 'required',
            'deskripsiBarang' => 'required',
            'hargaBarang' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('barangs')->where('id', $id)->update([
            'kodeBarang' => $request->kodeBarang,
            'namaBarang' => $request->namaBarang,
            'deskripsiBarang' => $request->deskripsiBarang,
            'hargaBarang' => $request->hargaBarang,
            'satuan_id' => $request->satuan,
        ]);

        // ELOQUENT
        // $employee = Employee::find($id);
        // $employee->firstname = $request->firstName;
        // $employee->lastname = $request->lastName;
        // $employee->email = $request->email;
        // $employee->age = $request->age;
        // $employee->position_id = $request->position;
        // $employee->save();


        return redirect()->route('barangs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        barang::find($id)->delete();
        return redirect()->route('employees.index');
    }
}
