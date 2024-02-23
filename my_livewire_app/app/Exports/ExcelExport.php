<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class ExcelExport implements FromCollection
{
    private $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return collect($this->model);
    }
}
