<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Traits\ClientTrait;

class AccountController extends Controller
{
    use ClientTrait;

    public function diceLogin(Request $request)
    {
        $data = [
            'form_params' => [
                "a" => "Login",
                "Key" => env("DICE_APIKEY"),
                "Username" => $request->username,
                "Password" => $request->password
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        // return response()->json($response)->withCookie(cookie("user-cookies", $response->SessionCookie, 45000));
        return response()->json($response);
    }

    public function balances()
    {
        $data = [
            'form_params' => [
                "a" => "GetBalance",
                "s" => Cookie::get('user-cookies'),
                "Currency" => "doge",
                "Referrals" => 0,
                "Stats" => 0,
            ]
        ];
        $response = json_decode($this->postData($data));
        return response()->json($response);
    }

    public function getCurrentBalance()
    {
        $data = [
            'form_params' => [
                "a" => "GetBalances",
                "s" => Cookie::get('user-cookies'),
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }

    public function getDepositAddress(Request $request)
    {
        $data = [
            'form_params' => [
                "a" => "GetDepositAddress",
                "s" => $request->get("session"),
                "Currency" => "doge",
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }

    public function getDepositHistories(Request $request)
    {
        $data = [
            'form_params' => [
                "a" => "GetDeposits",
                "s" => $request->get("session"),
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }

    public function createWithdraw(Request $request)
    {
        $data = [
            'form_params' => [
                "a" => "Withdraw",
                "s" => Cookie::get('user-cookies'),
                "Amount" => $request->amount,
                "Address" => $request->address,
                "Totp" => $request->otp,
                "Currency" => "doge"
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }

    public function getWithdrawl()
    {
        $data = [
            'form_params' => [
                "a" => "GetWithdrawals",
                "s" => Cookie::get('user-cookies'),
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }

    public function getServerSeedHash()
    {
        $data = [
            'form_params' => [
                "a" => "GetServerSeedHash",
                "s" => Cookie::get('user-cookies'),
            ]
        ];
        $response = json_decode($this->postData($data)->getBody());
        return response()->json($response);
    }
}
