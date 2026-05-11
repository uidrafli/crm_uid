<?php

namespace App\Http\Controllers;

use App\Models\DataCenter;
use App\Models\RegistrationForm;
use App\Models\User;
use Illuminate\Http\Request;

class DataCenterController extends Controller
{
    public function dashboard()
    {
        date_default_timezone_set('Asia/Makassar');
        // $dataOriginal = DataCenter::orderby('id_data_center', 'DESC')->fistofFail();
        $data = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Active')->get();
        $data1 = DataCenter::distinct()->pluck('key_events');
        $data2 = DataCenter::orderby('id_data_center', 'DESC')->where('status_users', 'Non Active')->get();

        $form = RegistrationForm::whereIn('key_events', $data1)
            ->pluck('start_date');

        // dd($form);

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

        return view('crm.datacenter.dashboard.dashboard', [
            'title' => 'Data Center Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $grouped,
            'dataOriginal' => $data,
            'form' => $form,
            'data_nonactive' => $grouped_nonactive,
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
}
