<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan form input nomor WhatsApp.
     */
    public function showForm()
    {
        return view('profile.index');
    }

    /**
     * Kirim OTP ke WhatsApp menggunakan API Wablas.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors(['phone' => 'Nomor tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);

        // Simpan ke database
        OtpCode::create([
            'phone' => $request->phone,
            'code' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Format nomor menjadi internasional (62xxxx)
        $formattedPhone = preg_replace('/^0/', '62', $request->phone);

        // Kirim melalui Wablas API
        $response = Http::withToken(env('WABLAS_TOKEN'))->post('https://api.wablas.com/api/v2/send-message', [
            'phone' => $formattedPhone,
            'message' => "Kode OTP reset password Anda: $otp (berlaku 5 menit)",
            'secret' => false,
            'priority' => true,
        ]);

        if (!$response->successful()) {
            Log::error('Gagal kirim OTP via WA', ['response' => $response->json()]);
            return back()->withErrors(['phone' => 'Gagal mengirim OTP. Silakan coba lagi.']);
        }

        return redirect()->route('password.verifyOtp')->with([
            'phone' => $request->phone,
            'success' => 'Kode OTP telah dikirim ke WhatsApp Anda.',
        ]);
    }

    /**
     * Tampilkan form verifikasi OTP.
     */
    public function showVerifyOtpForm()
    {
        return view('auth.verify-otp');
    }

    /**
     * Verifikasi OTP dari user.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);

        $otpRecord = OtpCode::where('phone', $request->phone)
            ->where('code', $request->otp)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        // Simpan status verifikasi dalam session
        session(['verified_phone' => $request->phone]);

        return redirect()->route('password.reset.form');
    }

    /**
     * Tampilkan form reset password.
     */
    public function showResetForm()
    {
        if (!session()->has('verified_phone')) {
            return redirect()->route('password.request')->withErrors([
                'phone' => 'Silakan verifikasi OTP terlebih dahulu.',
            ]);
        }

        return view('auth.reset-password');
    }

    /**
     * Reset password user.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('phone', session('verified_phone'))->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors([
                'phone' => 'Pengguna tidak ditemukan.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('verified_phone');

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login kembali.');
    }
}
