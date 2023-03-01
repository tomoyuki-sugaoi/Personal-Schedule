<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// User関連------------------------------------------------------------
// ログイン画面
Route::get('/', function () { return view('user.login'); })->name('login');
Route::get('/login', function () { return view('user.login'); });

// ログイン操作(ユーザ/ゲスト)
Route::post('/calendar', [App\Http\Controllers\UsersController::class, 'login'])->name('login'); //成功でCalendar
Route::get('/calendar', [App\Http\Controllers\UsersController::class, 'login'])->name('login'); //エラーで戻る

// ログアウト
Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

// パスリセページに遷移
Route::get('/pass_reset', function () { return view('user.pass_reset'); })->name('pass_reset');

// 会員登録画面に遷移
Route::get('/user_regi', function () { return view('user.user_regi'); });

// 新規会員登録
Route::post('/user_regi_comp', [App\Http\Controllers\UsersController::class, 'register'])->name('regi');

// カレンダー------------------------------------------------------------
// Calendar表示
Route::get('/calendar', [App\Http\Controllers\CalendarsController::class, 'schedule'])->name('schedule');

// 直リンク禁止------------------------------------------------------------
// 登録
Route::get('/am_confirm', [App\Http\Controllers\AmSchedulesController::class, 'am_regi_top'])->name('am_regi_top');
Route::get('/am_complete', [App\Http\Controllers\AmSchedulesController::class, 'am_regi_top']);
Route::get('/pm_confirm', [App\Http\Controllers\PmSchedulesController::class, 'pm_regi_top'])->name('pm_regi_top');
Route::get('/pm_complete', [App\Http\Controllers\PmSchedulesController::class, 'pm_regi_top']);
Route::get('/dead_confirm', [App\Http\Controllers\DeadlinesController::class, 'dead_regi_top'])->name('dead_regi_top');
Route::get('/dead_complete', [App\Http\Controllers\DeadlinesController::class, 'dead_regi_top']);
// 編集
Route::get('/am_edit_confirm', [App\Http\Controllers\AmSchedulesController::class, 'am_edit_top']);
Route::get('/am_edit_complete', [App\Http\Controllers\AmSchedulesController::class, 'am_edit_top']);
Route::get('/pm_edit_confirm', [App\Http\Controllers\PmSchedulesController::class, 'pm_edit_top']);
Route::get('/pm_edit_complete', [App\Http\Controllers\PmSchedulesController::class, 'pm_edit_top']);
Route::get('/dead_edit_confirm', [App\Http\Controllers\DeadlinesController::class, 'dead_edit_top']);
Route::get('/dead_edit_complete', [App\Http\Controllers\DeadlinesController::class, 'dead_edit_top']);
// 削除
Route::get('/am_delete_complete', [App\Http\Controllers\AmSchedulesController::class, 'am_delete_top']);
Route::get('/pm_delete_complete', [App\Http\Controllers\PmSchedulesController::class, 'pm_delete_top']);
Route::get('/dead_delete_complete', [App\Http\Controllers\DeadlinesController::class, 'dead_delete_top']);

// 午前登録------------------------------------------------------------
// 各スケジュール登録-カレンダーから登録画面
Route::get('/am_sche_regi', [App\Http\Controllers\CalendarsController::class, 'am_register'])->name('am_register');

// 登録確認から情報取得
Route::post('/am_confirm', [App\Http\Controllers\AmSchedulesController::class, 'am_schedule'])->name('am_schedule');

// 登録完了
Route::post('/am_complete', [App\Http\Controllers\AmSchedulesController::class, 'am_complete'])->name('am_complete');

// 午前編集------------------------------------------------------------
Route::get('/am_edit_choice', [App\Http\Controllers\CalendarsController::class, 'am_edit']);
Route::post('/am_edit_choice', [App\Http\Controllers\AmSchedulesController::class, 'am_edit_choice'])->name('am_edit_choice');

// 編集データ表示
Route::get('/am_edit', [App\Http\Controllers\AmSchedulesController::class, 'am_edit_display'])->name('am_edit_display');

// データ編集入力・完了
Route::post('/am_edit_confirm', [App\Http\Controllers\AmSchedulesController::class, 'am_edit_input'])->name('am_edit_input');

// 午前削除------------------------------------------------------------
Route::get('/am_delete_choice', [App\Http\Controllers\CalendarsController::class, 'am_delete']);
Route::post('/am_delete_choice', [App\Http\Controllers\AmSchedulesController::class, 'am_delete_choice'])->name('am_delete_choice');


// 午後登録------------------------------------------------------------
// 各スケジュール登録-カレンダーから登録画面
Route::get('/pm_sche_regi', [App\Http\Controllers\CalendarsController::class, 'pm_register']);

// 登録確認から情報取得
Route::post('/pm_confirm', [App\Http\Controllers\PmSchedulesController::class, 'pm_schedule'])->name('pm_schedule');

// 登録完了
Route::post('/pm_complete', [App\Http\Controllers\PmSchedulesController::class, 'pm_complete'])->name('pm_complete');

// 午後編集------------------------------------------------------------
Route::get('/pm_edit_choice', [App\Http\Controllers\CalendarsController::class, 'pm_edit']);
Route::post('/pm_edit_choice', [App\Http\Controllers\PmSchedulesController::class, 'pm_edit_choice'])->name('pm_edit_choice');

// 編集データ表示
Route::get('/pm_edit', [App\Http\Controllers\PmSchedulesController::class, 'pm_edit_display'])->name('pm_edit_display');

// データ編集入力・完了
Route::post('/pm_edit_confirm', [App\Http\Controllers\PmSchedulesController::class, 'pm_edit_input'])->name('pm_edit_input');

// 午後削除------------------------------------------------------------
Route::get('/pm_delete_choice', [App\Http\Controllers\CalendarsController::class, 'pm_delete']);
Route::post('/pm_delete_choice', [App\Http\Controllers\PmSchedulesController::class, 'pm_delete_choice'])->name('pm_delete_choice');


// 期限登録------------------------------------------------------------
// 各スケジュール登録-カレンダーから登録画面
Route::get('/dead_regi', [App\Http\Controllers\CalendarsController::class, 'dead_register']);

// 登録確認から情報取得
Route::post('/dead_confirm', [App\Http\Controllers\DeadlinesController::class, 'dead_schedule'])->name('dead_schedule');

// 登録完了
Route::post('/dead_complete', [App\Http\Controllers\DeadlinesController::class, 'dead_complete'])->name('dead_complete');

// 期限編集------------------------------------------------------------
Route::get('/dead_edit_choice', [App\Http\Controllers\CalendarsController::class, 'dead_edit']);
Route::post('/dead_edit_choice', [App\Http\Controllers\DeadlinesController::class, 'dead_edit_choice'])->name('dead_edit_choice');

// 編集データ表示
Route::get('/dead_edit', [App\Http\Controllers\DeadlinesController::class, 'dead_edit_display'])->name('dead_edit_display');

// データ編集入力・完了
Route::post('/dead_edit_confirm', [App\Http\Controllers\DeadlinesController::class, 'dead_edit_input'])->name('dead_edit_input');

// 期限削除------------------------------------------------------------
Route::get('/dead_delete_choice', [App\Http\Controllers\CalendarsController::class, 'dead_delete']);
Route::post('/dead_delete_choice', [App\Http\Controllers\DeadlinesController::class, 'dead_delete_choice'])->name('dead_delete_choice');

// breezeのルート
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
