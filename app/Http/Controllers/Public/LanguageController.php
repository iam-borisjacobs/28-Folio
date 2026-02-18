<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Language;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Check if the locale exists and is active
        $language = Language::where('code', $locale)->where('is_active', true)->first();

        if ($language) {
            Session::put('locale', $locale);
            app()->setLocale($locale);
        }

        return Redirect::back();
    }
}
