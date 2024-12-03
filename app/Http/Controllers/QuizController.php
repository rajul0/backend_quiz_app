<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{



    public function index()
    {
        return Quiz::all(); // Mengembalikan semua kuis
    }

    /**
     * Membuat Quiz baru hanya dengan nama.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function buatKuis(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Buat quiz baru
        $quiz = Quiz::create([
            'nama' => $request->nama,
        ]);

        // Kembalikan respons dengan ID dan nama quiz
        return response()->json([
            'id' => $quiz->id,
            'nama' => $quiz->nama,
        ], 201); // Status HTTP 201 Created
    }

    /**
     * Menambahkan daftar pertanyaan ke Quiz yang ada.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tambahPertanyaan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'daftar_pertanyaan' => 'required|array',
            'daftar_pertanyaan.*.pertanyaan' => 'required|string',
            'daftar_pertanyaan.*.opsi' => 'required|array|min:1',
            'daftar_pertanyaan.*.jawaban' => 'required|string',
            'daftar_pertanyaan.*.jenis_pertanyaan' => 'required|string',
            'daftar_pertanyaan.*.nilai' => 'required|numeric|min:1',
            'daftar_pertanyaan.*.waktu_pertanyaan' => 'required|numeric|min:1',
        ]);

        // Cari quiz berdasarkan ID
        $quiz = Quiz::findOrFail($id);

        // Gabungkan pertanyaan baru dengan yang sudah ada (jika ada)
        $existingQuestions = $quiz->daftar_pertanyaan ?? [];
        $newQuestions = $request->daftar_pertanyaan;
        $updatedQuestions = array_merge($existingQuestions, $newQuestions);

        // Simpan pertanyaan yang diperbarui
        $quiz->update([
            'daftar_pertanyaan' => $updatedQuestions,
        ]);

        // Kembalikan respons
        return response()->json([
            'message' => 'Pertanyaan berhasil ditambahkan',
            'kuis' => $quiz,
        ], 200); // Status HTTP 200 OK
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(null, 204);
    }
}
