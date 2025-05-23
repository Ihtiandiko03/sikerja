<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = User::select(['id', 'name', 'email', 'role_kerja']);
      return datatables()
        ->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          return '<button class="btn btn-danger btn-delete" data-id="' .
            $row->id .
            '" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $pegawai = DB::table('db_simpeg.tb_pegawai')
      ->select('id_pegawai', 'nama_pegawai', 'email')
      ->get();

    return view('user.index', compact('pegawai'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'email' => 'required|email|unique:users,email',
      'role_kerja' => 'required',
      'id_pegawai' => 'required',
    ]);

    // dd($request->all());
    $user = new User();
    $user->name = $request->nama;
    $user->id_pegawai = $request->id_pegawai;
    $user->email = $request->email;
    $user->password = Crypt::encryptString('Kerjasama123');
    $user->role_kerja = $request->role_kerja;
    $user->save();

    Session::flash('success', 'User berhasil ditambahkan.');
    return redirect()->route('user.index');
  }

  public function destroy($id)
  {
    $user = User::find($id);
    if ($user) {
      $user->delete();
      Session::flash('success', 'User berhasil dihapus.');
      return redirect()->route('user.index');
    }
    return response()->json(['error' => 'User not found.'], 404);
  }
}
