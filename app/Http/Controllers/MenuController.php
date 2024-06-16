<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function show()
    {
        $menuImages = File::files(public_path('images/menu'));
        $activeImages = array_filter($menuImages, function ($image) {
            return strpos($image->getFilename(), 'active-') === 0;
        });

        return view('home.menu', ['images' => $activeImages]);
    }

    public function index()
    {
        $menuImages = File::files(public_path('images/menu'));
        $activeImages = array_filter($menuImages, function ($image) {
            return strpos($image->getFilename(), 'active-') === 0;
        });

        return view('menu.index', ['images' => $activeImages]);
    }

    public function createOrEdit()
    {
        $menuImages = File::files(public_path('images/menu'));
        $activeImages = array_filter($menuImages, function ($image) {
            return strpos($image->getFilename(), 'active-') === 0;
        });

        $imageUrls = array_values(array_map(function ($image) {
            return asset('images/menu/' . $image->getFilename());
        }, $activeImages));

        return view('menu.create_edit', [
            'currentImage1' => $imageUrls[0] ?? '',
            'currentImage2' => $imageUrls[1] ?? '',
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'image1.required' => 'Afbeelding 1 is verplicht.',
            'image1.image' => 'Afbeelding 1 moet een geldig afbeeldingsbestand zijn.',
            'image1.mimes' => 'Afbeelding 1 moet een bestandstype van jpeg, png, jpg, gif, svg zijn.',
            'image1.max' => 'Afbeelding 1 mag niet groter zijn dan 5120 kilobytes.',
            'image2.required' => 'Afbeelding 2 is verplicht.',
            'image2.image' => 'Afbeelding 2 moet een geldig afbeeldingsbestand zijn.',
            'image2.mimes' => 'Afbeelding 2 moet een bestandstype van jpeg, png, jpg, gif, svg zijn.',
            'image2.max' => 'Afbeelding 2 mag niet groter zijn dan 5120 kilobytes.',
        ]);

        // Delete current active images
        $menuImages = File::files(public_path('images/menu'));
        foreach ($menuImages as $image) {
            if (strpos($image->getFilename(), 'active-') === 0) {
                File::delete($image->getPathname());
            }
        }

        // Upload new images
        $image1Name = 'active-' . time() . '-1.' . $request->image1->extension();
        $image2Name = 'active-' . time() . '-2.' . $request->image2->extension();
        $request->image1->move(public_path('images/menu'), $image1Name);
        $request->image2->move(public_path('images/menu'), $image2Name);

        return response()->json(['message' => 'Afbeeldingen succesvol bijgewerkt.']);
    }
}

