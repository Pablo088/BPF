<?php

// app/Http/Controllers/MenuController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showMenu()
    {
        // Simulando una lista de opciones para el menú
        $menuItems = [
            'Home' => '/',
            'About Us' => '/about',
            'Services' => '/services',
            'Contact' => '/contact'
        ];

        // Pasar los datos a la vista
        return view('menu', compact('menuItems'));
    }
}

