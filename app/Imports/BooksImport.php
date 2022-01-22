<?php

namespace App\Imports;

use App\Models\Auther;
use App\Models\Book;
use App\Models\Publisher;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;


class BooksImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue,SkipsEmptyRows,SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $studentDetail = Publisher::create([
                'name' => $row['publishercode'],
                'address' => $row['place'],
            ]);


        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

}

