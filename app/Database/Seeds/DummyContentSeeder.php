<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyContentSeeder extends Seeder
{
    public function run()
    {
        // Artikel Dummy
        $articles = [
            ['title' => 'Pentingnya Asam Folat untuk Ibu Hamil', 'content' => 'Asam folat merupakan vitamin B9 yang sangat penting untuk perkembangan janin. Konsumsi asam folat sejak sebelum kehamilan dapat mencegah cacat tabung saraf pada bayi.', 'category' => 'Farmasi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Nutrisi Seimbang untuk Ibu Menyusui', 'content' => 'Ibu menyusui membutuhkan asupan nutrisi yang cukup untuk memproduksi ASI berkualitas. Konsumsi makanan bergizi seimbang dengan protein, karbohidrat, lemak sehat, vitamin dan mineral.', 'category' => 'Gizi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Persiapan Persalinan Normal', 'content' => 'Persalinan normal memerlukan persiapan fisik dan mental. Lakukan senam hamil, jaga pola makan, dan konsultasi rutin dengan bidan untuk memastikan kondisi ibu dan bayi sehat.', 'category' => 'Bidan', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Obat Aman untuk Ibu Hamil', 'content' => 'Tidak semua obat aman dikonsumsi saat hamil. Konsultasikan dengan apoteker atau dokter sebelum mengonsumsi obat apapun untuk menghindari risiko pada janin.', 'category' => 'Farmasi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Menu MPASI 6 Bulan Pertama', 'content' => 'MPASI dimulai saat bayi berusia 6 bulan. Berikan makanan bertekstur halus seperti bubur saring, pure buah dan sayur dengan nutrisi lengkap untuk tumbuh kembang optimal.', 'category' => 'Gizi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Tanda-tanda Persalinan Sudah Dekat', 'content' => 'Kenali tanda persalinan seperti kontraksi teratur, keluarnya lendir bercampur darah, dan pecahnya ketuban. Segera ke fasilitas kesehatan jika mengalami tanda-tanda tersebut.', 'category' => 'Bidan', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Vitamin untuk Ibu Hamil Trimester 1', 'content' => 'Trimester pertama kehamilan membutuhkan asupan vitamin seperti asam folat, vitamin B6, dan zat besi untuk mendukung perkembangan janin dan mencegah anemia pada ibu.', 'category' => 'Farmasi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Makanan Penambah ASI', 'content' => 'Beberapa makanan dapat membantu meningkatkan produksi ASI seperti daun katuk, kacang-kacangan, oatmeal, dan sayuran hijau. Konsumsi juga air putih yang cukup.', 'category' => 'Gizi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Perawatan Luka Jahitan Pasca Melahirkan', 'content' => 'Luka jahitan pasca melahirkan perlu perawatan khusus. Jaga kebersihan area luka, ganti pembalut secara rutin, dan hindari aktivitas berat hingga luka sembuh sempurna.', 'category' => 'Bidan', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
            ['title' => 'Imunisasi Lengkap untuk Bayi', 'content' => 'Imunisasi melindungi bayi dari berbagai penyakit berbahaya. Pastikan bayi mendapat imunisasi lengkap sesuai jadwal dari Hepatitis B, BCG, Polio, DPT hingga Campak.', 'category' => 'Farmasi', 'image' => 'default.jpg', 'author_id' => 1, 'author_name' => 'Admin', 'status' => 'approved'],
        ];

        foreach ($articles as $article) {
            $this->db->table('articles')->insert($article);
        }

        // FAQ Dummy
        $faqs = [
            ['pertanyaan' => 'Kapan waktu terbaik mengonsumsi vitamin ibu hamil?', 'jawaban' => 'Vitamin ibu hamil sebaiknya dikonsumsi setelah makan untuk mengurangi rasa mual. Konsumsi secara rutin setiap hari pada waktu yang sama.', 'category' => 'Farmasi'],
            ['pertanyaan' => 'Berapa banyak air yang harus diminum ibu hamil?', 'jawaban' => 'Ibu hamil disarankan minum minimal 8-10 gelas air putih per hari untuk menjaga hidrasi dan mendukung perkembangan janin.', 'category' => 'Gizi'],
            ['pertanyaan' => 'Apa yang harus dibawa saat persalinan?', 'jawaban' => 'Siapkan perlengkapan ibu (baju ganti, pembalut nifas, perlengkapan mandi) dan perlengkapan bayi (baju, popok, selimut). Jangan lupa dokumen penting seperti KTP dan buku KIA.', 'category' => 'Bidan'],
            ['pertanyaan' => 'Apakah ibu hamil boleh minum obat flu?', 'jawaban' => 'Tidak semua obat flu aman untuk ibu hamil. Konsultasikan dengan dokter atau apoteker untuk mendapat obat yang aman sesuai kondisi kehamilan.', 'category' => 'Farmasi'],
            ['pertanyaan' => 'Makanan apa yang harus dihindari ibu hamil?', 'jawaban' => 'Hindari makanan mentah atau setengah matang, makanan tinggi merkuri, kafein berlebihan, dan alkohol karena dapat membahayakan janin.', 'category' => 'Gizi'],
            ['pertanyaan' => 'Berapa kali pemeriksaan kehamilan yang ideal?', 'jawaban' => 'Minimal 4 kali pemeriksaan kehamilan: 1 kali di trimester 1, 1 kali di trimester 2, dan 2 kali di trimester 3. Namun lebih baik jika rutin setiap bulan.', 'category' => 'Bidan'],
            ['pertanyaan' => 'Apakah suplemen zat besi menyebabkan sembelit?', 'jawaban' => 'Suplemen zat besi dapat menyebabkan sembelit pada sebagian ibu hamil. Konsumsi banyak serat dan air putih untuk mengatasinya.', 'category' => 'Farmasi'],
            ['pertanyaan' => 'Kapan bayi mulai diberi MPASI?', 'jawaban' => 'MPASI diberikan saat bayi berusia 6 bulan. Sebelum usia tersebut, ASI eksklusif sudah mencukupi kebutuhan nutrisi bayi.', 'category' => 'Gizi'],
            ['pertanyaan' => 'Apa tanda bahaya saat hamil?', 'jawaban' => 'Tanda bahaya kehamilan meliputi perdarahan, sakit kepala hebat, pandangan kabur, bengkak mendadak, dan gerakan janin berkurang. Segera ke fasilitas kesehatan jika mengalaminya.', 'category' => 'Bidan'],
            ['pertanyaan' => 'Bagaimana cara menyimpan obat dengan benar?', 'jawaban' => 'Simpan obat di tempat sejuk, kering, terhindar dari sinar matahari langsung. Perhatikan tanggal kadaluarsa dan jauhkan dari jangkauan anak-anak.', 'category' => 'Farmasi'],
        ];

        foreach ($faqs as $faq) {
            $this->db->table('faqs')->insert($faq);
        }

        // Downloads Dummy
        $downloads = [
            ['title' => 'Panduan Gizi Ibu Hamil', 'category' => 'Edukasi', 'link_drive' => 'https://drive.google.com/file/d/example1', 'thumbnail' => 'default.jpg'],
            ['title' => 'Buku Saku Imunisasi', 'category' => 'Panduan', 'link_drive' => 'https://drive.google.com/file/d/example2', 'thumbnail' => 'default.jpg'],
            ['title' => 'Modul Perawatan Bayi Baru Lahir', 'category' => 'Edukasi', 'link_drive' => 'https://drive.google.com/file/d/example3', 'thumbnail' => 'default.jpg'],
            ['title' => 'Panduan ASI Eksklusif', 'category' => 'Panduan', 'link_drive' => 'https://drive.google.com/file/d/example4', 'thumbnail' => 'default.jpg'],
            ['title' => 'Materi Edukasi MPASI', 'category' => 'Edukasi', 'link_drive' => 'https://drive.google.com/file/d/example5', 'thumbnail' => 'default.jpg'],
            ['title' => 'Panduan Persalinan Normal', 'category' => 'Panduan', 'link_drive' => 'https://drive.google.com/file/d/example6', 'thumbnail' => 'default.jpg'],
            ['title' => 'Buku Kesehatan Ibu dan Anak', 'category' => 'Edukasi', 'link_drive' => 'https://drive.google.com/file/d/example7', 'thumbnail' => 'default.jpg'],
            ['title' => 'Panduan Kontrasepsi Pasca Melahirkan', 'category' => 'Panduan', 'link_drive' => 'https://drive.google.com/file/d/example8', 'thumbnail' => 'default.jpg'],
            ['title' => 'Modul Tumbuh Kembang Anak', 'category' => 'Edukasi', 'link_drive' => 'https://drive.google.com/file/d/example9', 'thumbnail' => 'default.jpg'],
            ['title' => 'Panduan Deteksi Dini Stunting', 'category' => 'Panduan', 'link_drive' => 'https://drive.google.com/file/d/example10', 'thumbnail' => 'default.jpg'],
        ];

        foreach ($downloads as $download) {
            $this->db->table('downloads')->insert($download);
        }
    }
}
