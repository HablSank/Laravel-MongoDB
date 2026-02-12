<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Buku (MongoDB)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 md:p-12">
    <div class="max-w-5xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <span>📚</span> Pencarian Buku (Index Publisher)
        </h2>

        <form action="/" method="GET" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Publisher</label>
                    <input type="text" name="publisher" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                           placeholder="Contoh: Doubleday" 
                           value="{{ $publisher ?? '' }}">
                </div>

                <div class="md:col-span-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" name="year" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                           placeholder="Contoh: 1993" 
                           value="{{ $year ?? '' }}">
                </div>

                <div class="md:col-span-3 flex items-end">
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span>🔍</span> Cari Buku
                    </button>
                </div>
            </div>
        </form>

        @if($publisher || $year)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-blue-700 text-sm">
                    Waktu Query: <span class="font-bold">{{ $time }} ms</span> <br>
                    Ditemukan: <span class="font-bold">{{ count($books) }}</span> buku
                </p>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Judul</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Penulis</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Publisher</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 text-gray-700">{{ $book['Title'] ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-600 italic text-sm">{{ $book['Authors'] ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ $book['Publisher'] ?? '-' }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ $book['Publish Date (Year)'] ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500 italic">
                                    Tidak ada buku ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
                <p class="text-gray-400">Silakan cari nama publisher untuk melihat data.</p>
            </div>
        @endif
    </div>
</body>
</html>