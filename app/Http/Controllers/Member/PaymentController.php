<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display payment history
     */
    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->latest('created_at')
            ->paginate(10);

        return view('member.payment.index', compact('transactions'));
    }

    /**
     * Show payment form
     */
    public function create()
    {
        $user = Auth::user();
        $pendingTransaction = $user->transactions()
            ->where('status', 'pending')
            ->latest()
            ->first();

        // Fetch Active Packages
        $packages = \App\Models\MembershipPackage::active()
            ->orderBy('duration_months')
            ->get()
            ->keyBy('duration_months');

        // Fetch First Active Bank Detail
        $bankDetail = \App\Models\BankDetail::active()->first();
        
        $bankInfo = $bankDetail ? [
            'bank' => $bankDetail->bank_name,
            'account_number' => $bankDetail->account_number,
            'account_name' => $bankDetail->account_name,
        ] : [
            'bank' => 'Belum ada data',
            'account_number' => '-',
            'account_name' => '-',
        ];

        return view('member.payment.create', compact('user', 'pendingTransaction', 'packages', 'bankInfo'));
    }

    /**
     * Store new payment transaction
     */
    public function store(Request $request)
    {
        $request->validate([
            'durasi_bulan' => 'required|in:1,3,6,12',
            'bukti_transfer' => 'required|image|max:5120',
        ]);

        // Logic using DB
        $package = \App\Models\MembershipPackage::where('duration_months', $request->durasi_bulan)->firstOrFail();
        $nominal = (int) $package->discounted_price;

        // Store payment proof
        $buktiPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        // Create transaction
        Transaction::create([
            'user_id' => Auth::id(),
            'nominal' => $nominal,
            'bukti_transfer_path' => $buktiPath,
            'status' => 'pending',
            'tanggal_transaksi' => now(),
            'durasi_bulan' => $durasiBulan,
        ]);

        return redirect()->route('member.dashboard')
            ->with('success', 'Pembayaran berhasil disubmit! Silakan tunggu verifikasi dari admin.');
    }
}
