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

class PasienController extends Controller
{
    public function index() {
        $title = 'Home';
        $dokter = User::where('role','Dokter')->get();
        $pasien = User::where('role','Pasien')->get();
        $klinik = Klinik::all();
        return view('pasien.index', compact('title','dokter','pasien','klinik'));
    }
    public function about() {
        $title = 'About';
        $dokter = User::where('role','Dokter')->get();
        return view('pasien.about', compact('title','dokter'));
    }
    public function service() {
        $title = 'Service';
        $service = Service::all();
        return view('pasien.service', compact('title','service'));
    }
    public function booking() {
        $title = 'Booking';
        $klinik = Klinik::all();
        $service = Service::all();
        return view('pasien.booking', compact('title', 'klinik','service'));
    }
    public function cekJam(Request $request) {
        $service = Service::where('id',$request->id)->first();
        // return $service;
        $result = $service->jam;
        return response()->json(['data'=> $result]);
    }

    public function cekBooking(Request $request) {
        if (empty($request->klinik)) {
            return response()->json(2);
        }
        if (empty($request->tanggal)) {
            return response()->json(3);
        }
        $order = Order::where('klinik_id',$request->klinik)
        ->where('tanggal',$request->tanggal)
        ->where('jam',$request->jam)->first();
        if (!empty($order)) {
            return response()->json(1);
        }else{
            return response()->json(0);
        }
    }
    public function order(Request $request) {
        // return $request;
        if (empty($request->klinik)) {
            \Session::flash('msg_error','Data Klinik Harus Diisi!');
            return Redirect::route('pasien.booking');
        }
        if (empty($request->tanggal)) {
            \Session::flash('msg_error','Data Tanggal Harus Diisi!');
            return Redirect::route('pasien.booking');
        }
        $order = Order::where('klinik_id',$request->klinik)
        ->where('tanggal',$request->tanggal)
        ->where('jam',$request->jam)->first();
        if (!empty($order)) {
            \Session::flash('msg_error','Maaf, Silahkan Pilih Tanggal atau Jam yang lain!');
            return Redirect::route('pasien.booking');
        }

        DB::beginTransaction();
        try {
                $order = new Order;
                $order->pasien_id = Auth::user()->id;
                $order->klinik_id = $request->klinik;
                $order->service_id = $request->service;
                $order->tanggal = $request->tanggal;
                $order->jam = $request->jam;
                $order->status = 'Booked';
                $order->save();

             DB::commit();
            \Session::flash('msg_success','Berhasil Melakukan Booking!');
            return Redirect::route('pasien.booking');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pasien.booking');
        }
    }
    public function history() {
        $title = 'History Booking';
        $order = Order::where('pasien_id', Auth::user()->id)->get();
        return view('pasien.history', compact('title', 'order'));
    }

    public function profile()
    {
        $title = 'Profile';
        $pasien = User::find(Auth::user()->id);
        return view('pasien.profile', compact('title','pasien'));
    }
    public function updateProfile(Request $request){
        // return $request;
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->nik = $request->nik;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->jenis_kelamin = $request->jenis_kelamin;
                    $user->tanggal_lahir = $request->tanggal_lahir;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->nik = $request->nik;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->jenis_kelamin = $request->jenis_kelamin;
                    $user->tanggal_lahir = $request->tanggal_lahir;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Pasien"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->nik = $request->nik;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->jenis_kelamin = $request->jenis_kelamin;
                    $user->tanggal_lahir = $request->tanggal_lahir;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Pasien"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->nik = $request->nik;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->jenis_kelamin = $request->jenis_kelamin;
                    $user->tanggal_lahir = $request->tanggal_lahir;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('pasien.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pasien.profile');
        }
    }
    public function deleteBooking($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Booking Berhasil Dihapus!');
            return Redirect::route('pasien.history');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pasien.history');
        }
    }
}
