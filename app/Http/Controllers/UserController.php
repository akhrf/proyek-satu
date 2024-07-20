<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate(10);
        return view('admin.page.user', [
            'name'      => "User Management",
            'title'     => 'Admin User Management',
            'data'      => $data,
        ]);
    }

    public function addModalUser()
    {
        return view('admin.modal.modalUser', [
            'title' => 'Tambah Data User',
            'nik'   => date('Ymd') . rand(000, 999),
        ]);
    }
    public function store(UserRequest $request)
    {
        $data = new User;
        $data->nik          = $request->nik;
        $data->name         = $request->nama;
        $data->email        = $request->email;
        $data->password     = bcrypt($request->password);
        $data->alamat       = $request->alamat;
        $data->tglLahir     = $request->tglLahir;
        $data->is_member    = 0;
        $data->is_admin     = 1;

        // dd($request);die;
        $data->save();
        Alert::toast('Data berhasil disimpan', 'success');
        return redirect()->route('userManagement');
    }
    public function show($id)
    {
        $data = User::findOrFail($id);
        return view(
            'admin.modal.editUser',
            [
                'title' => 'Edit data User',
                'data'  => $data,
            ]
        )->render();
    }
    public function update(UserRequest $request, $id)
    {
        $data = User::findOrFail($id);

        $field = [
            'nik'                   => $request->nik,
            'name'                  => $request->nama,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'alamat'                => $request->alamat,
            'tglLahir'              => $request->tglLahir,
        ];

        $data::where('id', $id)->update($field);
        Alert::toast('Data berhasil diupdate', 'success');
        return redirect()->route('userManagement');
    }
    public function destroy($id)
    {
        $product = User::findOrFail($id);
        $product->delete();

        $json = [
            'success' => "Data berhasil dihapus"
        ];

        echo json_encode($json);
    }
    public function storePelanggan(UserRequest $request)
    {
        $data = new User;
        $nik  = "User" . rand(000, 999);
        $data->nik          = $nik;
        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->password     = bcrypt($request->password);
        $data->alamat       = $request->alamat;
        $data->tglLahir     = $request->date;
        $data->is_member    = 1;
        $data->is_admin     = 1;

        // dd($request);die;
        $data->save();
        Alert::toast('Data berhasil disimpan', 'success');
        return redirect()->route('home');
    }
    public function loginProses(Request $request)
    {
        $dataLogin = [
            'email' => $request->email,
            'password'  => $request->password,
        ];

        $user = new User;
        $proses = $user::where('email', $request->email)->first();

        if ($proses->is_active === 0) {
            Alert::toast('Kamu belum register', 'error');
            return back();
        }
        if (Auth::attempt($dataLogin)) {
            Alert::toast('Kamu berhasil login', 'success');
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            Alert::toast('Email dan Password salah', 'error');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::toast('Kamu berhasil Logout', 'success');
        return redirect('/');
    }
}
