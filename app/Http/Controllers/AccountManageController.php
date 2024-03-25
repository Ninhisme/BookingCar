<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountManageController extends Controller
{

    public function ListUser()
    {
        $dataUser = User::all();
        return view('backend.users.users_list_view', compact('dataUser'));
    }

    public function EditUser($id)
    {
        $dataUser = User::find($id);
        return view('backend.users.users_edit_view', compact('dataUser'));
    }

    public function StoreUser(Request $request )
    {
        $user_id = $request->id;
        $data = User::find($user_id);

        $request->validate([
            'name' => 'required',
            'username' => 'required',
         ]);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->role = $request->role;
        $data->status = $request->status;

        $data->save();
        $notification = array(
            'message' => 'Sửa thông tin User thành công!',
            'alert-type' => 'success'
        );
        return redirect('/list/user')->with($notification);
    }


    public function DeleteUser($id)
    {
        $dataUser = User::findOrFail($id);
        $img = $dataUser->photo;
        if (file_exists($img)) {
            unlink($img);
        }

        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Xóa User thành công!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}