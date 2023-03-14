<?php

namespace App\Imports\batch;

use App\Models\RawData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportRawData implements SkipsEmptyRows, WithValidation,
    WithStartRow, WithHeadingRow, WithChunkReading, WithBatchInserts, ShouldQueue, ToModel,
    SkipsOnError
//    SkipsOnFailure
{
    use Importable;

    /**
     * skip heading row and start next row.
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    use SkipsErrors;

//    public function onError(\Throwable $e)
//    {
//        throw $e;
//        // Handle the exception how you'd like.
//    }


    /**
     * @param array $row
     * @return RawData
     */
    public function model(array $row)
    {

        return new RawData([
            'status_bill' => $row['trang_thai'],
            'id_bill' => $row['ma_phieu'],
            'id_bill_taken' => $row['ma_phieu_dat']
        ]);
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 500;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 100;
    }
}
