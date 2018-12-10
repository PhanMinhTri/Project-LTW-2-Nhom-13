<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\AdminsResetPasswordNotification;

class Admins extends User
{
    protected $table ="admins";

      /**
     * gửi link khôi phục mật khẩu cho tài khoản Admin.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminsResetPasswordNotification($token));
    }
     public static $validators = array(
        'name'   => 'required|min:3',
        'address'   => 'required|min:3',
        'phone'   => 'required|min:3',
        'email'  => 'required|email|unique:admins',        
        'password'  => 'required|min:4|confirmed',
        'password_confirmation'  => 'required|min:4',
        'sltlevel'  => 'required'
        );
    public static $validators_edit = array(
        'name'   => 'required|min:3',
        'address'   => 'required|min:3',
        'phone'   => 'required|min:3',
        'email'  => 'required',        
        'sltlevel'  => 'required'
        );
    public static $validators_pass = array(
        'oldpassword'  => 'required',
        'password'  => 'required|min:4|confirmed',
        'password_confirmation'  => 'required|min:4',
        );

    public static $msg = array(
            'name.required'   => 'Vui lòng nhập họ tên',
            'oldpassword.required'   => 'Nhập mật khẩu cũ',
            'name.min'   => 'Vui lòng nhập họ tên lớn hơn 3 ký tự.',
            'email.required'  => 'Vui lòng nhập email',
            'email.email'  => 'Vui lòng nhập đúng email',
            'email.unique'  => 'Email đã tồn tại',
            'password.required'  => 'Vui lòng nhập mật khẩu',
            'password.confirmed'  => 'Mật khẩu không khớp',
            'password_confirmation.required'  => 'Vui lòng nhập lại mật khẩu',
            'sltlevel.required'  => 'Vui lòng chọn quyền cho tài khoản',
            'password.min'  => 'Mật khẩu phải lớn hơn 4 ký tự',
            'password_confirmation.min'  => 'Mật khẩu phải lớn hơn 4 ký tự'
        );
}
