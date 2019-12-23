<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    protected $setting;

    public function __construct()
    {
        $this->setting = new Setting;
    }

    public function index()
    {
        return view("settings.views");
    }

    public function create(Request $request)
    {
        $setting = $this->setting->create([
            "user_id" => Auth::id(),
            "settings_name" => $request->settings_name,
            "config_data" => $request->config_data
        ]);
        if ($setting) {
            return response()->json([
                "status" => "ok",
                "message" => "Setting Saved !"
            ]);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Failed !"
        ]);
    }
}
