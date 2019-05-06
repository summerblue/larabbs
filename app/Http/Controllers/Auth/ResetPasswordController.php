<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sendResetResponse(Request $request, $response)
    {
        session()->flash('success', '密码更新成功，您已成功登录！');
        return redirect($this->redirectPath());
    }
}
