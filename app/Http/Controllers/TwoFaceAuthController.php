<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFaceAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = $googleAuthenticator->createSecret();
        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            auth()->user()->email, $secretCode, config("app.name")
        );
        session(["secret_code" => $secretCode]);
        return view("twoFaceAuth.getQrCode", compact("qrCodeUrl"));
    }

    public function enable(Request $request)
    {
        $this->validate($request, [
            "code" => "required|digits:6"
        ]);

        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = session("secret_code");

        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            return redirect("home")->with("error", "Invalid code");
        }

        $user = auth()->user();
        $user->secret_code = $secretCode;
        $user->save();

        return redirect("home")->with("status", "2FA enabled!");
    }

    public function disable()
    {
        $user = auth()->user();
        $user->secret_code = null;
        $user->save();
        return redirect("home")->with("status", "2FA disabled!");
    }
}
