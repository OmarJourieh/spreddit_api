<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }
    public function map($book): array
    {
        return [
            $book->title,
            $book->	number_of_copies,
            $book->	price,
            $book-> created_at->toDateString(),

        ];
    }

    public function headings(): array
    {
        return [
            'title',
            'number_of_copies',
            'price',
            'created_at',
        ];
    }
}
