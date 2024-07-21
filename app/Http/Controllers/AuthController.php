<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Redirect;
use DB;

class AuthController extends Controller
{
    public function login() {
        $title = 'Login';
        return view('login', compact('title'));
    }

    public function register() {
        $title = 'Register';
        return view('register', compact('title'));
    }

    public function prosesLogin(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if (Auth::User()->role == "Admin")
            {
                return \Redirect::to('/admin/home');
            }
            elseif (Auth::User()->role == "Dokter")
            {
                return \Redirect::to('/dokter/home');
            }
            elseif (Auth::User()->role == "Pasien")
            {
                return \Redirect::to('/pasien/home');
            }
            elseif (Auth::User()->role == "Petugas")
            {
                return \Redirect::to('/petugas/home');
            }
        }
        else
        {
            \Session::flash('msg_login','Email Atau Password Salah!');
            return \Redirect::to('/login');
        }
    }

    public function prosesRegister(Request $request) {
        DB::beginTransaction();
        try {
                $user = new User;

                // $namafoto = "Foto Pasien"."  ".$request->name." ".date("Y-m-d H-i-s");
                // $extention = $request->file('foto')->extension();
                // $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                // $destination = base_path() .'/public/foto';
                // $request->file('foto')->move($destination,$photo);

                $user->name = $request->name;
                $user->nik = $request->nik;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->alamat = $request->alamat;
                $user->no_hp = $request->no_hp;
                $user->jenis_kelamin = $request->jenis_kelamin;
                $user->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
                $user->foto = null;
                $user->role = 'Pasien';
                $user->klinik_id = null;
                $user->save();

             DB::commit();
            \Session::flash('msg_success','Register Berhasil!');
            return Redirect::route('login');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('register');
        }
    }

    public function logout(){
        Auth::logout();
      return \Redirect::to('/');
    }
}
