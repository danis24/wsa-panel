<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ClientTrait;

class SettingController extends Controller
{
    use ClientTrait;

    protected $setting;

    public function __construct()
    {
        $this->setting = new Setting;
    }

    public function index()
    {
        return view("settings.views");
    }

    public function browse()
    {
        $settings = $this->setting->where("user_id", "=", Auth::id())->get();
        return response()->json($settings);
    }

    public function select($id)
    {
        $settings = $this->setting
            ->where("user_id", "=", Auth::id())
            ->where("id", "=", $id)
            ->first();
        return response()->json($settings);
    }

    public function create(Request $request)
    {
        $request->validate([
            "settings_name" => "required",
            "config_data" => "required"
        ]);
        $setting = $this->setting->create([
            "user_id" => Auth::id(),
            "settings_name" => $request->settings_name,
            "config_data" => $request->config_data
        ]);
        if ($setting) {
            return $this->message("ok", "Setting Saved !");
        }
        return $this->message("failed", "Setting Failed !");
    }

    public function delete($id)
    {
        $setting = $this->setting->destroy($id);
        if ($setting) {
            return $this->message("ok", "Delete Successfuly !");
        }
        return $this->message("failed", "Delete Failed !");
    }

    private function getLastRain()
    {
    }

    public function lastRain()
    {
        return $this->getData()->getBody();
        // return response()->json([
        //     "lastRain" => 120
        // ]);
    }

    private function message($status, $message)
    {
        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }
}
