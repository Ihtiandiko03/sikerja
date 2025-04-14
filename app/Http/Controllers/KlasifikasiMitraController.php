<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\KlasifikasiMitra;
use Illuminate\Http\Request;

class KlasifikasiMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KlasifikasiMitra::query();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:;" class="edit-btn btn btn-sm btn-icon btn-outline-info" data-id="'.$row->id.'" data-klasifikasimitra="'.e($row->klasifikasi_mitra).'" data-bs-toggle="modal" data-bs-target="#editModal"><span class="icon-base bx bx-pencil icon-md"></span></a>
                            <a href="javascript:;" class="delete-btn btn btn-sm btn-icon btn-outline-danger" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#deleteModal"><span class="icon-base bx bx-trash-alt icon-md"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('klasifikasi_mitra.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi_mitra' => 'required|max:255',
        ]);

        KlasifikasiMitra::create($request->only('klasifikasi_mitra'));

        return redirect()->route('klasifikasi-mitra.index')->with('success', 'Klasifikasi Mitra berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KlasifikasiMitra $klasifikasi_mitra)
    {
        $request->validate([
            'klasifikasi_mitra' => 'required|max:255',
        ]);

        $klasifikasi_mitra->update($request->only('klasifikasi_mitra'));

        return redirect()->route('klasifikasi-mitra.index')->with('success', 'Klasifikasi Mitra berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KlasifikasiMitra $klasifikasi_mitra)
    {
        $klasifikasi_mitra->delete();

        return redirect()->route('klasifikasi-mitra.index')->with('success', 'Klasifikasi Mitra berhasil dihapus!');
    }   

}
