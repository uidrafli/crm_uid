<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationForm;
use App\Models\ResultRegistrationForm;
use App\Models\DataCenter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SendBlast extends Controller
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

        $grouped = $data->groupBy('email')->map(function ($items) {
            $first = $items->first();

            return [
                'id_data_center' => $first->id_data_center,
                'salutation' => $first->salutation,
                'fullname' => $first->fullname,
                'email' => $first->email,
                'phone' => $first->phone,
                'type_of_database' => $first->type_of_database,
                'key_events' => $items->pluck('key_events')->unique()->values()->toArray(),
                'name_events' => $items->pluck('name_events')->unique()->values()->toArray(),
                'date_events' => $items->pluck('date_events')->unique()->values()->toArray(),
                'institution' => $items->pluck('institution')->unique()->values()->toArray(),
                'position' => $items->pluck('position')->unique()->values()->toArray(),
                'sector' => $items->pluck('sector')->unique()->values()->toArray(),
                'field' => $items->pluck('field')->unique()->values()->toArray(),
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

            return $match;
        });

        return view('crm.blast.dashboard.dashboard', [
            'title' => 'Campaign Blast Dashboard',
            'user' => User::select('id', 'name')->get(),
            'data' => $filtered,
            'dataOriginal' => $data,
            'filter' => $filtered,
        ]);
    }

    public function send(Request $request)
    {
        dd($request->recipients, $request->subject, $request->attachment, $request->description);
    }
}
