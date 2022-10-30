<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Google2FaController extends Controller
{
    public function index()
    {
        $user           = Auth::User();  
        $google2fa      = app('pragmarx.google2fa');
        $NewSecretKey   = $google2fa->generateSecretKey();
        $SecretKey      = $user->secret->secret2Fa;

        $QR_Image = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->name,
            $SecretKey
        );

        $QRCode = QrCode::size(200)->generate($QR_Image);

        return view('master.auth.2fa.index',compact('QRCode','SecretKey'));
    }
}