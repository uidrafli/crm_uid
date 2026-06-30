<?php

namespace App\Http\Controllers;

use App\Models\ChecklistController;
use App\Models\EventField;
use App\Models\FieldEvent;
use Illuminate\Http\Request;
use App\Models\MappingShift;
use App\Models\RegistrationForm;
use App\Models\ResultRegistrationForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function dashboardCreate()
    {

        // $passwordTeksBiasa = 'AdminHDX-2026';
        // $passwordDiHash = Hash::make($passwordTeksBiasa);

        // dd($passwordDiHash);

        $data = ChecklistController::latest()->get();
        $title = 'Create Registration Form';
        return view('crm.registration.create', compact(
            'title',
            'data',
        ));
    }

    public function successRegistration()
    {
        $title = 'Seccess Registration';
        return view('crm.registration.form.success', compact(
            'title',
        ));
    }

    public function dashboard()
    {
        date_default_timezone_set('Asia/Makassar');
        // Auto update status event
        RegistrationForm::whereDate('start_date', '<=', Carbon::today())
            ->where('status', '!=', 'Completed')
            ->update([
                'status' => 'Completed'
            ]);

        $role = Auth::user()->users_role;

        if ($role == 'admin') {
            $data = RegistrationForm::latest()->get();
        } else {
            $data = RegistrationForm::where('users_role', $role)->latest()->get();
        }

        return view('crm.registration.dashboard', [
            'title' => 'Registration Event Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $data
        ]);
    }

    public function dashboardUpdateForm($id_update)
    {
        date_default_timezone_set('Asia/Makassar');

        $data = RegistrationForm::where('id_events_form', $id_update)->firstOrFail();
        $data_checklist = ChecklistController::latest()->get();

        // Siapkan array kosong untuk menampung data json dan size dari 1 sampai 6
        $json_data = [];
        $size_data = [];

        for ($i = 1; $i <= 6; $i++) {
            // Mengambil nama kolom secara dinamis, misal: json_1, json_2, dst.
            $columnName = 'json_' . $i;

            // Decode JSON dari database
            $decoded = json_decode($data->$columnName, true);
            $json_data[$i] = $decoded;

            // Hitung size dari KB ke MB
            $size_data[$i] = isset($decoded['custome_size']) ? ($decoded['custome_size'] / 1024) : 0;
        }

        return view('crm.registration.updateform.update', [
            'title' => 'Update Registration Event Dashboard',
            'user'  => User::select('id', 'name')->get(),
            'data'  => $data,
            'data_checklist'  => $data_checklist,
            'json_data' => $json_data, // Dikirim sebagai array beralamat indeks 1-6
            'size_data' => $size_data, // Dikirim sebagai array beralamat indeks 1-6
        ]);
    }

    public function showForm($custome_link)
    {
        $data = RegistrationForm::where('custome_link', $custome_link)->firstOrFail();

        // Siapkan array kosong untuk menampung data json dan size dari 1 sampai 6
        $json_data = [];

        for ($i = 1; $i <= 6; $i++) {
            // Mengambil nama kolom secara dinamis, misal: json_1, json_2, dst.
            $columnName = 'json_' . $i;

            // Decode JSON dari database
            $decoded = json_decode($data->$columnName, true);
            $json_data[$i] = $decoded;
        }

        $countries = [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Estonia',
            'Eswatini',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Guatemala',
            'Guinea',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kuwait',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Lithuania',
            'Luxembourg',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Korea',
            'Norway',
            'Oman',
            'Pakistan',
            'Palestine',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Somalia',
            'South Africa',
            'South Korea',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
        ];
        return view('crm.registration.form.form', compact('data', 'countries', 'json_data'));
    }

    public function resultForm($key_events)
    {
        date_default_timezone_set('Asia/Makassar');
        $data = ResultRegistrationForm::where('key_events', $key_events)->get();
        $data2 = ResultRegistrationForm::where('key_events', $key_events)->where('presence', 'attend')->get();

        // if ($data->isEmpty()) {
        //     abort(404);
        // }

        $row = $data->first();

        return view('crm.registration.dashboard.resultForm', [
            'title' => 'Registration Results Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $data,
            'data2' => $data2,
            'row' => $row
        ]);
    }

    public function dashboardUpdateResult($id_update)
    {
        date_default_timezone_set('Asia/Makassar');
        $data = ResultRegistrationForm::where('id_data_center', $id_update)->firstOrFail();
        $key_events = $data->key_events;
        $form = RegistrationForm::where('key_events', $key_events)->firstOrFail();
        $countries = [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Estonia',
            'Eswatini',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Guatemala',
            'Guinea',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kuwait',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Lithuania',
            'Luxembourg',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Korea',
            'Norway',
            'Oman',
            'Pakistan',
            'Palestine',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Somalia',
            'South Africa',
            'South Korea',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
        ];

        $sectors = ['Government', 'Business', 'Civil Society'];

        $fields = ['Leadership', 'Forestry', 'Technology', 'Creative Economy & Industry', 'Education, Capacity Building, and Youth Empowerment', 'Blended & Sustainable Finance', 'Energy', 'Equality & Inclusion', 'Health, Wellbeing & Sports', 'Good Governance & Leadership', 'MSME & Entrepreneurship', 'Regenerative Landscape and Community Livelihood'];

        return view('crm.registration.dashboard.updateresult', [
            'title' => 'Update Registration Result Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $data,
            'countries' => $countries,
            'sectors' => $sectors,
            'fields' => $fields,
            'form' => $form,
        ]);
    }

    public function createForm(Request $request)
    {

        date_default_timezone_set('Asia/Makassar');
        $userId = Auth::user()->id;
        $role = Auth::user()->users_role;

        $validated = $request->validate([
            'title' => 'nullable',
            'location' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'time_zone' => 'nullable',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
            'logo_size' => 'nullable',
            'logo_size_mobile' => 'nullable',
            'type_event' => 'nullable',

            'custome_link' => [
                'nullable',
                Rule::unique('events_form', 'custome_link')
            ],

            // 🔥 PINDAH KE SINI
            'description' => 'nullable',
            'subject' => 'nullable',
            'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,png,jpg,jpeg|max:10240',
            'description_notif' => 'nullable',
            'salutation' => 'nullable',
            'salutation_required' => 'nullable',
            'salutation_width' => 'nullable',
            'salutation_orderby' => 'nullable',
            'fullname' => 'nullable',
            'fullname_required' => 'nullable',
            'fullname_width' => 'nullable',
            'fullname_orderby' => 'nullable',
            'sex' => 'nullable',
            'sex_required' => 'nullable',
            'sex_width' => 'nullable',
            'sex_orderby' => 'nullable',
            'email' => 'nullable',
            'email_required' => 'nullable',
            'email_width' => 'nullable',
            'email_orderby' => 'nullable',
            'phone' => 'nullable',
            'phone_required' => 'nullable',
            'phone_width' => 'nullable',
            'phone_orderby' => 'nullable',
            'institution' => 'nullable',
            'institution_required' => 'nullable',
            'institution_width' => 'nullable',
            'institution_orderby' => 'nullable',
            'position' => 'nullable',
            'position_required' => 'nullable',
            'position_width' => 'nullable',
            'position_orderby' => 'nullable',
            'sector' => 'nullable',
            'sector_required' => 'nullable',
            'sector_width' => 'nullable',
            'sector_orderby' => 'nullable',
            'field' => 'nullable',
            'field_required' => 'nullable',
            'field_width' => 'nullable',
            'field_orderby' => 'nullable',
            'socialmedia' => 'nullable',
            'socialmedia_required' => 'nullable',
            'socialmedia_width' => 'nullable',
            'socialmedia_orderby' => 'nullable',
            'linkedin' => 'nullable',
            'linkedin_required' => 'nullable',
            'linkedin_width' => 'nullable',
            'linkedin_orderby' => 'nullable',
            'citylived' => 'nullable',
            'citylived_required' => 'nullable',
            'citylived_width' => 'nullable',
            'citylived_orderby' => 'nullable',
            'country' => 'nullable',
            'country_required' => 'nullable',
            'country_width' => 'nullable',
            'country_orderby' => 'nullable',
            'birthday' => 'nullable',
            'birthday_required' => 'nullable',
            'birthday_width' => 'nullable',
            'birthday_orderby' => 'nullable',
            'latesteducation' => 'nullable',
            'latesteducation_required' => 'nullable',
            'latesteducation_width' => 'nullable',
            'latesteducation_orderby' => 'nullable',
            'englishproficiency' => 'nullable',
            'englishproficiency_required' => 'nullable',
            'englishproficiency_width' => 'nullable',
            'englishproficiency_orderby' => 'nullable',
            'uploadfile' => 'nullable',
            'uploadfile_required' => 'nullable',
            'uploadfile_width' => 'nullable',
            'uploadfile_orderby' => 'nullable',
            'fellowship' => 'nullable',
            'fellowship_required' => 'nullable',
            'fellowship_width' => 'nullable',
            'fellowship_orderby' => 'nullable',
            'essay' => 'nullable',
            'essay_required' => 'nullable',
            'essay_width' => 'nullable',
            'essay_orderby' => 'nullable',
            'roleworkshop' => 'nullable',
            'roleworkshop_required' => 'nullable',
            'roleworkshop_width' => 'nullable',
            'roleworkshop_orderby' => 'nullable',
            'attendance' => 'nullable',
            'attendance_required' => 'nullable',
            'attendance_width' => 'nullable',
            'attendance_orderby' => 'nullable',
            'allergy' => 'nullable',
            'allergy_required' => 'nullable',
            'allergy_width' => 'nullable',
            'allergy_orderby' => 'nullable',
            'meal' => 'nullable',
            'meal_required' => 'nullable',
            'meal_width' => 'nullable',
            'meal_orderby' => 'nullable',
            'disability' => 'nullable',
            'disability_required' => 'nullable',
            'disability_width' => 'nullable',
            'disability_orderby' => 'nullable',
            'language' => 'nullable',
            'language_required' => 'nullable',
            'language_width' => 'nullable',
            'language_orderby' => 'nullable',
            'picture' => 'nullable',
            'picture_required' => 'nullable',
            'picture_width' => 'nullable',
            'picture_orderby' => 'nullable',
            'bio' => 'nullable',
            'bio_required' => 'nullable',
            'bio_width' => 'nullable',
            'bio_orderby' => 'nullable',
            'iconsent' => 'nullable',
            'iconsent_required' => 'nullable',
            'iconsent_width' => 'nullable',
            'iconsent_orderby' => 'nullable',
            'availdoc' => 'nullable',
            'availdoc_required' => 'nullable',
            'availdoc_width' => 'nullable',
            'availdoc_orderby' => 'nullable',

        ], [
            // ✅ INI KHUSUS MESSAGE
            'custome_link.unique' => 'The link has already been used, please use a different one.',
        ]);

        for ($i = 1; $i <= 6; $i++) {
            // 1. Cek apakah checkbox custome_$i dicentang oleh user
            if ($request->has("custome_$i")) {

                // 2. Konversi ukuran file ke KB jika input custome_size_$i ada nilainya
                $maxSizeInKb = $request->input("custome_size_$i") ? ($request->input("custome_size_$i") * 1024) : null;

                // 3. Susun data JSON untuk indeks ke-$i
                $jsonData = [
                    'custome'          => $request->input("custome_$i"),
                    'custome_required' => $request->input("custome_required_$i"), // Menyesuaikan name input Anda di Blade
                    'width'            => $request->input("width_$i"),
                    'orderby'          => $request->input("orderby_$i"),
                    'label'            => $request->input("label_$i"),
                    'type'             => $request->input("type_$i"),
                    'options'          => $request->input("options_$i"),
                    'custome_check'    => $request->input("custome_check_$i"),
                    'custome_size'     => $maxSizeInKb,
                    'extensions'       => $request->input("extensions_$i") ?? [],
                ];

                // 4. Masukkan ke dalam array validated sebagai string JSON
                $validated['json_' . $i] = json_encode($jsonData);
            } else {
                // Jika checkbox utama tidak dicentang, set kolom json_ menjadi null (atau sesuai kebutuhan Anda)
                $validated['json_' . $i] = null;
            }
        }

        // dd($validated);

        $custome_link = preg_replace('/[^A-Za-z0-9]/', '_', $validated['custome_link']);
        $custome_link = preg_replace('/_+/', '_', $custome_link);
        $custome_link = trim($custome_link, '_');
        if (empty($custome_link)) {
            $custome_link = 'event_' . Str::random(5);
        }
        // $original = $custome_link;
        // $count = 1;

        // while (\App\Models\RegistrationForm::where('custome_link', $custome_link)->exists()) {
        //     $custome_link = $original . '_' . $count;
        //     $count++;
        // }

        // masukkan kembali ke validated
        $validated['custome_link'] = $custome_link;

        $validated['user_id'] = $userId;
        $validated['key_events'] = $custome_link . '_' . $validated['start_date'] . '_' . Str::random(10);
        $validated['users_role'] = $role;
        $validated['status'] = 'Coming Soon';

        try {

            // =========================
            // UPLOAD LOGO FORM
            // =========================
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();

                $file->move(public_path('logo-registration-form'), $filename);
                $validated['logo'] = 'logo-registration-form/' . $filename;
            }

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();

                $file->move(public_path('attachment-email-registration-form'), $filename);
                $validated['attachment'] = 'attachment-email-registration-form/' . $filename;
            }

            // =========================
            // QR CODE (LOGIKA ASLI KAMU)
            // =========================

            require_once public_path('qrcode_custome_uid/phpqrcode/qrlib.php');

            // $custome_link = $validated['custome_link'];

            $buatFolder = public_path('qrcode-link-registration/');
            if (!file_exists($buatFolder)) {
                mkdir($buatFolder, 0755, true);
            }

            $logoPath = public_path('qrcode_custome_uid/uidfinal.png');
            $Content = "https://ems.uid.or.id/registration/" . $custome_link;

            // 🔥 PENTING: tambahkan .png (tanpa ubah logika lain)
            $qrTempName = $custome_link . '-' . Str::random(5) . '.png';
            $qrTempPath = $buatFolder . $qrTempName;

            \QRcode::png($Content, $qrTempPath, QR_ECLEVEL_H, 20, 2);

            $qrRaw = imagecreatefrompng($qrTempPath);
            $QR = imagecreatetruecolor(imagesx($qrRaw), imagesy($qrRaw));

            imagecopy($QR, $qrRaw, 0, 0, 0, 0, imagesx($qrRaw), imagesy($qrRaw));

            $logo = imagecreatefrompng($logoPath);

            imagealphablending($QR, true);
            imagesavealpha($QR, true);

            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            $dest_x = ($QR_width - $logo_width) / 2;
            $dest_y = ($QR_height - $logo_height) / 2;

            imagecopy($QR, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height);

            // 🔥 output final (tetap sesuai pola kamu)
            $outputName = $custome_link . '-' . Str::random(7) . '.png';
            $outputPath = $buatFolder . $outputName;

            imagepng($QR, $outputPath);
            imagedestroy($QR);

            // simpan path QR ke database (opsional)
            $validated['qrcode_link'] = 'qrcode-link-registration/' . $outputName;

            // =========================
            // SIMPAN DATABASE
            // =========================
            // RegistrationForm::create($validated);
            RegistrationForm::create($validated);

            // foreach ($request->fields as $field) {
            //     FieldEvent::create([
            //         'events_form_id' => $event->id_events_form,
            //         'label' => $field['label'],
            //         'name' => $field['name'],
            //         'type' => $field['type'],
            //         'options' => $field['options'] ?? null,
            //         'required' => $field['required'] ?? null,
            //     ]);
            // }

            return redirect('/registration')->with('success', 'Success create registration form');
        } catch (\Exception $e) {
            // return back()->with('error', 'Failed: ' . $e->getMessage());
            if (str_contains($e->getMessage(), 'Duplicate')) {
                return back()->with('error', 'Data sudah ada sebelumnya');
            }

            return back()->with('error', $e->getMessage());
        }
    }

    public function updateForm(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $data = RegistrationForm::findOrFail($id);

        $userId = Auth::user()->id;
        $role   = Auth::user()->is_admin;

        $validated = $request->validate([
            'title' => 'nullable',
            'location' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'time_zone' => 'nullable',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
            'logo_size' => 'nullable',
            'logo_size_mobile' => 'nullable',
            'type_event' => 'nullable',
            'description' => 'nullable',
            'subject' => 'nullable',
            'attachment' => 'nullable|file|mimes:pdf,docx,xlsx,png,jpg,jpeg|max:10240',
            'description_notif' => 'nullable',
            'custome_link' => [
                'nullable',
                Rule::unique('events_form', 'custome_link')
                    ->ignore($data->id_events_form, 'id_events_form')
            ],
        ], [
            'custome_link.unique' => 'The link has already been used, please use a different one.',
        ]);

        // =========================
        // HANDLE CUSTOM LINK (cek duplicate kecuali dirinya sendiri)
        // =========================
        $custome_link = preg_replace('/[^A-Za-z0-9]/', '_', $validated['custome_link']);
        $custome_link = preg_replace('/_+/', '_', $custome_link);
        $custome_link = trim($custome_link, '_');
        if (empty($custome_link)) {
            $custome_link = 'event_' . Str::random(5);
        }

        // $original = $custome_link;
        // $count = 1;

        // while (\App\Models\RegistrationForm::where('custome_link', $custome_link)
        //     ->where('id_events_form', '!=', $data->id_events_form)
        //     ->exists()
        // ) {
        //     $custome_link = $original . '_' . $count;
        //     $count++;
        // }

        // masukkan kembali ke validated
        $validated['custome_link'] = $custome_link;

        $validated['user_id'] = $userId;
        $validated['role_create'] = $role;
        $validated['status'] = 'Coming Soon';

        // OPTIONAL: kalau mau update key_events saat edit
        // $validated['key_events'] = $custome_link . '_' . $validated['start_date'] . '_' . Str::random(10);

        $checkboxFields = [
            'salutation',
            'salutation_required',
            'salutation_width',
            'salutation_orderby',
            'fullname',
            'fullname_required',
            'fullname_width',
            'fullname_orderby',
            'sex',
            'sex_required',
            'sex_width',
            'sex_orderby',
            'email',
            'email_required',
            'email_width',
            'email_orderby',
            'phone',
            'phone_required',
            'phone_width',
            'phone_orderby',
            'institution',
            'institution_required',
            'institution_width',
            'institution_orderby',
            'position',
            'position_required',
            'position_width',
            'position_orderby',
            'sector',
            'sector_required',
            'sector_width',
            'sector_orderby',
            'field',
            'field_required',
            'field_width',
            'field_orderby',
            'socialmedia',
            'socialmedia_required',
            'socialmedia_width',
            'socialmedia_orderby',
            'linkedin',
            'linkedin_required',
            'linkedin_width',
            'linkedin_orderby',
            'citylived',
            'citylived_required',
            'citylived_width',
            'citylived_orderby',
            'country',
            'country_required',
            'country_width',
            'country_orderby',
            'birthday',
            'birthday_required',
            'birthday_width',
            'birthday_orderby',
            'latesteducation',
            'latesteducation_required',
            'latesteducation_width',
            'latesteducation_orderby',
            'englishproficiency',
            'englishproficiency_required',
            'englishproficiency_width',
            'englishproficiency_orderby',
            'uploadfile',
            'uploadfile_required',
            'uploadfile_width',
            'uploadfile_orderby',
            'fellowship',
            'fellowship_required',
            'fellowship_width',
            'fellowship_orderby',
            'essay',
            'essay_required',
            'essay_width',
            'essay_orderby',
            'roleworkshop',
            'roleworkshop_required',
            'roleworkshop_width',
            'roleworkshop_orderby',
            'attendance',
            'attendance_required',
            'attendance_width',
            'attendance_orderby',
            'allergy',
            'allergy_required',
            'allergy_width',
            'allergy_orderby',
            'meal',
            'meal_required',
            'meal_width',
            'meal_orderby',
            'disability',
            'disability_required',
            'disability_width',
            'disability_orderby',
            'language',
            'language_required',
            'language_width',
            'language_orderby',
            'picture',
            'picture_required',
            'picture_width',
            'picture_orderby',
            'bio',
            'bio_required',
            'bio_width',
            'bio_orderby',
            'iconsent',
            'iconsent_required',
            'iconsent_width',
            'iconsent_orderby',
            'availdoc',
            'availdoc_required',
            'availdoc_width',
            'availdoc_orderby',
        ];

        foreach ($checkboxFields as $field) {
            $validated[$field] = $request->has($field) ? $request->$field : null;
        }

        for ($i = 1; $i <= 6; $i++) {
            // 1. Cek apakah checkbox custome_$i dicentang oleh user
            if ($request->has("custome_$i")) {

                // 2. Konversi ukuran file ke KB jika input custome_size_$i ada nilainya
                $maxSizeInKb = $request->input("custome_size_$i") ? ($request->input("custome_size_$i") * 1024) : null;

                // 3. Susun data JSON untuk indeks ke-$i
                $jsonData = [
                    'custome'          => $request->input("custome_$i"),
                    'custome_required' => $request->input("custome_required_$i"), // Menyesuaikan name input Anda di Blade
                    'width'            => $request->input("width_$i"),
                    'orderby'          => $request->input("orderby_$i"),
                    'label'            => $request->input("label_$i"),
                    'type'             => $request->input("type_$i"),
                    'options'          => $request->input("options_$i"),
                    'custome_check'    => $request->input("custome_check_$i"),
                    'custome_size'     => $maxSizeInKb,
                    'extensions'       => $request->input("extensions_$i") ?? [],
                ];

                // 4. Masukkan ke dalam array validated sebagai string JSON
                $validated['json_' . $i] = json_encode($jsonData);
            } else {
                // Jika checkbox utama tidak dicentang, set kolom json_ menjadi null (atau sesuai kebutuhan Anda)
                $validated['json_' . $i] = null;
            }
        }

        // dd($validated);

        try {

            // =========================
            // UPLOAD LOGO (replace lama)
            // =========================
            if ($request->hasFile('logo')) {

                // hapus logo lama
                if ($data->logo && file_exists(public_path($data->logo))) {
                    unlink(public_path($data->logo));
                }

                $file = $request->file('logo');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();

                $file->move(public_path('logo-registration-form'), $filename);
                $validated['logo'] = 'logo-registration-form/' . $filename;
            } else {
                // pakai logo lama
                $validated['logo'] = $data->logo;
            }

            if ($request->hasFile('attachment')) {

                // hapus attachment lama
                if ($data->attachment && file_exists(public_path($data->attachment))) {
                    unlink(public_path($data->attachment));
                }

                $file = $request->file('attachment');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();

                $file->move(public_path('attachment-email-registration-form'), $filename);
                $validated['attachment'] = 'attachment-email-registration-form/' . $filename;
            } else {
                // pakai attachment lama
                $validated['attachment'] = $data->attachment;
            }

            // =========================
            // QR CODE (REGENERATE kalau link berubah)
            // =========================

            if ($custome_link != $data->custome_link) {

                require_once public_path('qrcode_custome_uid/phpqrcode/qrlib.php');

                $buatFolder = public_path('qrcode-link-registration/');
                if (!file_exists($buatFolder)) {
                    mkdir($buatFolder, 0755, true);
                }

                $logoPath = public_path('qrcode_custome_uid/uidfinal.png');
                $Content = "https://ems.uid.or.id/registration/" . $custome_link;

                $qrTempName = $custome_link . '-' . Str::random(5) . '.png';
                $qrTempPath = $buatFolder . $qrTempName;

                \QRcode::png($Content, $qrTempPath, QR_ECLEVEL_H, 20, 2);

                $qrRaw = imagecreatefrompng($qrTempPath);
                $QR = imagecreatetruecolor(imagesx($qrRaw), imagesy($qrRaw));

                imagecopy($QR, $qrRaw, 0, 0, 0, 0, imagesx($qrRaw), imagesy($qrRaw));

                $logo = imagecreatefrompng($logoPath);

                imagealphablending($QR, true);
                imagesavealpha($QR, true);

                $QR_width = imagesx($QR);
                $QR_height = imagesy($QR);
                $logo_width = imagesx($logo);
                $logo_height = imagesy($logo);

                $dest_x = ($QR_width - $logo_width) / 2;
                $dest_y = ($QR_height - $logo_height) / 2;

                imagecopy($QR, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height);

                $outputName = $custome_link . '-' . Str::random(7) . '.png';
                $outputPath = $buatFolder . $outputName;

                imagepng($QR, $outputPath);
                imagedestroy($QR);

                // hapus QR lama
                if ($data->qrcode_link && file_exists(public_path($data->qrcode_link))) {
                    unlink(public_path($data->qrcode_link));
                }

                $validated['qrcode_link'] = 'qrcode-link-registration/' . $outputName;
            } else {
                // pakai QR lama
                $validated['qrcode_link'] = $data->qrcode_link;
            }

            // =========================
            // UPDATE DATABASE
            // =========================
            $data->update($validated);

            return redirect('/registration/update-form/' . $id)->with('success', 'Success update registration form');
        } catch (\Exception $e) {

            // \Log::error($e->getMessage());

            if (str_contains($e->getMessage(), 'Duplicate')) {
                return back()->with('error', 'Data sudah ada sebelumnya');
            }

            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteForm($id)
    {
        $data = RegistrationForm::find($id);
        $data->delete();
        return redirect('/registration')->with('success', 'Data Successfully Deleted');
    }

    public function deleteResult($id)
    {
        $data = ResultRegistrationForm::find($id);
        $key_events = $data->key_events;
        $data->delete();
        return redirect('/registration/dashboard/' . $key_events)->with('success', 'Data Successfully Deleted');
    }

    public function submitForm(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');

        try {
            // ==========================================
            // 1. VALIDASI DATA UMUM & FILE UTAMA
            // ==========================================
            $validatedData = $request->validate([
                'key_events' => 'nullable',
                'type_of_database' => 'nullable',
                'users_role' => 'nullable',
                'name_events' => 'nullable',
                'date_events' => 'nullable',
                'salutation' => 'nullable',
                'fullname' => 'nullable',
                'sex' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'institution' => 'nullable',
                'position' => 'nullable',
                'sector' => 'nullable',
                'field' => 'nullable',
                'socialmedia' => 'nullable',
                'linkedin' => 'nullable',
                'citylived' => 'nullable',
                'country' => 'nullable',
                'birthday' => 'nullable',
                'latesteducation' => 'nullable',
                'englishproficiency' => 'nullable',
                'uploadfile' => 'nullable|file|mimes:pdf|max:5120',
                'fellowship' => 'nullable',
                'essay' => 'nullable|file|mimes:pdf|max:5120',
                'roleworkshop' => 'nullable',
                'attendance' => 'nullable',
                'allergy' => 'nullable',
                'meal' => 'nullable',
                'disability' => 'nullable',
                'language' => 'nullable',
                'picture' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
                'bio' => 'nullable',
                'iconsent' => 'nullable',
                'availdoc' => 'nullable',
            ], [
                'uploadfile.file'  => 'The input must be a valid file.',
                'uploadfile.mimes' => 'The file format must be PDF',
                'uploadfile.max'   => 'The maximum file size is 5MB.',
                'essay.file'  => 'The input must be a valid file.',
                'essay.mimes' => 'The file format must be PDF',
                'essay.max'   => 'The maximum file size is 5MB.',
                'picture.file'  => 'The input must be a valid file.',
                'picture.mimes' => 'The file format must be PNG, JPG, JPEG.',
                'picture.max'   => 'The maximum file size is 10MB.',
            ]);

            // Nilai Default
            $validatedData['presence'] = 'absent';
            $validatedData['status_users'] = 'Active';

            // Logika "Others" yang diperbaiki
            $validatedData['fellowship'] = ($request->input('fellowship') === 'Others') ? $request->input('other_fellowship') : $request->input('fellowship');
            $validatedData['allergy']    = ($request->input('allergy') === 'Others') ? $request->input('other_allergy') : $request->input('allergy');
            $validatedData['meal']       = ($request->input('meal') === 'Others') ? $request->input('other_meal') : $request->input('meal');
            $validatedData['disability'] = ($request->input('disability') === 'Others') ? $request->input('other_disability') : $request->input('disability');
            $validatedData['language']   = ($request->input('language') === 'Others') ? $request->input('other_language') : $request->input('language');

            // ==========================================
            // 2. VALIDASI DINAMIS UNTUK CUSTOM FIELD 1-6
            // ==========================================
            $customRules = [];
            $customMessages = [];

            for ($i = 1; $i <= 6; $i++) {
                $fieldName = 'custome_' . $i;
                $labelName = $request->input("label_{$i}", "Custom Field {$i}");

                if ($request->hasFile($fieldName) || $request->has("extensions_{$i}")) {
                    $ext = $request->input("extensions_{$i}");
                    $size = $request->input("size_{$i}");

                    $fileRules = ['file'];

                    if (!empty($ext)) {
                        $fileRules[] = 'mimes:' . $ext;
                        $customMessages["{$fieldName}.mimes"] = "Format file {$labelName} harus berupa: {$ext}.";
                    }

                    if (!empty($size)) {
                        $fileRules[] = 'max:' . $size;
                        $customMessages["{$fieldName}.max"] = "Ukuran file {$labelName} maksimal adalah " . ($size / 1024) . " MB.";
                    }

                    $customRules[$fieldName] = $fileRules;
                } elseif (is_array($request->input($fieldName))) {
                    $customRules[$fieldName] = 'array';
                }
            }

            // Jalankan validasi custom (tanpa menimpa $validatedData utama)
            $validatedCustomData = $request->validate($customRules, $customMessages);

            // ==========================================
            // 3. PROSES DATA CUSTOM FIELD
            // ==========================================
            for ($i = 1; $i <= 6; $i++) {
                $fieldName = 'custome_' . $i;
                $fieldLabel = 'label_' . $i;
                $labelName = $request->input("label_{$i}");
                $validatedData[$fieldLabel] = $labelName;

                if ($request->hasFile($fieldName)) {
                    $file = $request->file($fieldName);
                    $filename = time() . '_custome' . $i . '_' . $file->getClientOriginalName();
                    // $file->storeAs('public/crm-upload-file', $filename); // Menyimpan lewat sistem bawaan Laravel
                    $file->move(public_path('crm-upload-file'), $filename);

                    // Tambahkan ke array utama
                    $validatedData[$fieldName] = 'crm-upload-file/' . $filename;
                } elseif ($request->has($fieldName)) {
                    $inputValue = $request->input($fieldName);
                    $validatedData[$fieldName] = is_array($inputValue) ? implode(', ', $inputValue) : $inputValue;
                } else {
                    $validatedData[$fieldName] = null;
                }
            }

            // dd($validatedData);

            // ==========================================
            // 4. UPLOAD FILE UTAMA (uploadfile, essay, picture)
            // ==========================================
            if ($request->hasFile('uploadfile')) {
                $file = $request->file('uploadfile');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();
                $file->move(public_path('crm-upload-cv'), $filename);
                $validatedData['uploadfile'] = 'crm-upload-cv/' . $filename;
            }

            if ($request->hasFile('essay')) {
                $file = $request->file('essay');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();
                $file->move(public_path('crm-upload-essay'), $filename);
                $validatedData['essay'] = 'crm-upload-essay/' . $filename;
            }

            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $filename = Str::random(10) . '_' . $file->getClientOriginalName();
                $file->move(public_path('crm-upload-picture'), $filename);
                $validatedData['picture'] = 'crm-upload-picture/' . $filename;
            }

            // ==========================================
            // 5. GENERATE QR CODE
            // ==========================================
            if (!empty($validatedData['salutation']) && !empty($validatedData['fullname'])) {
                require_once public_path('qrcode_custome_uid/phpqrcode/qrlib.php');

                $name = $validatedData['salutation'] . '_' . $validatedData['fullname'];
                $codeQR = $name . '_' . Str::random(5);
                $buatFolder = public_path('qrcode-result-registration/');

                if (!file_exists($buatFolder)) {
                    mkdir($buatFolder, 0755, true);
                }

                $logoPath = public_path('qrcode_custome_uid/uidfinal.png');
                $qrTempName = $name . '-' . Str::random(5) . '.png';
                $qrTempPath = $buatFolder . $qrTempName;

                \QRcode::png($codeQR, $qrTempPath, QR_ECLEVEL_H, 20, 2);

                $qrRaw = imagecreatefrompng($qrTempPath);
                $QR = imagecreatetruecolor(imagesx($qrRaw), imagesy($qrRaw));
                imagecopy($QR, $qrRaw, 0, 0, 0, 0, imagesx($qrRaw), imagesy($qrRaw));

                $logo = imagecreatefrompng($logoPath);
                imagealphablending($QR, true);
                imagesavealpha($QR, true);

                $QR_width = imagesx($QR);
                $QR_height = imagesy($QR);
                $logo_width = imagesx($logo);
                $logo_height = imagesy($logo);

                $dest_x = ($QR_width - $logo_width) / 2;
                $dest_y = ($QR_height - $logo_height) / 2;

                imagecopy($QR, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height);

                $outputName = $name . '-' . Str::random(7) . '.png';
                $outputPath = $buatFolder . $outputName;

                imagepng($QR, $outputPath);
                imagedestroy($QR);

                $validatedData['qrcode_registration'] = 'qrcode-result-registration/' . $outputName;
            }

            // ==========================================
            // 6. SIMPAN KE DATABASE
            // ==========================================
            // dd($validatedData); // Hapus komentar ini jika ingin mengecek isi array sebelum disimpan
            $subject = $request->subject;
            $description = $request->description_notif;
            $fileUrl = $request->attach_email;
            $namefull = $request->salutation . ' ' . $request->fullname;

            $isEmpty = empty($subject) && empty($description) && empty($fileUrl);

            Mail::to($request->email)->send(
                new \App\Mail\NotifEmailRegist($subject, $description, $fileUrl, $namefull, $isEmpty)
            );

            ResultRegistrationForm::create($validatedData);

            return redirect('/success-registration')->with('success', 'Success registration')->with('subject', $request->subject)->with('description_notif', $request->description_notif)->with('logo', $request->logo)->with('logo_size', $request->logo_size)->with('logo_size_mobile', $request->logo_size_mobile);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Duplicate')) {
                return back()->with('error', 'Data sudah ada sebelumnya');
            }
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateResult(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        // ambil data dulu
        $data = ResultRegistrationForm::findOrFail($id);

        $validated = $request->validate([
            'salutation' => 'nullable',
            'fullname' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'institution' => 'nullable',
            'position' => 'nullable',
            'sector' => 'nullable',
            'field' => 'nullable',
            'country' => 'nullable',
        ]);

        try {

            // =========================
            // UPDATE DATABASE
            // =========================
            $data->update($validated);

            return redirect('/registration/update-results/' . $id)
                ->with('success', 'Success update Data');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed update data');
        }
    }

    public function updateAbsentResult($id)
    {
        date_default_timezone_set('Asia/Makassar');

        // ambil data dulu
        $data = ResultRegistrationForm::findOrFail($id);

        $key_events = $data->key_events;

        // optional: kalau mau tetap set presence
        $validated['presence'] = 'attend';

        try {

            // =========================
            // UPDATE DATABASE
            // =========================
            $data->update($validated);

            return redirect('/registration/dashboard/' . $key_events)
                ->with('success', 'Success Absent Data');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed Absent data');
        }
    }
}
