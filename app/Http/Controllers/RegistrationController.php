<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MappingShift;
use App\Models\RegistrationForm;
use App\Models\ResultRegistrationForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function dashboardCreate()
    {
        $title = 'Create Registration Form';
        return view('crm.registration.create', compact(
            'title',
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

        return view('crm.registration.updateform.update', [
            'title' => 'Update Registration Event Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $data
        ]);
    }

    public function showForm($custome_link)
    {
        $data = RegistrationForm::where('custome_link', $custome_link)->firstOrFail();
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
        return view('crm.registration.form.form', compact('data', 'countries'));
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
            'salutation' => 'nullable',
            'salutation_required' => 'nullable',
            'fullname' => 'nullable',
            'fullname_required' => 'nullable',
            'email' => 'nullable',
            'email_required' => 'nullable',
            'phone' => 'nullable',
            'phone_required' => 'nullable',
            'institution' => 'nullable',
            'institution_required' => 'nullable',
            'position' => 'nullable',
            'position_required' => 'nullable',
            'sector' => 'nullable',
            'sector_required' => 'nullable',
            'field' => 'nullable',
            'field_required' => 'nullable',
            'country' => 'nullable',
            'country_required' => 'nullable',

        ], [
            // ✅ INI KHUSUS MESSAGE
            'custome_link.unique' => 'The link has already been used, please use a different one.',
        ]);

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
            RegistrationForm::create($validated);

            return redirect('/registration')->with('success', 'Success create registration form');
        } catch (\Exception $e) {
            // return back()->with('error', 'Failed: ' . $e->getMessage());
            if (str_contains($e->getMessage(), 'Duplicate')) {
                return back()->with('error', 'Data sudah ada sebelumnya');
            }

            return back()->with('error', 'Gagal menyimpan data');
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
            'logo' => 'nullable|file|mimes:png,jpg,jpeg|max:10240',
            'logo_size' => 'nullable',
            'logo_size_mobile' => 'nullable',
            'type_event' => 'nullable',
            'description' => 'nullable',
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

        // OPTIONAL: kalau mau update key_events saat edit
        // $validated['key_events'] = $custome_link . '_' . $validated['start_date'] . '_' . Str::random(10);

        $checkboxFields = [
            'salutation',
            'salutation_required',
            'fullname',
            'fullname_required',
            'email',
            'email_required',
            'phone',
            'phone_required',
            'institution',
            'institution_required',
            'position',
            'position_required',
            'sector',
            'sector_required',
            'field',
            'field_required',
            'country',
            'country_required'
        ];

        foreach ($checkboxFields as $field) {
            $validated[$field] = $request->has($field) ? $request->$field : null;
        }

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

            return back()->with('error', 'Gagal update data');
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

        $validated = $request->validate([
            'key_events' => 'required',
            'users_role' => 'required',
            'name_events' => 'required',
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

        $validated['presence'] = 'absent';
        $validated['status_users'] = 'Active';

        try {

            // =========================
            // UPLOAD LOGO FORM
            // =========================
            // if ($request->hasFile('logo')) {
            //     $file = $request->file('logo');
            //     $filename = Str::random(10) . '_' . $file->getClientOriginalName();

            //     $file->move(public_path('logo-registration-form'), $filename);
            //     $validated['logo'] = 'logo-registration-form/' . $filename;
            // }

            // =========================
            // QR CODE (LOGIKA ASLI KAMU)
            // =========================

            require_once public_path('qrcode_custome_uid/phpqrcode/qrlib.php');

            $name = $validated['salutation'] . '_' . $validated['fullname'];

            $codeQR = $name . '_' . Str::random(5);

            $buatFolder = public_path('qrcode-result-registration/');
            if (!file_exists($buatFolder)) {
                mkdir($buatFolder, 0755, true);
            }

            $logoPath = public_path('qrcode_custome_uid/uidfinal.png');
            $Content = $codeQR;

            // 🔥 PENTING: tambahkan .png (tanpa ubah logika lain)
            $qrTempName = $name . '-' . Str::random(5) . '.png';
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
            $outputName = $name . '-' . Str::random(7) . '.png';
            $outputPath = $buatFolder . $outputName;

            imagepng($QR, $outputPath);
            imagedestroy($QR);

            // simpan path QR ke database (opsional)
            $validated['qrcode_registration'] = 'qrcode-result-registration/' . $outputName;

            // =========================
            // SIMPAN DATABASE
            // =========================
            ResultRegistrationForm::create($validated);

            return redirect('/success-registration')->with('success', 'Success registration');
        } catch (\Exception $e) {
            // return back()->with('error', 'Failed: ' . $e->getMessage());
            if (str_contains($e->getMessage(), 'Duplicate')) {
                return back()->with('error', 'Data sudah ada sebelumnya');
            }

            return back()->with('error', 'Gagal menyimpan data');
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
