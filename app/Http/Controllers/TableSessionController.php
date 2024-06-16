<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantTable;
use App\Models\TableSession;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TableSessionController extends Controller
{
    public function index()
    {
        $tableSessions = TableSession::all();

        foreach ($tableSessions as $session) {
            Log::info('Session ID: ' . $session->SessionID . ', Needs Help: ' . $session->needsHelp);
        }

        return view('table_sessions.index', compact('tableSessions'));
    }

    public function create()
    {
        $tables = RestaurantTable::all();
        return view('table_sessions.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required',
            'person_ages' => 'required|array|max:8',
            'person_ages.*' => 'integer|min:0',
            'extra_deluxe' => 'boolean'
        ]);

        $birthdates = array_map(function ($age) {
            return Carbon::now()->subYears($age)->format('Y-01-01');
        }, $request->input('person_ages'));

        $tableSession = new TableSession();
        $tableSession->TableID = $request->input('table_id');
        $tableSession->person_birthdates = json_encode($birthdates);
        $tableSession->Deluxe_menu = $request->input('extra_deluxe');

        $tableSession->save();

        return response()->json(['success' => true, 'message' => 'Tafel is succesvol geregristreerd']);
    }

    public function showCustomer($tableId)
    {
        $tableSession = TableSession::where('TableID', $tableId)->firstOrFail();

        if (!$tableSession) {
            return view('start')->with('error', 'Table not found.');
        }

        $tableSession->needsHelp = true;
        $tableSession->save();

        return view('table_sessions.customer', ['sessionId' => $tableSession->SessionID]);
    }

    public function resolveHelp($id)
    {
        $tableSession = TableSession::find($id);
        $tableSession->NeedsHelp = false;
        $tableSession->save();

        return view('table_sessions.index', ['tableSessions' => TableSession::all()]);
    }

    public function destroy($id)
    {
        $tableSession = TableSession::findOrFail($id);
        $tableSession->delete();

        return redirect()->route('tables')->with('success', 'Tafel sessie beëindigd.');
    }
}
