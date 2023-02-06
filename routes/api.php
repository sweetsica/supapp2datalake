<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('upload-file', function (Request $request) {
    $file = $request->file('file');

    // TODO:: add validate check file is excel else throw error
    if (!$request->file('file')) throw new Exception('Error');
    $params = [
        'id_bill' => 'Mã phiếu',
        'id_bill_taken' => 'Mã phiếu đặt'
    ];
    $instance = new \App\Imports\RawDataImport($params);
    $data = Excel::import($instance, $file);
    dd($instance);

//    $collections = Excel::toArray(new \App\Imports\RawDataImport($params),$file,null,\Maatwebsite\Excel\Excel::XLSX);
//    $data = Excel::import(new \App\Imports\RawDataImport($params),$file,null,\Maatwebsite\Excel\Excel::XLSX);
//    dd($data);

    return 'done';
});
