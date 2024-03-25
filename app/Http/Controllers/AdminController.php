<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $dataUser = User::all();
        return view('admin.index', compact('dataUser'));
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminRegister()
    {
        return view('admin.admin_register');
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileStore(Request $request)
    {
        
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            // Xóa ảnh cũ trong thư mục để update ảnh mới
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'User Profile cập nhật thành công!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d)^[A-Za-z][A-Za-z\d]*$/',
        ]);

        //Match the Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password không đúng!");
        }

        //Check PasswordNew and CfPW
        elseif ($request->new_password != $request->new_password_confirmation) {
            return back()->with("error", "New Password không khớp!");
        }
        // Update new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Đổi mật khẩu thành công!");
    }



}