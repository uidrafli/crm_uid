<?php

namespace App\Imports;

use App\Models\DataCenter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDataCenter implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            DataCenter::create([
                'key_events' => $row['key_events'] ?? null,
                'users_role' => 'admin',
                'name_events' => $row['name_events'] ?? null,
                'date_events' => $row['date_events'] ?? null,

                'type_of_database' => $row['type_of_database'] ?? null,
                'fellows_program' => $row['fellows_program'] ?? null,
                'salutation' => $row['salutation'] ?? null,
                'fullname' => $row['fullname'] ?? null,
                'sex' => $row['sex'] ?? null,
                'email' => $row['email'] ?? null,
                'phone' => $row['phone'] ?? null,
                'institution' => $row['institution'] ?? null,
                'position' => $row['position'] ?? null,
                'sector' => $row['sector'] ?? null,
                'field' => $row['field'] ?? null,
                'socialmedia' => $row['socialmedia'] ?? null,
                'linkedin' => $row['linkedin'] ?? null,
                'citylived' => $row['citylived'] ?? null,
                'country' => $row['country'] ?? null,
                'birthday' => $row['birthday'] ?? null,
                'latesteducation' => $row['latesteducation'] ?? null,
                'englishproficiency' => $row['englishproficiency'] ?? null,
                'fellowship' => $row['fellowship'] ?? null,
                'roleworkshop' => $row['roleworkshop'] ?? null,
                'attendance' => $row['attendance'] ?? null,
                'allergy' => $row['allergy'] ?? null,
                'meal' => $row['meal'] ?? null,
                'disability' => $row['disability'] ?? null,
                'language' => $row['language'] ?? null,
                'bio' => $row['bio'] ?? null,
                'iconsent' => $row['iconsent'] ?? null,
                'availdoc' => $row['availdoc'] ?? null,
                'status_users' => 'Active',

            ]);
        }
    }
}
