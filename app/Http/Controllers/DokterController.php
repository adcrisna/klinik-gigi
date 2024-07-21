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

class DokterController extends Controller
{
    public function index() {
        $title = 'Home';
        $perawatan = Order::where('status','Checking')->where('klinik_id',Auth::user()->klinik_id)->get();
        return view('dokter.index', compact('title','perawatan'));
    }

    public function perawatan() {
        $title = 'Perawatan';
        $perawatan = Order::where('status','Checking')->where('klinik_id',Auth::user()->klinik_id)->get();
        return view('dokter.perawatan', compact('title','perawatan'));
    }
    public function perawatanDetail($id) {
        $title = 'Perawatan Detail';
        $perawatan = Order::find($id);
        $lastPerawatan = Order::where('pasien_id',$perawatan->pasien_id)
        ->where('status','Selesai')->latest('tanggal')->first();
        return view('dokter.perawatan_detail', compact('title','perawatan','lastPerawatan'));
    }
    public function perawatanSelesai(Request $request) {
        DB::beginTransaction();
        try {
                $order = Order::find($request->id);
                $order->catatan = $request->catatan;
                $order->biaya = $request->biaya;
                $order->dokter_id = Auth::user()->id;
                $order->status = 'Payment';
                $order->save();

             DB::commit();
            \Session::flash('msg_success','Perawatan Berhasil!');
            return Redirect::route('dokter.perawatan');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('dokter.perawatan');
        }
    }
}
