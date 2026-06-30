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
                'Social Media' => implode('| ', array_filter($item['socialmedia'])),
                'LinkedIn' => implode('| ', array_filter($item['linkedin'])),
                'City Lived' => implode('| ', array_filter($item['citylived'])),
                'Country Origin' => implode('| ', array_filter($item['country'])),
                'Date of Birth' => implode('| ', array_filter($item['birthday'])),
                'Latest Education' => implode('| ', array_filter($item['latesteducation'])),
                'English Proficiency' => implode('| ', array_filter($item['englishproficiency'])),
                'Upload CV' => implode('| ', array_filter($item['uploadfile'])),
                'Fellowship' => implode('| ', array_filter($item['fellowship'])),
                'Essay' => implode('| ', array_filter($item['essay'])),
                'Role in Workshop' => implode('| ', array_filter($item['roleworkshop'])),
                'Attendance Type' => implode('| ', array_filter($item['attendance'])),
                'Food Allergy' => implode('| ', array_filter($item['allergy'])),
                'Meal Type' => implode('| ', array_filter($item['meal'])),
                'Support Disability' => implode('| ', array_filter($item['disability'])),
                'Preferred Language' => implode('| ', array_filter($item['language'])),
                'Professional Picture' => implode('| ', array_filter($item['picture'])),
                'Short Bio' => implode('| ', array_filter($item['bio'])),
                'I consent' => implode('| ', array_filter($item['iconsent'])),
                'Data Privacy' => implode('| ', array_filter($item['privacy'])),
                'Availability for Documentation' => implode('| ', array_filter($item['availdoc'])),

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
            'Social Media',
            'LinkedIn',
            'City Lived',
            'Country Origin',
            'Date of Birth',
            'Latest Education',
            'English Proficiency',
            'Upload CV',
            'Fellowship',
            'Essay',
            'Role in Workshop',
            'Attendance Type',
            'Food Allergy',
            'Meal Type',
            'Support Disability',
            'Preferred Language',
            'Professional Picture',
            'Short Bio',
            'I consent',
            'Data Privacy',
            'Availability for Documentation',
        ];
    }
}
