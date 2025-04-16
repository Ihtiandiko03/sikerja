<?php
namespace App\Http\Controllers;

use DataTables;
use App\Models\Kerjasama;
use App\Services\Restricted;
use Illuminate\Http\Request;
use App\Services\Oauth2Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  protected $oauth2Client;
  protected $ssoConfig;
  protected $appsUrl;
  protected $restricted;

  public function __construct(Oauth2Client $oauth2Client)
  {
    $this->oauth2Client = $oauth2Client;
    $this->ssoConfig = config('sso');
    $this->appsUrl = $this->ssoConfig['apps_url'];
  }

  public function index()
  {
    $this->restricted = new Restricted();
    if (Session::get('is_login')) {
      return $this->restricted->execution('login/restricted_page', Session::all());
    } else {
      return $this->login();
    }
  }

  public function restrictedPage()
  {
    Session::flush();
    abort(403, 'Anda tidak memiliki hak akses untuk halaman ini!');
  }

  public function notFound()
  {
    return view('not_found', [
      'header' => view('template.header'),
      'navbar_home' => view('template.navbar-home'),
      'footer' => view('template.footer'),
    ]);
  }

  public function login()
  {
    return $this->oauth2Client->userAuthentication($this->appsUrl . 'user/signin', [
      'scope' => 'info',
      'signin' => 'true',
    ]);
  }

  public function callback(Request $request)
  {
    $code = $request->query('code');
    if (!preg_match('/^[A-Za-z0-9-_]+$/', $code)) {
      // Redirect jika code tidak valid
      echo '<script>alert("Invalid code format");</script>';
      return redirect()->route('login');
    }

    $response = $this->oauth2Client->getAccessToken($this->appsUrl . 'user/access_token', $code, 'GET', [
      'access_token' => 'true',
    ]);
    $result = json_decode($response, true);

    if (!array_key_exists('access_token', $result)) {
      return redirect()->route('login');
    }

    $accessToken = $result['access_token'];

    $response = $this->oauth2Client->accessUserResources($this->appsUrl . 'user/get_data', $accessToken, 'GET', [
      'get_data' => 'true',
    ]);
    $data = json_decode($response);

    if (isset($data->error) && $data->error != null) {
      return redirect()->route('restricted_page');
    } else {
      $tmpApps = collect($data->apps)->toArray();
      $tmpLevel = collect($data->level)->toArray();

      $userData = [
        'is_login' => 1,
        'name' => $data->first_name[0],
        'id' => $data->id[0],
        'username' => $data->username[0],
        'email' => $data->username[0],
        'prodi' => $data->prodi[0],
        'rule' => $data->status[0],
        'ref_apps' => $data->ref_apps[0],
        'apps' => $tmpApps,
        'levels' => $tmpLevel,
        'role_kerja' => 'user',
      ];

      if ($userData['email'] == 'senja.fitriana@staff.itera.ac.id') {
        $userData['role_kerja'] = 'admin';
      }

      Session::put($userData);
      $this->restricted = new Restricted($userData['apps'], $userData['levels'], $userData['rule']);
      return $this->restricted->execution('restricted_page', $userData);
    }
  }

  public function selfLogout()
  {
    Session::flush();
  }

  public function signout()
  {
    Session::flush();
    return redirect()->to($this->appsUrl . 'user/signout?redirect_to=' . url('/'));
  }

  public function halamanutama(Request $request)
  {
    if ($request->ajax()) {
      $data = Kerjasama::where('is_publish', 1)
        ->select('nomor_kerjasama', 'judul_kerjasama', 'jenis_perjanjian', 'masa_berlaku_tmt', 'masa_berlaku_tat', 'status_kerjasama')
        ->orderBy('created_at', 'desc');

      return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('tmt', function ($row) {
            $date = date('d M Y', strtotime($row->masa_berlaku_tmt));
            return $date;
          })
          ->addColumn('tat', function ($row) {
            $date = date('d M Y', strtotime($row->masa_berlaku_tat));
            return $date;
          })
          ->make(true);
    }

    $totalMOU = DB::table('kerjasama')
      ->where('jenis_perjanjian', 'Memorandum of Understanding (MOU)')
      ->count();
    $totalMOA = DB::table('kerjasama')
      ->where('jenis_perjanjian', 'Memorandum of Agreement (MOA)')
      ->count();
    $totalIA = DB::table('kerjasama')
      ->where('jenis_perjanjian', 'Implementation Arrangement (IA)')
      ->count();
    
    return view('index', compact('totalMOU', 'totalMOA', 'totalIA'));
  }
}
