<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function changeLocale($locale)
    {
        app()->setLocale($locale);

        return redirect()->back(); // Vous pouvez rediriger vers la page précédente ou une autre page si nécessaire.
    }
}
