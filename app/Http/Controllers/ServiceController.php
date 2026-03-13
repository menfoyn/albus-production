<?php

namespace App\Http\Controllers;

use App\Models\ServicePageItem;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceItems = ServicePageItem::where('is_active', true)
                            ->orderBy('order')
                            ->get();

        return view('frontend.services', compact('serviceItems'));
    }
}
