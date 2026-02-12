<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input dari form
        $publisher = $request->input('publisher');
        $year = $request->input('year');

        // 2. Start hitung waktu
        $start = microtime(true);

        $books = [];
        
        // Cek kalau user mengisi minimal salah satu (Publisher atau Tahun)
        if ($publisher || $year) {
            
            // Inisialisasi Query
            $query = Book::query();

            // Kalau ada input Publisher, tambahkan filter Publisher
            if ($publisher) {
                $query->where('Publisher', $publisher);
            }

            // Kalau ada input Tahun, tambahkan filter Tahun
            if ($year) {
                // Cast ke (int) karena di database tahun tersimpan sebagai angka
                $query->where('Publish Date (Year)', (int) $year);
            }

            // Ambil data (Limit 20)
            $books = $query->take(20)->get();
        }

        $end = microtime(true);
        $time = number_format(($end - $start) * 1000, 2);

        // Kirim data balik ke view, jangan lupa kirim variabel $year juga
        return view('books', compact('books', 'time', 'publisher', 'year'));
    }
}