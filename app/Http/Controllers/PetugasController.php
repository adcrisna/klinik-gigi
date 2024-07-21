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


class PetugasController extends Controller
{
    public function index() {
        $title = 'Home';
        $today = date('Y-m-d');
        $payment = Order::where('status','Payment')->where('klinik_id',Auth::user()->klinik_id)->get();
        $booking = Order::whereDate('tanggal',$today)->where('status','Booked')
        ->where('klinik_id',Auth::user()->klinik_id)->get();
        return view('petugas.index', compact('title','booking','payment'));
    }
    public function booking() {
        $title = 'Booking';
        $today = date('Y-m-d');
        $booking = Order::whereDate('tanggal',$today)->where('status','Booked')
        ->where('klinik_id',Auth::user()->klinik_id)->get();
        $nextBooking = Order::whereDate('tanggal','>',$today)->where('status','Booked')
        ->where('klinik_id',Auth::user()->klinik_id)->get();
        return view('petugas.booking', compact('title','booking','nextBooking'));
    }
    public function konfirmasi($id) {
        DB::beginTransaction();
        try {
                $order = Order::find($id);
                $order->status = 'Checking';
                $order->save();

             DB::commit();
            \Session::flash('msg_success','Berhasil Melakukan Konfirmasi!');
            return Redirect::route('petugas.booking');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('petugas.booking');
        }
    }
    public function hapus($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Booking Berhasil Dihapus!');
            return Redirect::route('petugas.booking');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('petugas.booking');
        }
    }
    public function cancel(Request $request) {
        DB::beginTransaction();
        try {
                $order = Order::find($request->id);
                $order->catatan = $request->catatan;
                $order->status = 'Cancel';
                $order->save();

             DB::commit();
            \Session::flash('msg_success','Berhasil Melakukan Cancel!');
            return Redirect::route('petugas.booking');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('petugas.booking');
        }
    }
    public function payment() {
        $title = 'Payment';
        $payment = Order::where('status','Payment')->where('klinik_id',Auth::user()->klinik_id)->get();
        $selesai = Order::where('status','Selesai')->where('klinik_id',Auth::user()->klinik_id)->get();
        return view('petugas.payment', compact('title','payment','selesai'));
    }
    public function savePayment(Request $request) {
        DB::beginTransaction();
        try {
                $order = Order::find($request->id);
                $order->pembayaran = $request->pembayaran;
                $order->petugas_id = Auth::user()->id;
                $order->status = 'Selesai';
                $order->save();

             DB::commit();
            \Session::flash('msg_success','Berhasil Melakukan Payment!');
            return Redirect::route('petugas.payment');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('petugas.payment');
        }
    }
}
