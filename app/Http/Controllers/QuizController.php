<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function getPertanyaanByQuizId($id)
    {
        // Cari quiz berdasarkan ID
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'message' => 'Quiz tidak ditemukan',
            ], 404); // Status HTTP 404 Not Found
        }

        // Ambil daftar pertanyaan
        $daftarPertanyaan = $quiz->daftar_pertanyaan ?? [];

        return response()->json([
            'id' => $quiz->id,
            'nama' => $quiz->nama,
            'daftar_pertanyaan' => $daftarPertanyaan,
        ], 200); // Status HTTP 200 OK
    }


    public function destroy($id)
    {
        try {
            $quiz = Quiz::findOrFail($id); // Cari kuis berdasarkan ID
            $quiz->delete(); // Hapus kuis
            return response()->json(['message' => 'Kuis berhasil dihapus'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kuis tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus kuis'], 500);
        }
    }
}
