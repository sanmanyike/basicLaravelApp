<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CsvExport implements FromCollection, WithHeadings
{
    protected $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    public function headings(): array
    {
        $my_keys = array_keys($this->model->first()->toArray());
        $count = 0;
        $keys = [];

        foreach ($my_keys as $key) {
            $keys[$count] = ucfirst(str_replace('_', ' ', $key));
            $count++;
        }

        return array_values($keys);
    }

    /**TODO
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return collect($this->model);
    }
}
