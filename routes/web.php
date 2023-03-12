<?php

use App\Http\Controllers\ProfileController;
use App\Models\Flag;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LakeController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;

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

Route::post('/import-to-lake', [LakeController::class, 'import_raw_data'])->name('lake-import-raw');
Route::prefix('lake')->group(function () {
    Route::get('/data-raw', [LakeController::class, 'index'])->name('list.dataraw.lake');
});

Route::get('/example-import', function () {
    return view('example-import');
});

Route::post('/example-import', function (\Illuminate\Http\Request $request) {
    $validField = ['order_name', 'carer_code', 'bill_order_time', 'bill_group'];
    $params = $request->only($validField);

    /**  Accept file and validate */
    $file = $request->file('file');
    $validator = Validator::make($request->all(), [
        'file' => 'required'
    ]);

    $validator->after(function ($validator) use ($file) {
        if ($file->guessClientExtension() !== 'xlsx') {
            $validator->errors()->add('field', 'File type is invalid - only xlsx is allowed');
        }
    });

    if ($validator->fails()) {
        dd('Lỗi rồi đừng vô nữa');
    }
    /** End Accept file and validate */

    try {
        $fname = md5(rand()) . '.xlsx';
        $full_path = Config::get('filesystems.disks.local.root');
        $file->move($full_path, $fname);
        $flag_table = Flag::firstOrNew(['file_name' => $fname]);
        $flag_table->imported = 0;
        $flag_table->save();
    } catch (\Exception $e) {
        dd($e->getMessage());
    }

    //and now the interesting part
    $process = new Process('php ../artisan import:excelfile');
    $process->start();

    Session::flash('message', 'Hold on tight. Your file is being processed');
    return redirect()->back();

    $instance = new \App\Imports\RawDataImport($params);
    Excel::import($instance, $file);
    if (count($instance->getErrorRows())) dd('Có dòng bị lỗi vui lòng sửa lại file. Đang cập nhật tính năng hiển thị vị trí lỗi');
    \App\Models\DemoRawData::insert($instance->getValidRows());
    dd("Không tìm thấy lỗi ,đã import các dữ liệu dưới đây", $instance->getValidRows());
})->name('upload.file.demo');

require __DIR__ . '/auth.php';
