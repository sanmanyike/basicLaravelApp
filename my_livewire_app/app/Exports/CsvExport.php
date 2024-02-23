<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class CsvExport implements FromCollection
{
    protected $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    /**TODO
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->model;
    }
}
