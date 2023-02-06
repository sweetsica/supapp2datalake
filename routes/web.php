<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LakeController;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/import-to-lake',[LakeController::class,'import_raw_data'])->name('lake-import-raw');
Route::prefix('lake')->group(function (){
    Route::get('/data-raw',[LakeController::class,'index'])->name('list.dataraw.lake');
});

Route::get('/example-import', function() {
    return view('example-import');
});

Route::post('/example-import', function (\Illuminate\Http\Request $request) {
    $validField = ['order_name', 'carer_code', 'bill_order_time', 'bill_group'];
    $params = $request->only($validField);

    $file = $request->file('file');
    $instance = new \App\Imports\RawDataImport($params);
    Excel::import($instance, $file);
    if (count($instance->getErrorRows())) dd('Có dòng bị lỗi vui lòng sửa lại file. Đang cập nhật tính năng hiển thị vị trí lỗi');
    \App\Models\DemoRawData::insert($instance->getValidRows());
    dd("Không tìm thấy lỗi ,đã import các dữ liệu dưới đây", $instance->getValidRows());
})->name('upload.file.demo');

require __DIR__.'/auth.php';
