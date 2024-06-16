<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Discount;
use Barryvdh\DomPDF\ServiceProvider;
use Barryvdh\DomPDF\Facade\Pdf;

class MenuController extends Controller
{
    public function downloadPdf()
    {
        $menuItems = MenuItem::with('dish')->get();
        $discounts = Discount::with('dish')->get();

        $pdf = Pdf::loadView('menu.pdf', compact('menuItems', 'discounts'));

        return $pdf->download('menu.pdf');
    }
}
