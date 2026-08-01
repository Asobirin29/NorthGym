<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MemberProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    /**
     * Display progress history
     */
    public function index()
    {
        $progressRecords = Auth::user()->memberProgress()
            ->latest('tanggal')
            ->paginate(10);

        return view('member.progress.index', compact('progressRecords'));
    }

    /**
     * Show progress input form
     */
    public function create()
    {
        $latestProgress = Auth::user()->getLatestProgress();

        return view('member.progress.create', compact('latestProgress'));
    }

    /**
     * Store new progress record
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berat_badan' => 'nullable|numeric|min:0|max:500',
            'tinggi_badan' => 'nullable|numeric|min:0|max:300',
            'lingkar_perut' => 'nullable|numeric|min:0|max:300',
            'lingkar_dada' => 'nullable|numeric|min:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|min:0|max:100',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass_percentage' => 'nullable|numeric|min:0|max:100',
            'water_percentage' => 'nullable|numeric|min:0|max:100',
            'foto_before' => 'nullable|image|max:5120',
            'foto_after' => 'nullable|image|max:5120',
            'catatan' => 'nullable|string|max:1000',
            'workout_type_id' => 'nullable|exists:workout_types,id',
            'custom_workout_type_id' => 'nullable|exists:custom_workout_types,id',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_perut' => $request->lingkar_perut,
            'lingkar_dada' => $request->lingkar_dada,
            'lingkar_lengan' => $request->lingkar_lengan,
            'body_fat_percentage' => $request->body_fat_percentage,
            'muscle_mass_percentage' => $request->muscle_mass_percentage,
            'water_percentage' => $request->water_percentage,
            'catatan' => $request->catatan,
            'workout_type_id' => $request->workout_type_id,
            'custom_workout_type_id' => $request->custom_workout_type_id,
        ];

        if ($request->hasFile('foto_before')) {
            $data['foto_before_path'] = $request->file('foto_before')->store('progress', 'public');
        }

        if ($request->hasFile('foto_after')) {
            $data['foto_after_path'] = $request->file('foto_after')->store('progress', 'public');
        }

        // Check if record already exists for this date
        $existing = MemberProgress::where('user_id', Auth::id())
            ->where('tanggal', $request->tanggal)
            ->first();

        if ($existing) {
            $existing->update($data);
            $message = 'Progress berhasil diperbarui!';
        } else {
            MemberProgress::create($data);
            $message = 'Progress berhasil disimpan!';
        }

        return redirect()->route('member.progress.index')
            ->with('success', $message);
    }

    /**
     * Show edit form for existing progress
     */
    public function edit(MemberProgress $progress)
    {
        // Authorization: ensure user can only edit their own progress
        if ($progress->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $latestProgress = Auth::user()->getLatestProgress();

        return view('member.progress.edit', compact('progress', 'latestProgress'));
    }

    /**
     * Update existing progress record
     */
    public function update(Request $request, MemberProgress $progress)
    {
        // Authorization: ensure user can only update their own progress
        if ($progress->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'berat_badan' => 'nullable|numeric|min:0|max:500',
            'tinggi_badan' => 'nullable|numeric|min:0|max:300',
            'lingkar_perut' => 'nullable|numeric|min:0|max:300',
            'lingkar_dada' => 'nullable|numeric|min:0|max:300',
            'lingkar_lengan' => 'nullable|numeric|min:0|max:100',
            'foto_before' => 'nullable|image|max:5120',
            'foto_after' => 'nullable|image|max:5120',
            'catatan' => 'nullable|string|max:1000',
            'workout_type_id' => 'nullable|exists:workout_types,id',
            'custom_workout_type_id' => 'nullable|exists:custom_workout_types,id',
        ]);

        $data = [
            'tanggal' => $request->tanggal,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'lingkar_perut' => $request->lingkar_perut,
            'lingkar_dada' => $request->lingkar_dada,
            'lingkar_lengan' => $request->lingkar_lengan,
            'catatan' => $request->catatan,
            'workout_type_id' => $request->workout_type_id,
            'custom_workout_type_id' => $request->custom_workout_type_id,
        ];

        if ($request->hasFile('foto_before')) {
            // Delete old file if exists
            if ($progress->foto_before_path) {
                Storage::disk('public')->delete($progress->foto_before_path);
            }
            $data['foto_before_path'] = $request->file('foto_before')->store('progress', 'public');
        }

        if ($request->hasFile('foto_after')) {
            // Delete old file if exists
            if ($progress->foto_after_path) {
                Storage::disk('public')->delete($progress->foto_after_path);
            }
            $data['foto_after_path'] = $request->file('foto_after')->store('progress', 'public');
        }

        $progress->update($data);

        return redirect()->route('member.progress.index')
            ->with('success', 'Progress berhasil diperbarui!');
    }

    /**
     * Soft delete progress record
     */
    public function destroy(MemberProgress $progress)
    {
        // Authorization: ensure user can only delete their own progress
        if ($progress->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $progress->delete(); // Soft delete

        return redirect()->route('member.progress.index')
            ->with('success', 'Progress berhasil dihapus!');
    }
}
