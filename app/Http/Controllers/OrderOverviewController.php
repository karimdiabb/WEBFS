<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

class OrderOverviewController extends Controller
{
    public function index()
    {
        $files = Storage::files('public/summaries');
        $summaries = array_filter($files, function ($file) {
            return strpos($file, 'dagelijkse_samenvatting_') !== false;
        });

        $gesorteerdeSamenvattingen = collect($summaries)->sortByDesc(function ($file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $datePart = str_replace('dagelijkse_samenvatting_', '', $filename);

            try {
                return Carbon::createFromFormat('Y-m-d_H-i-s', $datePart);
            } catch (\Exception $e) {
                \Log::error('Fout bij het parseren van de datum: ' . $datePart . ' - ' . $e->getMessage());
                return Carbon::now(); // fallback naar huidige datum als het parseren mislukt
            }
        });

        $groupedSummaries = $gesorteerdeSamenvattingen->groupBy(function ($file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $datePart = str_replace('dagelijkse_samenvatting_', '', $filename);

            try {
                return Carbon::createFromFormat('Y-m-d_H-i-s', $datePart)->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::error('Fout bij het parseren van de datum: ' . $datePart . ' - ' . $e->getMessage());
                return Carbon::now()->format('Y-m-d'); // fallback naar huidige datum als het parseren mislukt
            }
        });

        $newestSummary = $gesorteerdeSamenvattingen->first();

        return view('orders.order-overviews', [
            'groupedSummaries' => $groupedSummaries,
            'newestSummary' => $newestSummary
        ]);
    }

    public function download($filename)
    {
        return Storage::download('public/summaries/' . $filename);
    }

    public function generate(Request $request)
    {
        Artisan::call('schedule:run');
        return redirect()->route('order.overview')->with('success', 'Samenvatting succesvol gegenereerd!');
    }
}
