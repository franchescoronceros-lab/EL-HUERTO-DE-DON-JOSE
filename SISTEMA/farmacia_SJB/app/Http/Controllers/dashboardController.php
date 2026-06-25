<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;

class dashboardController extends Controller
{
    public function index()
    {
        $totalCategorias = Category::count();
        $totalClientes = Customer::count();
        $totalPlatos = Medicine::count();
        $totalPedidos = Sale::count();

        return view('dashboard.index', compact(
            'totalCategorias',
            'totalClientes',
            'totalPlatos',
            'totalPedidos'
        ));
    }
}