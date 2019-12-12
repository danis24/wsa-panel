<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SettingController extends Controller
{
    public function index()
    {
        return view("settings.views");
    }
}
