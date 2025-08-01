<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan form input nomor WhatsApp.
     */
    public function showForm()
    {

        session()->forget(['otp_phase', 'otp_phone', 'verified_phone', 'show_modal', 'success']);
        session(['show_modal' => true]); // Aktifkan modal saat kembali ke halaman login
        return redirect()->route('login');
    }

    /**
     * Generate dan simpan OTP tanpa kirim via WhatsApp.
     */
    public function sendOtp(Request $request)
    {
    $request->validate([
        'phone' => ['required', 'regex:/^0[0-9]{9,}$/'],
    ]);

    $user = User::where('phone', $request->phone)->first();
    if (!$user) {
        return back()->withErrors(['phone' => 'Nomor tidak ditemukan.'])
        ->withInput()
        ->with('show_modal', true);
    }

    $otp = rand(100000, 999999);

    OtpCode::where('phone', $request->phone)->delete();

    OtpCode::create([
        'phone' => $request->phone,
        'code' => $otp,
        'expires_at' => Carbon::now()->addMinutes(5),
    ]);

    // Kirim OTP via Fonnte
    $curl = curl_init();
    $data = [
        'target' => preg_replace('/^0/', '62', $request->phone), // ubah 08xxx ke 628xxx
        'message' => "Kode OTP kamu: $otp\nBerlaku selama 5 menit."
    ];
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => [
            "Authorization: MffPge45te4R3vENLNPa" // GANTI
        ],
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    session([
    'otp_phase' => true,
    'otp_phone' => $request->phone,
    ]);

    return redirect()->route('login')
    ->with('success', 'Kode OTP dikirim...')
    ->with('otp_phase', true)
    ->with('otp_phone', $request->phone)
    ->with('show_modal', true);

    session([
    'otp_phase' => true,
    'otp_phone' => $request->phone,
    'show_modal' => true, // Supaya modal tetap terbuka
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
            'phone' => ['required', 'regex:/^0[0-9]{9,}$/'],
            'otp' => 'required|digits:6',
        ]);

        // Cek apakah nomor ada di tabel user
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors(['phone' => 'Nomor tidak ditemukan.'])
                ->withInput()
                ->with([
                    'otp_phase' => true,
                    'otp_phone' => $request->phone,
                    'show_modal' => true
                ]);
        }

        // validasi otp
        $otpRecord = OtpCode::where('phone', $request->phone)
            ->where('code', $request->otp)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.'])
            ->withInput()
            ->with([
            'otp_phase' => true,
            'otp_phone' => $request->phone,
            'show_modal' => true
            ]);
        }

        // Hapus OTP setelah verifikasi sukses
        $otpRecord->delete();

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

        return view('profile.reset-password');
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

        // Hapus semua session terkait OTP
        session()->forget(['verified_phone', 'otp_phase', 'otp_phone']);

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login kembali.');
    }
}
