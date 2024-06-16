<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GenerateDailySummary extends Command
{
    protected $signature = 'summary:daily';
    protected $description = 'Genereer een dagelijkse verkoopsamenvatting';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $orders = Order::with(['order_items.menu_item.dish'])->whereDate('OrderTime', Carbon::today())->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Bestel ID');
        $sheet->setCellValue('B1', 'Besteltijd');
        $sheet->setCellValue('C1', 'Totale Prijs');
        $sheet->setCellValue('D1', 'Gerecht Naam');
        $sheet->setCellValue('E1', 'Aantal');
        $sheet->setCellValue('F1', 'Item Prijs');

        $row = 2;
        foreach ($orders as $order) {
            foreach ($order->order_items as $item) {
                $sheet->setCellValue('A' . $row, $order->OrderID);
                $sheet->setCellValue('B' . $row, $order->OrderTime);
                $sheet->setCellValue('C' . $row, $order->TotalPrice);
                $sheet->setCellValue('D' . $row, $item->menu_item->dish->DishName);
                $sheet->setCellValue('E' . $row, $item->Quantity);
                $sheet->setCellValue('F' . $row, $item->ItemPrice);
                $row++;
            }
        }

        $currentDateTime = Carbon::now()->format('Y-m-d_H-i-s');
        \Log::info('Current DateTime: ' . $currentDateTime); // Log the current date and time
        $filename = 'dagelijkse_samenvatting_' . $currentDateTime . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/summaries/' . $filename));

        $this->info('Dagelijkse samenvatting succesvol gegenereerd!');
    }
}
