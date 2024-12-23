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

    public function getQuizById($id)
    {
        // Cari quiz berdasarkan ID
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'message' => 'Quiz tidak ditemukan',
            ], 404); // Status HTTP 404 Not Found
        }

        return $quiz;

        // // Ambil daftar pertanyaan
        // $daftarPertanyaan = $quiz->daftar_pertanyaan ?? [];

        // return response()->json([
        //     'id' => $quiz->id,
        //     'nama' => $quiz->nama,
        //     'daftar_pertanyaan' => $daftarPertanyaan,
        // ], 200); // Status HTTP 200 OK
    }

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

    public function updateQuizTime(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Cari quiz berdasarkan ID
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        // Update waktu mulai dan selesai
        $quiz->update([
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        // Kembalikan respons dengan status "available"
        return response()->json([
            'message' => 'Quiz time updated successfully',
            'quiz' => [
                'id' => $quiz->id,
                'nama' => $quiz->nama,
                'start_time' => $quiz->start_time,
                'end_time' => $quiz->end_time,
                'available' => $quiz->available, // Ini menggunakan accessor otomatis
            ],
        ]);
    }

    public function deleteQuizTime($id)
    {
        // Cari kuis berdasarkan ID
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        // Hapus waktu mulai dan selesai
        $quiz->update([
            'start_time' => null,
            'end_time' => null,
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Quiz time deleted successfully',
            'quiz' => [
                'id' => $quiz->id,
                'nama' => $quiz->nama,
                'start_time' => $quiz->start_time,
                'end_time' => $quiz->end_time,
            ],
        ]);
    }


    /**
     * Mendapatkan kuis yang available berdasarkan ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableQuizById($id)
    {
        // Cek apakah kuis dengan ID tersebut tersedia
        $quiz = Quiz::find($id)->available()->first();

        if (!$quiz) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kuis tidak tersedia atau tidak ditemukan',
            ], 404);
        }

        return response()->json($quiz);
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
