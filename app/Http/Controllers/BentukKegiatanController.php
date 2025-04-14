<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\BentukKegiatan;

class BentukKegiatanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = BentukKegiatan::query();

      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn =
            '<a href="javascript:;" class="edit-btn btn btn-sm btn-icon btn-outline-info" data-id="' .
            $row->id .
            '" data-bentukkegiatan="' .
            e($row->bentuk_kegiatan) .
            '" data-bs-toggle="modal" data-bs-target="#editModal"><span class="icon-base bx bx-pencil icon-md"></span></a>
                            <a href="javascript:;" class="delete-btn btn btn-sm btn-icon btn-outline-danger" data-id="' .
            $row->id .
            '" data-bs-toggle="modal" data-bs-target="#deleteModal"><span class="icon-base bx bx-trash-alt icon-md"></span></a>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('bentuk_kegiatan.index');
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
      'bentuk_kegiatan' => 'required|max:255',
    ]);

    BentukKegiatan::create($request->only('bentuk_kegiatan'));

    return redirect()
      ->route('bentuk-kegiatan.index')
      ->with('success', 'Bentuk Kegiatan berhasil disimpan!');
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
  public function update(Request $request, BentukKegiatan $bentuk_kegiatan)
  {
    $request->validate([
      'bentuk_kegiatan' => 'required|max:255',
    ]);

    $bentuk_kegiatan->update($request->only('bentuk_kegiatan'));

    return redirect()
      ->route('bentuk-kegiatan.index')
      ->with('success', 'Bentuk Kegiatan berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BentukKegiatan $bentuk_kegiatan)
  {
    $bentuk_kegiatan->delete();

    return redirect()
      ->route('bentuk-kegiatan.index')
      ->with('success', 'Bentuk Kegiatan berhasil dihapus!');
  }
}
