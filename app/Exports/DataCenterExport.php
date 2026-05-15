<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataCenterExport implements FromCollection, WithHeadings
{
    protected $filtered;

    public function __construct(Collection $filtered)
    {
        $this->filtered = $filtered;
    }

    public function collection()
    {
        return collect($this->filtered)->map(function ($item) {
            return [
                'Name' => $item['salutation'] . ' ' . $item['fullname'],
                'Email' => $item['email'],
                'Phone' => $item['phone'],
                'Events' => implode('| ', array_filter($item['name_events'])),
                'Institutions' => implode('| ', array_filter($item['institution'])),
                'Positions' => implode('| ', array_filter($item['position'])),
                'Sector' => implode('| ', array_filter($item['sector'])),
                'Field' => implode('| ', array_filter($item['field'])),
                'Country' => implode('| ', array_filter($item['country'])),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Events',
            'Institutions',
            'Positions',
            'Sector',
            'Field',
            'Country',
        ];
    }
}
