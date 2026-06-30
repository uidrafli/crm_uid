<?php

namespace App\Http\Controllers;

use App\Models\DataCenter;
use App\Models\RegistrationForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\DataCenterExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportDataCenter;

class DataCenterController extends Controller
{
    public function dashboard(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        $role = Auth::user()->users_role;

        if ($role == 'admin') {
            $data = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Active')->get();
        } else {
            $data = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Active')->where('users_role', $role)->get();
        }
        // $dataOriginal = DataCenter::orderby('id_data_center', 'DESC')->fistofFail();
        $data1 = DataCenter::distinct()->pluck('key_events');
        $data2 = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Non Active')->get();

        $form = RegistrationForm::whereIn('key_events', $data1)
            ->pluck('start_date', 'key_events');

        // dd($form);

        $grouped = $data->groupBy('email')->map(function ($items) {
            $first = $items->first();

            return [
                'id_data_center' => $first->id_data_center,
                'salutation' => $first->salutation,
                'fullname' => $first->fullname,
                'email' => $first->email,
                'phone' => $first->phone,
                'key_events' => $items->pluck('key_events')->unique()->values()->toArray(),
                'type_of_database' => $first->type_of_database,
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'fellows_program' => $items->pluck('fellows_program')->unique()->values()->toArray(),
                'date_events' => $items->pluck('date_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'socialmedia' => $items->pluck('socialmedia')->unique()->values()->toArray(),
                'linkedin' => $items->pluck('linkedin')->unique()->values()->toArray(),
                'citylived' => $items->pluck('citylived')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
                'birthday' => $items->pluck('birthday')->unique()->values()->toArray(),
                'latesteducation' => $items->pluck('latesteducation')->unique()->values()->toArray(),
                'englishproficiency' => $items->pluck('englishproficiency')->unique()->values()->toArray(),
                'uploadfile' => $items->pluck('uploadfile')->unique()->values()->toArray(),
                'fellowship' => $items->pluck('fellowship')->unique()->values()->toArray(),
                'essay' => $items->pluck('essay')->unique()->values()->toArray(),
                'roleworkshop' => $items->pluck('roleworkshop')->unique()->values()->toArray(),
                'attendance' => $items->pluck('attendance')->unique()->values()->toArray(),
                'allergy' => $items->pluck('allergy')->unique()->values()->toArray(),
                'meal' => $items->pluck('meal')->unique()->values()->toArray(),
                'disability' => $items->pluck('disability')->unique()->values()->toArray(),
                'language' => $items->pluck('language')->unique()->values()->toArray(),
                'picture' => $items->pluck('picture')->unique()->values()->toArray(),
                'bio' => $items->pluck('bio')->unique()->values()->toArray(),
                'iconsent' => $items->pluck('iconsent')->unique()->values()->toArray(),
                'privacy' => $items->pluck('privacy')->unique()->values()->toArray(),
                'availdoc' => $items->pluck('availdoc')->unique()->values()->toArray(),
                'custome_1' => $items->pluck('custome_1')->unique()->values()->toArray(),
                'custome_2' => $items->pluck('custome_2')->unique()->values()->toArray(),
                'custome_3' => $items->pluck('custome_3')->unique()->values()->toArray(),
                'custome_4' => $items->pluck('custome_4')->unique()->values()->toArray(),
                'custome_5' => $items->pluck('custome_5')->unique()->values()->toArray(),
                'custome_6' => $items->pluck('custome_6')->unique()->values()->toArray(),
                'status_users' => $first->status_users,
            ];
        });

        $grouped_nonactive = $data2->groupBy('email')->map(function ($items) {
            $first = $items->first();

            return [
                'id_data_center' => $first->id_data_center,
                'salutation' => $first->salutation,
                'fullname' => $first->fullname,
                'email' => $first->email,
                'phone' => $first->phone,
                'key_events' => $items->pluck('key_events')->unique()->values()->toArray(),
                'type_of_database' => $first->type_of_database,
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'fellows_program' => $items->pluck('fellows_program')->unique()->values()->toArray(),
                'date_events' => $items->pluck('date_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'socialmedia' => $items->pluck('socialmedia')->unique()->values()->toArray(),
                'linkedin' => $items->pluck('linkedin')->unique()->values()->toArray(),
                'citylived' => $items->pluck('citylived')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
                'birthday' => $items->pluck('birthday')->unique()->values()->toArray(),
                'latesteducation' => $items->pluck('latesteducation')->unique()->values()->toArray(),
                'englishproficiency' => $items->pluck('englishproficiency')->unique()->values()->toArray(),
                'uploadfile' => $items->pluck('uploadfile')->unique()->values()->toArray(),
                'fellowship' => $items->pluck('fellowship')->unique()->values()->toArray(),
                'essay' => $items->pluck('essay')->unique()->values()->toArray(),
                'roleworkshop' => $items->pluck('roleworkshop')->unique()->values()->toArray(),
                'attendance' => $items->pluck('attendance')->unique()->values()->toArray(),
                'allergy' => $items->pluck('allergy')->unique()->values()->toArray(),
                'meal' => $items->pluck('meal')->unique()->values()->toArray(),
                'disability' => $items->pluck('disability')->unique()->values()->toArray(),
                'language' => $items->pluck('language')->unique()->values()->toArray(),
                'picture' => $items->pluck('picture')->unique()->values()->toArray(),
                'bio' => $items->pluck('bio')->unique()->values()->toArray(),
                'iconsent' => $items->pluck('iconsent')->unique()->values()->toArray(),
                'privacy' => $items->pluck('privacy')->unique()->values()->toArray(),
                'availdoc' => $items->pluck('availdoc')->unique()->values()->toArray(),
                'custome_1' => $items->pluck('custome_1')->unique()->values()->toArray(),
                'custome_2' => $items->pluck('custome_2')->unique()->values()->toArray(),
                'custome_3' => $items->pluck('custome_3')->unique()->values()->toArray(),
                'custome_4' => $items->pluck('custome_4')->unique()->values()->toArray(),
                'custome_5' => $items->pluck('custome_5')->unique()->values()->toArray(),
                'custome_6' => $items->pluck('custome_6')->unique()->values()->toArray(),
                'status_users' => $first->status_users,
            ];
        });

        // Filter berdasarkan input user
        $filtered = $grouped->filter(function ($item) use ($request) {
            $match = true;

            if ($request->filled('name_events')) {
                $match = $match && in_array($request->name_events, $item['name_events']);
            }

            if ($request->filled('sector')) {
                $match = $match && in_array($request->sector, $item['sector']);
            }

            if ($request->filled('field')) {
                $match = $match && in_array($request->field, $item['field']);
            }

            if ($request->filled('type_of_database')) {
                $match = $match && in_array($request->type_of_database, $item['type_of_database']);
            }

            if ($request->filled('fellows_program')) {
                $match = $match && in_array($request->fellows_program, $item['fellows_program']);
            }

            return $match;
        });

        return view('crm.datacenter.dashboard.dashboard', [
            'title' => 'Data Center Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $filtered,
            'dataOriginal' => $data,
            'form' => $form,
            'data_nonactive' => $grouped_nonactive,
            'filter' => $filtered,
        ]);
    }

    public function active($email)
    {
        date_default_timezone_set('Asia/Makassar');

        $validated['status_users'] = 'Active';

        try {

            // UPDATE semua data dengan email yang sama
            DataCenter::where('email', $email)
                ->update($validated);

            return redirect('/data-center')
                ->with('success', 'Success Active Data');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed Active Data');
        }
    }

    public function nonactive($email)
    {
        date_default_timezone_set('Asia/Makassar');

        $validated['status_users'] = 'Non Active';

        try {

            // UPDATE semua data dengan email yang sama
            DataCenter::where('email', $email)
                ->update($validated);

            return redirect('/data-center')
                ->with('success', 'Success Non Active Data');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed Non Active Data');
        }
    }

    public function export(Request $request)
    {
        // Ambil data original
        $data = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Active')->get();

        // Grouping
        $grouped = $data->groupBy('email')->map(function ($items) {
            $first = $items->first();

            return [
                'id_data_center' => $first->id_data_center,
                'salutation' => $first->salutation,
                'fullname' => $first->fullname,
                'email' => $first->email,
                'phone' => $first->phone,
                'key_events' => $items->pluck('key_events')->unique()->values()->toArray(),
                'type_of_database' => $first->type_of_database,
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'fellows_program' => $items->pluck('fellows_program')->unique()->values()->toArray(),
                'date_events' => $items->pluck('date_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'socialmedia' => $items->pluck('socialmedia')->unique()->values()->toArray(),
                'linkedin' => $items->pluck('linkedin')->unique()->values()->toArray(),
                'citylived' => $items->pluck('citylived')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
                'birthday' => $items->pluck('birthday')->unique()->values()->toArray(),
                'latesteducation' => $items->pluck('latesteducation')->unique()->values()->toArray(),
                'englishproficiency' => $items->pluck('englishproficiency')->unique()->values()->toArray(),
                'uploadfile' => $items->pluck('uploadfile')->unique()->values()->toArray(),
                'fellowship' => $items->pluck('fellowship')->unique()->values()->toArray(),
                'essay' => $items->pluck('essay')->unique()->values()->toArray(),
                'roleworkshop' => $items->pluck('roleworkshop')->unique()->values()->toArray(),
                'attendance' => $items->pluck('attendance')->unique()->values()->toArray(),
                'allergy' => $items->pluck('allergy')->unique()->values()->toArray(),
                'meal' => $items->pluck('meal')->unique()->values()->toArray(),
                'disability' => $items->pluck('disability')->unique()->values()->toArray(),
                'language' => $items->pluck('language')->unique()->values()->toArray(),
                'picture' => $items->pluck('picture')->unique()->values()->toArray(),
                'bio' => $items->pluck('bio')->unique()->values()->toArray(),
                'iconsent' => $items->pluck('iconsent')->unique()->values()->toArray(),
                'privacy' => $items->pluck('privacy')->unique()->values()->toArray(),
                'availdoc' => $items->pluck('availdoc')->unique()->values()->toArray(),
                'custome_1' => $items->pluck('custome_1')->unique()->values()->toArray(),
                'custome_2' => $items->pluck('custome_2')->unique()->values()->toArray(),
                'custome_3' => $items->pluck('custome_3')->unique()->values()->toArray(),
                'custome_4' => $items->pluck('custome_4')->unique()->values()->toArray(),
                'custome_5' => $items->pluck('custome_5')->unique()->values()->toArray(),
                'custome_6' => $items->pluck('custome_6')->unique()->values()->toArray(),
                'status_users' => $first->status_users,
            ];
        });

        // Filter sesuai request
        $filtered = $grouped->filter(function ($item) use ($request) {
            $match = true;

            if ($request->filled('name_events')) {
                $match = $match && in_array($request->name_events, $item['name_events']);
            }

            if ($request->filled('sector')) {
                $match = $match && in_array($request->sector, $item['sector']);
            }

            if ($request->filled('field')) {
                $match = $match && in_array($request->field, $item['field']);
            }

            if ($request->filled('type_of_database')) {
                $match = $match && in_array($request->type_of_database, $item['type_of_database']);
            }

            if ($request->filled('fellows_program')) {
                $match = $match && in_array($request->fellows_program, $item['fellows_program']);
            }

            return $match;
        });

        // Export hasil filter
        return Excel::download(new DataCenterExport($filtered), 'data_center_filtered.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ImportDataCenter, $request->file('import'));

        return back()->with('success', 'Success import data');
    }
}
