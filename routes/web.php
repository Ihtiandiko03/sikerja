<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\layouts\Fluid;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BKMPController;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\BentukKegiatanController;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\TelaahKerjasamaController;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\KlasifikasiMitraController;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\pages\AccountSettingsAccount;

use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\RepositoryKerjasamaController;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\MonitoringTelaahKerjasamaController;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::middleware(['role:admin,user'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Telaah Kerjasama
Route::middleware(['role:admin,user'])->prefix('telaah-kerja-sama')->group(function () {
  Route::get('/', [TelaahKerjasamaController::class, 'index'])->name('telaah-kerja-sama');
  Route::get('/create', [TelaahKerjasamaController::class, 'create'])->name('telaah-kerja-sama.create');
  Route::post('/store', [TelaahKerjasamaController::class, 'store'])->name('telaah-kerja-sama.store');
  Route::get('/delete/{id}', [TelaahKerjasamaController::class, 'delete'])->name('telaah-kerja-sama.delete');
});

Route::middleware(['role:admin'])->prefix('telaah-kerja-sama')->group(function () {
  Route::put('/{id}/validasi', [TelaahKerjasamaController::class, 'validasi'])->name('telaah-kerja-sama.validasi');
});

Route::middleware(['role:user'])->prefix('telaah-kerja-sama')->group(function () {
  Route::get('/{id}/edit', [TelaahKerjasamaController::class, 'edit'])->name('telaah-kerja-sama.edit');
  Route::put('/{id}/revisi', [TelaahKerjasamaController::class, 'revisi'])->name('telaah-kerja-sama.revisi');
});


Route::middleware(['role:admin,user'])->prefix('monitoring-telaah-kerja-sama')->group(function () {
  Route::get('/', [MonitoringTelaahKerjasamaController::class, 'index'])->name('monitoring-telaah-kerja-sama');
  Route::get('/detail/{id}', [MonitoringTelaahKerjasamaController::class, 'show'])->name(
    'monitoring-telaah-kerja-sama.show'
  );
});

Route::middleware(['role:admin,user'])->prefix('repository-kerja-sama')->group(function () {
  Route::get('/', [RepositoryKerjasamaController::class, 'index'])->name('repository-kerja-sama.index');
  Route::get('/create', [RepositoryKerjasamaController::class, 'create'])->name('repository-kerja-sama.create');
  Route::post('/store', [RepositoryKerjasamaController::class, 'store'])->name('repository-kerja-sama.store');
  Route::get('/detail/{id}', [RepositoryKerjasamaController::class, 'show'])->name('repository-kerja-sama.show');
  Route::get('/{id}/edit', [RepositoryKerjasamaController::class, 'edit'])->name('repository-kerja-sama.edit');
  Route::put('/{id}/update', [RepositoryKerjasamaController::class, 'update'])->name('repository-kerja-sama.update');
  Route::delete('/{id}/delete', [RepositoryKerjasamaController::class, 'delete'])->name('repository-kerja-sama.delete');
});

Route::middleware(['role:admin'])->group(function () {
  Route::resource('klasifikasi-mitra', KlasifikasiMitraController::class);
  Route::resource('bentuk-kegiatan', BentukKegiatanController::class);
});

Route::prefix('bkmp')->group(function () {
  Route::get('/validasi-telaah-kerja-sama', [BKMPController::class, 'validasiTelaah'])->name('bkmp.validasitelaah');
  Route::put('/store-validasi-telaah-kerja-sama', [BKMPController::class, 'storeValidasiTelaah'])->name(
    'bkmp.storevalidasitelaah'
  );
});

Route::get('/login/user', function () {
  Session::flush();
  $userData = [
      'id' => 'PEG001',
      'name' => 'Mulyono S.Kom',
      'role_kerja' => 'user',
      'is_login' => true
  ];

  Session::put($userData);
  return Session::all();
});

Route::get('/login/admin', function () {
  Session::flush();
  $userData = [
      'id' => 'PEG002',
      'name' => 'Joko S.Kom',
      'role_kerja' => 'admin',
      'is_login' => true
  ];

  Session::put($userData);
  return Session::all();
});