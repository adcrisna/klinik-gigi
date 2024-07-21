<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Klinik;
use App\Models\Order;
use DB;
use Auth;
use Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class IndexController extends Controller
{
    public function index() {
        $title = 'Home';
        $dokter = User::where('role','Dokter')->get();
        $pasien = User::where('role','Pasien')->get();
        $klinik = Klinik::all();
        return view('index', compact('title','dokter','pasien','klinik'));
    }
    public function about() {
        $title = 'About';
        $dokter = User::where('role','Dokter')->get();
        return view('about', compact('title','dokter'));
    }
    public function service() {
        $title = 'Service';
        $service = Service::all();
        return view('service', compact('title','service'));
    }
    function pdf($id)
    {
        $data= Order::find($id);
        $pdf = Pdf::loadView('pdf', compact('data'));
        return $pdf->stream();
    }
}
