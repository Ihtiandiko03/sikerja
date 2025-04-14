<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class Restricted
{
  private $session;
  private $apps;
  private $level;
  private $current_apps;
  private $current_level;
  private $current_rule;
  private $ssoConfig;
  private $appsUrl;

  public function __construct($apps, $levels, $rule)
  {
    $config = config('sso');

    $this->client_id = $config['client_id'];
    $this->client_secret = $config['client_secret'];
    $this->redirect_uri = $config['redirect_uri'];
    $this->scope = $config['scope'];

    $this->session = Session::getFacadeRoot();
    $this->appsUrl = Config::get('sso.apps_url');

    $this->apps = $apps;
    $this->levels = $levels;
    $this->current_rule = $rule;
  }

  public function restrict_check($data = null)
  {
    if ($data != null) {
      $this->apps = $data['apps'];
      $this->current_level = $data['levels'];
      $this->current_rule = $data['rule'];
    }
    if ($this->current_rule == 'dosen') {
      return false;
    } else {
      for ($i = 0; $i < count($this->apps); $i++) {
        if ($this->apps[$i] == $this->current_apps) {
          return $this->current_level = $this->levels[$i];
        }
      }
    }
    return true;
  }

  public function restrict_get()
  {
    return $this->levels;
  }

  public function restrict_current()
  {
    return [
      'apps' => $this->current_apps,
      'level' => $this->current_level,
    ];
  }

  public function execution($restrict_page, $data)
  {
    $this->current_apps = $this->client_id;

    if (!$this->restrict_check($data)) {
      switch ($this->current_rule) {
        case 'mahasiswa':
          return redirect()
            ->to(url($restrict_page))
            ->send();
          break;
        default:
          Session::put(['level' => 'staff']);
          return redirect()->route('dashboard');
          break;
      }
    } else {
      Session::put(['level' => $this->current_level]);
      switch ($this->current_level) {
        case 'akademik':
          return redirect()->route('dashboard');
          break;
        case 'dosen':
          return redirect()->route('dashboard');
          break;
        case 'staff':
          return redirect()->route('dashboard');
          break;
        case 'prodi':
          return redirect()->route('dashboard');
          break;
        case 'pimpinan':
          return redirect()->route('dashboard');
          break;
        default:
          return redirect()
            ->to(url($restrict_page))
            ->send();
          break;
      }
    }
  }

  public function self_logout()
  {
    Session::flush();
  }

  public function signout()
  {
    $this->self_logout();
    return redirect()->to($this->appsUrl . 'user/signout?redirect_to=' . url('/'));
  }
}
