<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminsExportMapping;
use App\Exports\OperatorsExportMapping;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'email ini belum tersedia',
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi',
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('dashboard');
        }else {
            return redirect()->back()->withErrors(['Gagal login, silahkan cek dan coba lagi!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $data = User::where('role', '=', $request->role)->get();
        $password = substr($request->email, 0,4) . count($data)+1;
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password),
        ]);


        if ($request->role == 'admin') {
            return redirect()->route('admin.users.accounts.index')->with('success', 'Success add new admin accounts!');
        }elseif ($request->role == 'operator') {
            return redirect()->route('admin.users.operators')->with('success', 'Success add new operator accounts!');
        }
    }

    public function admin()
    {
        $admins = User::where('role', '=','admin')->get();
        return view('admin.admins', compact('admins'));
    }

    public function operator()
    {
        $operators = User::with('lendings')->where('role', '=','operator')->get();
        return view('admin.operators', compact('operators'));
    }

    public function export_admin() {
        return Excel::download(new AdminsExportMapping(), 'admin-accounts.xlsx');
    }

    public function export_operator() {
        return Excel::download(new OperatorsExportMapping(), 'operator-accounts.xlsx');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Success deleted account!');
    }

    public function reset($id)
    {
        $user = User::where('id',$id)->first();
        $data = User::where('role', '=', $user['role'])->get();
        $password = substr($user->email, 0,4) . count($data);
        $userCreate = $user;
        $user->delete();
        User::create([
            'name' => $userCreate['name'],
            'email' => $userCreate['email'],
            'role' => $userCreate['role'],
            'password' => Hash::make($password),
            'status' => 'original',
        ]);
        return redirect()->back()->with('success', 'Success reset password to 4 character in email and nomor');
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('edit-account', compact('data'));
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);

        $user = User::where('id', $id)->first();

        if (!$request->password) {
            $password = $user['password'];
        }else {
            $password = Hash::make($request->password);
        }

        if (!$request->password) {
            $status = $user['status'];
        }else {
            $data = User::where('role', '=', Auth::user()->role)->get();
            $passwordOri = substr($request->email, 0,4) . count($data)+1;
            if ($request->password == $passwordOri) {
                $status = 'original';
            }else {
                $status = 'edited';
            }
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'status' => $status,
        ]);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.users.accounts.index')->with('success', 'Success update admin accounts!');
        }elseif (Auth::user()->role == 'operator') {
            return redirect()->route('dashboard')->with('success', 'Success update operator accounts!');
        }
    }
}
