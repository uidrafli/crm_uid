<?php

namespace App\Http\Controllers;

use App\Models\DataCenter;
use App\Models\RegistrationForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\DataCenterExport;
use Maatwebsite\Excel\Facades\Excel;

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
            ->pluck('start_date');

        // dd($user->username);

        $grouped = $data->groupBy('email')->map(function ($items) {
            $first = $items->first();

            return [
                'id_data_center' => $first->id_data_center,
                'salutation' => $first->salutation,
                'fullname' => $first->fullname,
                'email' => $first->email,
                'phone' => $first->phone,
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
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
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
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
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
                'country' => $items->pluck('country')->unique()->values()->toArray(),
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

            return $match;
        });

        // Export hasil filter
        return Excel::download(new DataCenterExport($filtered), 'data_center_filtered.xlsx');
    }
}
