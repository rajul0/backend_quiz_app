<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKuis;
use Illuminate\Http\Request;

class RiwayatKuisController extends Controller
{
    // Menampilkan semua riwayat kuis
    public function index()
    {
        $histories = RiwayatKuis::with('kuis', 'user')->get();
        return response()->json($histories);
    }

    // Menyimpan riwayat baru
    public function simpanRiwayatKuis(Request $request)
    {
        $validatedData = $request->validate([
            'id_kuis' => 'required|exists:kuis,id',
            'id_user' => 'required|exists:users,id',
            'nilai' => 'required|numeric|min:0',
        ]);

        $history = RiwayatKuis::create([
            'id_kuis' => $validatedData['id_kuis'],
            'id_user' => $validatedData['id_user'],
            'nilai' => $validatedData['nilai'],
            'attempt_date' => now(),
        ]);

        return response()->json([
            'message' => 'Quiz history saved successfully!',
            'data' => $history,
        ], 201);
    }

    // Menampilkan riwayat berdasarkan ID
    public function show($id)
    {
        $history = RiwayatKuis::with('kuis', 'user')->find($id);
        if (!$history) {
            return response()->json(['message' => 'History not found!'], 404);
        }

        return response()->json($history);
    }

    public function getQuizHistoryByKuis(Request $request)
    {
        $validatedData = $request->validate([
            'id_kuis' => 'required|exists:kuis,id',
        ]);

        // Ambil riwayat berdasarkan ID kuis
        $riwayatKuis = RiwayatKuis::where('id_kuis', $validatedData['id_kuis'])
            ->orderBy('attempt_date', 'desc') // Urutkan berdasarkan tanggal attempt terbaru
            ->get();

        if ($riwayatKuis->isEmpty()) {
            return response()->json(['message' => 'Belum ada riwayat untuk kuis ini.'], 404);
        }

        return response()->json($riwayatKuis, 200);
    }
    public function getQuizHistoryByUser(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required|exists:users,id',
        ]);

        // Ambil riwayat berdasarkan ID kuis
        $riwayatKuis = RiwayatKuis::where('id_user', $validatedData['id_user'])
            ->orderBy('attempt_date', 'desc') // Urutkan berdasarkan tanggal attempt terbaru
            ->get();

        if ($riwayatKuis->isEmpty()) {
            return response()->json(['message' => 'Belum ada riwayat untuk kuis ini.'], 404);
        }

        return response()->json($riwayatKuis, 200);
    }


    public function getQuizHistory(Request $request)
    {
        $validatedData = $request->validate([
            'id_kuis' => 'required|exists:kuis,id',
            'id_user' => 'required|exists:users,id',
        ]);

        // Retrieve the quiz history using the validated data
        $riwayatKuis = Riwayatkuis::where('id_kuis', $validatedData['id_kuis'])
            ->where('id_user', $validatedData['id_user'])
            ->get();

        if ($riwayatKuis->isEmpty()) {
            return response()->json(['message' => 'Belum pernah mengikuti kuis ini.'], 404);
        }

        return response()->json($riwayatKuis);
    }



    // Menghapus riwayat
    public function destroy($id)
    {
        $history = RiwayatKuis::find($id);
        if (!$history) {
            return response()->json(['message' => 'History not found!'], 404);
        }

        $history->delete();

        return response()->json(['message' => 'Quiz history deleted successfully!']);
    }
}
