<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Klinik;
use App\Models\Service;
use App\Models\Order;
use Redirect;
use DB;

class AdminController extends Controller
{
    public function index() {
        $title = "Home";
        $klinik = Klinik::all();
        return view('admin.index', compact('title','klinik'));
    }
    public function profile()
    {
        $title = 'Profile';
        $admin = User::find(Auth::user()->id);
        return view('admin.profile', compact('title','admin'));
    }
    public function updateProfile(Request $request){
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('admin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function klinik() {
        $title = "Data Klinik Cabang";
        $klinik = Klinik::all();
        return view('admin.klinik', compact('title','klinik'));
    }
    public function addKlinik(Request $request) {
        DB::beginTransaction();
        try {
                $klinik = new Klinik;
                $klinik->name = $request->name;
                $klinik->alamat = $request->alamat;
                $klinik->no_tlpn = $request->no_tlpn;
                $klinik->gmap = $request->gmap;
                $klinik->save();

             DB::commit();
            \Session::flash('msg_success','Klinik Berhasil Ditambah!');
            return Redirect::route('admin.klinik');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.klinik');
        }
    }
    public function updateKlinik(Request $request) {
        DB::beginTransaction();
        try {
                $klinik = Klinik::find($request->id);
                $klinik->name = $request->name;
                $klinik->alamat = $request->alamat;
                $klinik->no_tlpn = $request->no_tlpn;
                $klinik->gmap = $request->gmap;
                $klinik->save();

             DB::commit();
            \Session::flash('msg_success','Klinik Berhasil Diubah!');
            return Redirect::route('admin.klinik');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.klinik');
        }
    }
    public function deleteKlinik($id)
    {
        DB::beginTransaction();
        try {
            $klinik = Klinik::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Klinik Berhasil Dihapus!');
            return Redirect::route('admin.klinik');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.klinik');
        }
    }

    public function dokter() {
        $title = "Data Dokter";
        $klinik = Klinik::all();
        $dokter = User::where('role','Dokter')->get();
        return view('admin.dokter', compact('title','klinik','dokter'));
    }
    public function addDokter(Request $request) {
        DB::beginTransaction();
        try {
                $user = new User;

                $namafoto = "Foto Dokter"."  ".$request->name." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/foto';
                $request->file('foto')->move($destination,$photo);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->no_hp = $request->no_hp;
                $user->alamat = $request->alamat;
                $user->klinik_id = $request->klinik;
                $user->hari = $request->hari;
                $user->foto = $photo;
                $user->password = bcrypt($request->password);
                $user->role = 'Dokter';
                $user->save();

             DB::commit();
            \Session::flash('msg_success','Dokter Berhasil Ditambah!');
            return Redirect::route('admin.dokter');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.dokter');
        }
    }
    public function updateDokter(Request $request){
        // return $request;
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->hari = $request->hari;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->hari = $request->hari;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Dokter"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->hari = $request->hari;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Dokter"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->hari = $request->hari;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Dokter Berhasil Diubah!');
            return Redirect::route('admin.dokter');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.dokter');
        }
    }
    public function deleteDokter($id)
    {
        DB::beginTransaction();
        try {
            $cariDokter = User::find($id);
            \File::delete(public_path('foto/'.$cariDokter->foto));
            $dokter = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Dokter Berhasil Dihapus!');
            return Redirect::route('admin.dokter');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.dokter');
        }
    }
    public function petugas() {
        $title = "Data Petugas";
        $klinik = Klinik::all();
        $petugas = User::where('role','Petugas')->get();
        return view('admin.petugas', compact('title','klinik','petugas'));
    }
    public function addPetugas(Request $request) {
        DB::beginTransaction();
        try {
                $user = new User;

                $namafoto = "Foto Petugas"."  ".$request->name." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/foto';
                $request->file('foto')->move($destination,$photo);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->no_hp = $request->no_hp;
                $user->alamat = $request->alamat;
                $user->klinik_id = $request->klinik;
                $user->foto = $photo;
                $user->password = bcrypt($request->password);
                $user->role = 'Petugas';
                $user->save();

             DB::commit();
            \Session::flash('msg_success','Petugas Berhasil Ditambah!');
            return Redirect::route('admin.petugas');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.petugas');
        }
    }
    public function updatePetugas(Request $request){
        // return $request;
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Petugas"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto Petugas"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->klinik_id = $request->klinik;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Petugas Berhasil Diubah!');
            return Redirect::route('admin.petugas');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.petugas');
        }
    }
    public function deletePetugas($id)
    {
        DB::beginTransaction();
        try {
            $cariPetugas = User::find($id);
            \File::delete(public_path('foto/'.$cariPetugas->foto));
            $petugas = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Petugas Berhasil Dihapus!');
            return Redirect::route('admin.petugas');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.petugas');
        }
    }

    public function pasien() {
        $title = "Data Pasien";
        $pasien = User::where('role','Pasien')->get();
        return view('admin.pasien', compact('title','pasien'));
    }
    public function addPasien(Request $request) {
        DB::beginTransaction();
        try {
                $user = new User;

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
                $user->role = 'Pasien';
                $user->save();

             DB::commit();
            \Session::flash('msg_success','Pasien Berhasil Ditambah!');
            return Redirect::route('admin.pasien');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pasien');
        }
    }
    public function updatePasien(Request $request){
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
            \Session::flash('msg_success','Pasien Berhasil Diubah!');
            return Redirect::route('admin.pasien');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pasien');
        }
    }
    public function deletePasien($id)
    {
        DB::beginTransaction();
        try {
            $cariPasien = User::find($id);
            \File::delete(public_path('foto/'.$cariPasien->foto));
            $pasien = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Pasien Berhasil Dihapus!');
            return Redirect::route('admin.pasien');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pasien');
        }
    }

    public function service() {
        $title = "Data Service";
        $service = Service::all();
        return view('admin.service', compact('title','service'));
    }
    public function addService(Request $request) {
        DB::beginTransaction();
        try {
                $service = new Service;

                $namafoto = "Foto Service"."  ".$request->name." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/foto';
                $request->file('foto')->move($destination,$photo);

                $service->name = $request->name;
                $service->description = $request->description;
                $service->jam = $request->jam;
                $service->foto = $photo;
                $service->save();

             DB::commit();
            \Session::flash('msg_success','Service Berhasil Ditambah!');
            return Redirect::route('admin.service');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.service');
        }
    }
    public function updateService(Request $request) {
        DB::beginTransaction();
        try {
                if (empty($request->foto)) {
                    $service = Service::find($request->id);
                    $service->name = $request->name;
                    $service->description = $request->description;
                    $service->jam = $request->jam;
                    $service->save();
                } else {
                    $service = Service::find($request->id);

                    \File::delete(public_path('foto/'.$service->foto));

                    $namafoto = "Foto Service"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $service->name = $request->name;
                    $service->description = $request->description;
                    $service->jam = $request->jam;
                    $service->foto = $photo;
                    $service->save();
                }


             DB::commit();
            \Session::flash('msg_success','Service Berhasil Diubah!');
            return Redirect::route('admin.service');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.service');
        }
    }
    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $cariService = Service::find($id);
            \File::delete(public_path('foto/'.$cariService->foto));
            $service = Service::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Service Berhasil Dihapus!');
            return Redirect::route('admin.service');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.service');
        }
    }
    public function order() {
        $title = "Data Order";
        $order = Order::all();
        return view('admin.order', compact('title','order'));
    }
}
