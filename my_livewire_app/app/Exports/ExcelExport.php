<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    private $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'email_verified_at',
            'created_at',
            'updated_at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return collect($this->model);
    }
}
