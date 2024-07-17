<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function changeTheme($themeName)
    {
        session(['theme' => $themeName]);
        return redirect()->back();
    }
}
