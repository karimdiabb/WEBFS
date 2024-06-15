<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantTable;
use App\Models\TableSession;
use Carbon\Carbon;

class TableSessionController extends Controller
{

    public function index()
    {
        $tableSessions = TableSession::all();
        return view('table_sessions.index', compact('tableSessions'));
    }

    public function create()
    {
        $tables = RestaurantTable::all();
        return view('table_sessions.create',  compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required',
            'person_ages' => 'required|array|max:8',
            'person_ages.*' => 'integer|min:0',
            'extra_deluxe' => 'boolean'
        ]);

        $birthdates = array_map(function($age) {
            return Carbon::now()->subYears($age)->format('Y-01-01');
        }, $request->input('person_ages'));

        $tableSession = new TableSession();
        $tableSession->TableID = $request->input('table_id');
        $tableSession->person_birthdates = json_encode($birthdates);
        $tableSession->Deluxe_menu = $request->input('extra_deluxe');

        $tableSession->save();

        return response()->json(['success' => true, 'message' => 'Tafel is succesvol geregristreerd']);
    }
}
