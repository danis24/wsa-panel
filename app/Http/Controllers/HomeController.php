<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use PDF;

class HomeController extends Controller
{
    protected $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function generatePDF($id)
    {
        return PDF::loadHTML($this->resultHtml($id))->stream('download.pdf');
    }

    public function getResultRequest($id)
    {
        $results = "http://localhost:8002/results/".$id;
        $responses = $this->client->request("GET", $results);
        return json_decode($responses->getBody());
    }

    public function resultHtml($id)
    {
        $results = $this->getResultRequest($id);
        $output = "<h1>WEB SECURITY ANALYZER (WSA)</h1>";
        $output .= "<h3>Danis Yogaswara (1137050062)</h3><br>";
        $output .= "Target : ";
        $output .= "<br>OWASP ZAP<br><br>";
        $output .= "<style>
          .vuln {
            font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }

          .vuln td, .vuln th {
            border: 1px solid #ddd;
            padding: 8px;
            word-wrap:break-word
          }

          .vuln tr:nth-child(even){background-color: #f2f2f2;}

          .vuln tr:hover {background-color: #ddd;}

          .vuln th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #131633;
            color: white;
          }
          table{
            table-layout: fixed;
            }
          </style>";
        $output .= "<h3>Vulnerability Summary<h3>";
        $output .= "<table class='vuln'><thead><tr><th>Vulnerability Name</th><th width='20%'>Saverity</th></tr></thead><tbody>";
        foreach ($results as $key => $value) {
            $output .= "<tr><td>".$value->name."</td><td align='center'>".$value->risk."</td></tr>";
        }

        $output .= "</tbody></table>";
        foreach ($results as $key => $value) {
            $output .= "<p>Vulnerability Detail</p>";
            $output .= "<table class='vuln'>";
            $output .= "<tr><td width='20%'>Vulnerability Name :</td><td>".$value->name."</td></tr>";
            $output .= "<tr><td>Severity :</td><td>".$value->risk."</td></tr>";
            $output .= "<tr><td>Deskripsi :</td><td>".$value->description."</td></tr>";
            $output .= "<tr><td>Instances :</td><td>";
            foreach ($value->param as $k => $v) {
                $output .= "<font size='1'>".$v."</font>,";
            }
            $output .= "</td></tr>";
            $output .= "<tr><td>Solusi :</td><td>".$value->solution."</td></tr>";
            $output .= "<tr><td>Referensi :</td><td>".$value->reference."</td></tr>";
            $output .= "</table>";
            $output .= "<br><br>";
        }
        return $output;
    }
}
