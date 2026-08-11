-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2026 pada 22.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_berita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi`, `id_kategori`, `id_user`, `tanggal`, `gambar`) VALUES
(6, 'The Last Jogo Bonito', 'Namun hari ini, banyak yang bertanya: apakah kita sedang menyaksikan the last jogo bonito?\r\nJogo bonito bukan sekadar gaya bermain. Ia adalah filosofi. Dribel bukan alat untuk melewati lawan semata, tetapi bentuk ekspresi. Umpan tumit, elastico, rabona—semua lahir bukan untuk viral, melainkan karena begitulah cara tubuh dan imajinasi berbicara. Dalam jogo bonito, kemenangan penting, tetapi keindahan adalah kehormatan.\r\n\r\nNama-nama seperti Pelé, Garrincha, Zico, Romário, Ronaldinho, dan Ronaldo Nazário menjadi penjaga warisan ini. Mereka bermain seolah gravitasi tak berlaku. Garrincha menggiring bola ke arah yang sama berulang kali, dan lawan tetap tak mampu menghentikannya. Ronaldinho tersenyum sebelum memberi umpan yang mustahil. Mereka bukan hanya atlet; mereka seniman.\r\n\r\nLalu datanglah era modern.\r\n\r\nSepak bola berubah menjadi sains. Expected goals, high press, low block, dan algoritma perekrutan mendikte keputusan. Akademi membentuk pemain sejak usia dini agar “efisien”, “disiplin posisi”, dan “minim risiko”. Dribel yang gagal tak lagi dianggap keberanian, melainkan kesalahan. Senyum diganti fokus. Kebebasan diganti struktur.\r\n\r\nBrasil pun ikut berubah. Setelah kekalahan menyakitkan dan tekanan global, mereka mulai mengejar hasil dengan cara Eropa. Lebih rapi, lebih kuat, lebih cepat—tetapi sering kali terasa kurang liar. Seolah ada kesepakatan tak tertulis: lebih baik menang dengan aman daripada kalah dengan indah.\r\n\r\nNamun jogo bonito tidak benar-benar mati. Ia bersembunyi.', 1, 1, '2025-11-27', 'img_6928176773174.jpg'),
(7, 'Arsenal Champion League', 'Arsenal sedang puncaki Klasemen Liga Inggris dan Liga Champions. Legenda klub, Thierry Henry bilang ada yang beda dari The Gunners di musim ini. Apa tuh?\r\nTeranyar, Arsenal menang 3-1 atas Bayern Munich di matchday kelima Liga Champions, Kamis (27/11) dini hari WIB. Tiga gol dibagi rata oleh Timber, Madueke, dan Martinelli. Tim tamu cuma balas sekali lewat Karl. Atas hasil itu, Arsenal masih memuncaki Klasemen Liga Champions. Meriam London sempurna dengan 15 poin, sapu bersih lima laga awal dengan kemenangan', 1, 1, '2025-11-27', 'img_69281e8f66b93.avif'),
(8, 'Penutup Musim MotoGP 2025 (GP Valencia)', 'Sirkuit Ricardo Tormo kembali menjadi saksi akhir perjalanan MotoGP. GP Valencia 2025 bukan sekadar balapan terakhir, melainkan titik di mana semua kerja keras, kesalahan, dan keberanian sepanjang musim dipertaruhkan dalam satu hari.\r\n\r\nMusim 2025 berjalan dengan intensitas tinggi. Teknologi semakin canggih, persaingan makin rapat, dan jarak antara menang dan gagal terasa semakin tipis. Valencia datang sebagai pengingat bahwa pada akhirnya, MotoGP tetap tentang manusia di atas mesin—tentang keputusan sepersekian detik dan keberanian membuka gas di momen krusial.\r\n\r\nBagi sebagian pembalap, Valencia adalah panggung pengaman hasil. Bagi yang lain, ini adalah kesempatan terakhir untuk membalikkan keadaan. Tidak ada ruang untuk menunggu. Setiap tikungan menuntut fokus penuh, karena satu kesalahan kecil bisa menghapus satu musim penuh kerja keras.\r\n\r\nGP Valencia 2025 juga menegaskan perubahan generasi. Pembalap muda tampil tanpa rasa takut, sementara nama-nama besar mengandalkan pengalaman dan ketenangan. Pertemuan dua pendekatan itu membuat balapan terakhir terasa padat makna—cepat, tegang, dan jujur.\r\n\r\nSaat bendera finis dikibarkan, musim pun resmi berakhir. Ada yang merayakan, ada yang merenung, tetapi semua meninggalkan lintasan dengan satu kepastian: MotoGP 2025 telah memberi segalanya. Dan seperti biasa, ketika satu musim ditutup di Valencia, cerita baru sudah mulai menunggu di musim berikutnya.', 1, 1, '2025-11-27', 'img_69281f0ccfb90.jpg'),
(9, 'Babak Baru Gejolak PBNU, Elite Saling Klaim Kendali di Organisasi', 'Pucuk kepemimpinan Pengurus Besar Nahdlatul Ulama  (PBNU) bergejolak. Kursi kepemimpinan Yahya Cholil Staquf alias Gus Yahya terguncang. Eskalasi konflik internal PBNU kini memasuki tahap saling klaim antarsesama elite PBNU yang berkecamuk.\r\nTeranyar, beredar surat edaran yang menyatakan Gus Yahya tidak lagi menjabat sebagai Ketum PBNU per 26 November 2025 kemarin. Dalam surat edaran terbaru disebut bahwa Rais Aam memegang penuh kendali PBNU di tengah kekosongan ketua umum. Surat edaran terbaru PBNU bercap tanda tangan elektronik Wakil Rais Aam Afifuddin Muhajir dan Katib Ahmad Tajul Mafakhir, Nomor: 4785/PB.02/A.II.10.01/99/11/202, Tentang Tindak Lanjut Keputusan Rapat Harian Syuriyah, 20 November 2025.\r\n', 4, 1, '2025-11-27', 'img_692820c13682f.jpeg'),
(10, 'Mulai Terkuak! PSSI Wawancara 5 Calon Pelatih Timnas Indonesia di Spanyol Sampai Inggris, 1 Kandidat dari Belanda', 'PSSI memasuki tahap penting dalam mencari pelatih baru Timnas Indonesia. Proses seleksi dilakukan di Eropa dengan lima nama yang diwawancarai. Wakil Ketua Umum (Waketum) PSSI, Zainudin Amali, memberikan petunjuk baru terkait asal salah satu kandidat. Ia menyebut bahwa salah satu pelatih yang masuk daftar berasal dari Belanda.\r\nInformasi itu ia sampaikan ketika hadir di sesi latihan Timnas Indonesia U-22 di Stadion Madya, Senayan, Jakarta Pusat. Kunjungan dilakukan pada Rabu (26/11/2025) sebagai bagian dari pengecekan persiapan Garuda Muda.', 1, 1, '2025-11-27', 'img_692821329579a.jpg'),
(11, 'Siaga Nataru 2026, Wadirut Pertamina Tinjau Integrated Terminal DKI  ', 'Wakil Direktur Utama PT Pertamina (Persero), Oki Muraza mengadakan peninjauan ke Integrated Terminal Jakarta guna memastikan kesiapan stok bahan bakar minyak (BBM) jelang masa Satuan Tugas Natal 2025 dan Tahun Baru 2026 (Satgas Nataru) pada Rabu (26/11).\r\nSaat ini, Manajemen Pertamina Persero bersama Pertamina Patra Niaga telah mulai melakukan pengecekan ke berbagai daerah untuk memastikan kesiapan pasokan energi nasional. Integrated Terminal Jakarta bertugas memasok produk BBM di wilayah Jabodetabek, dan produk Pertamax Turbo yang lalu didistribusikan ke Provinsi DKI Jakarta, Jawa Barat dan Banten.', 2, 1, '2025-11-27', 'img_6928216dea2e1.jpeg'),
(12, 'Investasi Emas Vs Perak, Kamu Pilih yang Mana? ', 'Investasi merupakan strategi keuangan yang dapat menjaga dana dari penurunan nilai karena inflasi. Investasi pada instrumen emas maupun perak menguntungkan. Namun, keduanya juga memiliki perbedaan khas. Dalam beberapa tahun terakhir bisa dibilang menjadi tahun yang gemilang bagi investor emas. Harga-nya beberapa kali menembus rekor sepanjang masa. Emas menjadi salah satu aset hedging atau lindung nilai untuk disimpan jangka panjang sebagai safe haven.\r\n', 2, 1, '2025-11-27', 'img_692821ba624bd.jpeg'),
(13, 'Purbaya Bakal Kenakan Pajak Ekspor Batu Bara Tahun Depan', 'Menteri Keuangan (Menkeu) Purbaya Yudhi Sadewa memberi sinyal akan mengenakan pajak ekspor alias bea keluar batu bara mulai 2026. Hal ini dilakukan meski banyak protes dari para pengusaha. Purbaya menganggap wajar jika banyak pengusaha menyatakan penolakan. Tapi, Bendahara Negara mengatakan bahwa kontribusi royalti sektor batu bara lebih rendah dibanding komoditas lain seperti minyak dan gas. \"Semua perusahaan batu bara pasti menolak dikasih tarif. Sebagian dari kita melihat dibanding barang tambang yang lain, misalnya minyak. Kan batu bara lebih sedikit yang dibayar ke pemerintah. Royaltinya berapa persen sih?,\" sebut Purbaya di Kantor Kementerian Koordinator Perekonomian, Jakarta, Rabu (26/11/2025).\r\n\r\n', 4, 1, '2025-11-27', 'img_6928222ebb627.jpeg'),
(14, 'ESDM Bilang Sudah Sepakat BBM dari Pertamina, Shell Langsung Buka Suara  ', 'Kementerian Energi dan Sumber Daya Mineral (ESDM) menyampaikan kabar terbaru negosiasi pembelian base fuel atau bahan bakar murni oleh Shell dari Pertamina. Menurut Wakil Menteri (Wamen) ESDM Yuliot Tanjung Kementerian ESDM menyebut Shell dan Pertamina sudah sepakat soal pasokan BBM.\r\nSelanjutnya akan dikirim 100 ribu barel BBM dari Pertamina. Namun, menurut pihak Shell, negosiasi baru memasuki tahap akhir', 2, 1, '2025-11-27', 'img_6928227405f5c.jpeg'),
(15, 'Noni Madueke Membungkam Kritik  Baca artikel sepakbola', 'Noni Madueke cetak gol dalam kemenangan Arsenal atas Bayern Munich. Sang winger mau membungkam tiap kritikan!\r\nArsenal menang 3-1 atas Bayern Munich di matchday kelima Liga Champions, Kamis (27/11) dini hari WIB. Tiga gol dibagi rata oleh Timber, Madueke, dan Martinelli. Tim tamu cuma balas sekali lewat Karl. Atas hasil itu, Arsenal masih memuncaki Klasemen Liga Champions. Meriam London sempurna dengan 15 poin, sapu bersih lima laga awal dengan kemenangan!', 1, 1, '2025-11-27', 'img_692822a23d1e9.jpeg'),
(16, 'Liquid PH Menjuarai M7 Di Jakarta ', 'Team Liquid is a professional esports organization founded in the Netherlands in 2000. Originally a Brood War clan, the team switched to StarCraft II during the SC2 Beta in 2010, and became one of the most successful foreign teams. On May 21, 2024, it was announced that the team had acquired STUN.GG the owners of AURA Esports and ECHO.', 5, 1, '2026-01-15', 'img_696898933cc9d.png'),
(17, 'Guide Menggunakan Granger di Mobile Legends, Dijamin Auto Win!', 'Mau dapat bintang dengan mudah di Mobile Legends dan jadi ancaman yang ditakuti lawan di Land of Dawn? Kalau iya, kamu wajib banget mempelajari hero marksman andalan satu ini, yaitu Granger!\r\n\r\nDikenal sebagai Death Chanter, Granger bukan hanya menawan dengan gaya membasmi demon menggunakan biola sebagai senjata, tapi juga menjadi salah satu marksman burst yang sangat fleksibel—bisa di Gold Lane maupun Jungle, tergantung strategi tim kamu. Apalagi, dengan revamp terkini, mekanisme skill dan energy Granger semakin seru untuk dieksplorasi dan memiliki potensi carry yang jauh lebih besar di setiap fase permainan.\r\n\r\nDi panduan ini, kamu akan mendapatkan ulasan lengkap mulai dari pemaparan detail setiap skill Granger, rekomendasi item dan emblem terkuat 2025, penjelasan strategi makro-mikro, hingga tips farming dan taktik teamfight terkini agar kamu benar-benar bisa mendominasi pertandingan—bukan cuma main, tapi juga menang dengan gaya!\r\n\r\nYuk, langsung mulai petualanganmu, dan simak panduan ini sampai tuntas supaya auto win!\r\n\r\n', 5, 1, '2026-01-15', 'img_1768470386.jpeg'),
(18, 'Mau dapat bintang dengan mudah di Mobile Legends dan jadi ancaman yang ditakuti lawan di Land of Dawn? Kalau iya, kamu wajib banget mempelajari hero m', 'Timnas MLBB Women\'s Indonesia kembali menegaskan dominasi mereka di panggung esports dunia dengan kemenangan telak 3-0 atas Kamboja di babak Grand Final IESF World Esports Championship 2025. Pertandingan berlangsung di Quill City Mall, Kuala Lumpur, pada 6 Desember 2025 pukul 19.30 WIB, menjadi penutup sempurna dari perjalanan luar biasa para Srikandi Esports Indonesia sepanjang tahun ini.\r\n\r\nDengan kemenangan ini, Timnas MLBB Women’s Indonesia yang merupakan bagian dari Tim Vitality berhasil mempertahankan supremasi global mereka. Gelar ini melengkapi deretan prestasi sebelumnya:\r\n\r\nIESF World Esports Championship 2024 Riyadh\r\nAsian Esports Games 2024\r\nEsports World Cup 2025\r\nKonsistensi performa, strategi matang, kerja sama tim solid, dan mentalitas juara menjadikan tim ini semakin sulit ditandingi oleh pesaing manapun.', 5, 1, '2026-01-15', 'img_1768470454.jpg'),
(19, 'Hasil M7: Sengit Bak Partai Final, SRG Tumbangkan Team Liquid!', 'Pertarungan sarat dendam akhirnya mencapai klimaks di panggung M7 World Championship Mobile Legends: Bang Bang. Selangor Red Giants (SRG) sukses menghentikan laju impresif Team Liquid (TL) lewat kemenangan dramatis 2-1, sekaligus memupus rekor sempurna TL di Swiss Stage.\r\n\r\nSetelah selalu kalah dari Team Liquid di seluruh pertemuan sepanjang 2025, SRG membuktikan bahwa tidak ada tim yang benar-benar tak tersentuh. Reverse sweep ini bukan hanya kemenangan, tetapi juga pernyataan bahwa dominasi favorit juara bisa digoyahkan oleh determinasi dan eksekusi yang matang.\r\n\r\nMeski harus mengakui keunggulan TL di game pembuka, SRG sejatinya telah menunjukkan taringnya. Innocent mencatatkan momen ikonik dengan Savage menggunakan hero Sora, yang menjadi sinyal bahwa SRG siap memberikan perlawanan serius.\r\n\r\nMomentum itu benar-benar dimanfaatkan pada Game 2, di mana SRG langsung mengambil kendali sejak early game. Permainan agresif dan objektif yang rapi membuat Team Liquid tak diberi ruang untuk berkembang, memaksa skor menjadi imbang 1-1.\r\n\r\nGame Penentuan Penuh Tekanan, SRG Tetap Tenang\r\n\r\nPada Game 3, Team Liquid memperlihatkan ketahanan luar biasa. Pertahanan disiplin TL membuat SRG kesulitan menutup pertandingan dengan cepat, memunculkan duel tarik-ulur yang menegangkan.\r\n\r\nNamun, ketenangan menjadi pembeda. SRG tetap sabar menunggu celah, memanfaatkan setiap kesalahan kecil lawan, hingga akhirnya mengakhiri pertandingan tanpa kehilangan satu turret pun—sebuah penutup sempurna untuk comeback bersejarah mereka.\r\n\r\nSRG Lolos Knockout, Rekor TL Terhenti\r\n\r\nBerkat kemenangan ini, Selangor Red Giants resmi menjadi tim kedua yang mengamankan tiket ke Knockout Stage M7. Sementara itu, Team Liquid harus menerima berakhirnya rekor 10 kemenangan beruntun mereka di ajang ini.\r\n\r\nMeski kekalahan tersebut tidak sepenuhnya mematikan ambisi Golden Road Team Liquid, hasil ini menjadi pengingat keras bahwa status favorit tidak menjamin kemenangan mutlak di panggung tertinggi MLBB.\r\n\r\nPanggung M7 Kian Panas\r\n\r\nHasil ini semakin memanaskan persaingan M7 World Championship. Dengan SRG menunjukkan mental baja dan TL dipaksa mengevaluasi kembali konsistensi mereka, Swiss Stage terus menghadirkan narasi tak terduga yang membuat perebutan gelar juara dunia semakin sulit diprediksi.', 5, 1, '2026-01-15', 'img_1768470506.jpg'),
(20, 'ONIC Kritis di M7, Komunitas MLBB Tanah Air Bersatu Berikan Dukungan!', 'Narasi persatuan “We Rise as One” bukan sekadar tema di panggung M7 World Championship Mobile Legends: Bang Bang, melainkan benar-benar hidup di tengah komunitas MLBB Indonesia. Setelah Alter Ego Esports memastikan langkah ke Knockout Stage, fokus dukungan publik Tanah Air kini sepenuhnya mengarah kepada ONIC Esports, wakil Indonesia yang tengah berjuang di Swiss Stage.\r\n\r\nONIC kini berada dalam situasi krusial setelah menelan dua kekalahan beruntun—masing-masing dari Yangon Galacticos dan Team Spirit. Hasil tersebut menempatkan sang Raja Langit di pool 1-2, posisi yang membuat mereka berada di tepi jurang eliminasi. Satu kekalahan lagi akan mengakhiri perjalanan ONIC di M7.\r\n\r\nDengan target besar mengantarkan dua wakil Indonesia meraih prestasi terbaik di M7, komunitas MLBB Tanah Air mulai mengalihkan energi dukungan mereka kepada ONIC. Selain pembenahan internal dari sisi gameplay dan strategi, sokongan moral dinilai sangat penting agar para pemain dapat bangkit dari tekanan besar.\r\n\r\nAtmosfer dukungan ini terasa semakin nyata ketika sejumlah Key Opinion Leader (KOL) dan figur publik MLBB Indonesia secara terbuka menyuarakan dukungan mereka, mempertegas bahwa SANZ dkk tidak berjuang sendirian.', 5, 1, '2026-01-15', 'img_1768470547.jpeg'),
(21, 'Rupiah Kurang Darah Rp16.896 per Dolar AS Kamis Sore', 'Jakarta, CNN Indonesia -- Nilai tukar rupiah ditutup di level Rp16.896 per dolar AS pada Kamis (15/1) sore. Mata uang Garuda melemah 31 poin atau minus 0,18 persen dibandingkan penutupan perdagangan sebelumnya.\r\nSementara, kurs referensi Bank Indonesia (BI) Jakarta Interbank Spot Dollar Rate (Jisdor) menempatkan rupiah ke posisi Rp16.880 per dolar AS pada perdagangan sore ini.\r\n\r\nMata uang Asia bervariasi. Yuan China turun 0,06 persen, dolar Singapura turun 0,09 persen, peso Filipina melemah 0,15 persen, ringgit Malaysia plus 0,26 persen, won Korea Selatan naik 0,48 persen, yen Jepang naik 0,03 persen, dan baht Thailand naik 0,32 persen.\r\n\r\nDi negara maju, pergerakan nilai tukar juga bervariasi. Poundsterling Inggris stagnan, euro Eropa minus 0,05 persen, franc Swiss turun 0,04 persen, dolar Kanada naik 0,01 persen, dolar Australia melemah 0,07 persen.', 2, 1, '2026-01-15', 'img_1768470628.jpeg'),
(22, 'KPK Duga Petinggi PBNU Terima Aliran Uang Kasus Kuota Haji dari Biro Travel  ', 'Komisi Pemberantasan Korupsi (KPK) mengatakan, aliran uang kasus dugaan korupsi kuota haji 2024 yang diterima Ketua Bidang Ekonomi Pengurus Besar Nahdatul Ulama (PBNU) Aizzudin berasal dari biro travel haji atau Penyelenggara Ibadah Haji Khusus (PIHK). Juru Bicara KPK Budi Prasetyo mengatakan, penyidik menduga penerimaan uang tersebut untuk Aizzudin secara individu bukan PBNU. “Penerimaannya diduga masih untuk individu yang bersangkutan, yang pertama. Yang kedua, diduga penerimaannya dari para biro travel atau PIHK ya,” kata Budi di Gedung Merah Putih, Jakarta, Kamis (15/1/2026).\r\n', 4, 1, '2026-01-15', 'img_1768511510.jpeg'),
(23, 'Kala Prajurit TNI Ragu Ditanya Menhan Sjafrie: Pilih Pendidikan atau Tugas Operasi?  ', 'Seorang prajurit Batalyon Infanteri Teritorial Pembangunan 827/Mahakam Cakti Yudha sempat ragu-ragu saat Menteri Pertahanan Sjafrie Sjamsoeddin menanyakan pilihannya antara mengikuti pendidikan atau menjalani penugasan operasi. Momen ini terjadi saat Sjafrie menyalami para prajurit yang baru saja berdemonstrasi olahraga pencak silat sambil mengalungi medali yang mereka raih. Setelah memberikan hormat kepada Sjafrie, prajurit itu memperkenalkan diri dan mengungkapan asal daerah. \"Siap, (asal) Bima, Nusa Tenggara Barat,\" ucap prajurit tersebut sambil bersalaman dengan Sjafrie.\r\n', 4, 1, '2026-01-15', 'img_1768511577.jpg'),
(24, 'TNI Diusulkan Turun Tangan jika Teroris Bersenjata dan Polisi Tak Mampu Tangani ', 'Pengamat militer, Connie Rahakundini Bakrie, mengungkapkan bahwa TNI bisa turun tangan jika teroris telah bersenjata lengkap. Hal tersebut disampaikan Connie saat menanggapi Surat Presiden (Surpres) sebagai dasar pembahasan tentang peran TNI dalam penanggulangan terorisme. “Kapan TNI turun? Ya itu, misalnya ketika teroris itu sudah pada bersenjata berat, sudah terorganisir dengan baik, kemudian polisi sudah tidak bisa menangani,” kata Connie saat dihubungi Kompas.com, Jumat (9/1/2026). Rencana pelibatan TNI dalam penanggulangan terorisme dinilai harus didasarkan pada ancaman yang nyata. Keterlibatan TNI diusulkan sebagai opsi terakhir, bukan untuk menggantikan peran kepolisian di garda terdepan.\r\n\r\n“Kita harus berani ancaman. Jadi, bukan asumsi permanen. Kondisinya apa? Sehingga kemudian misalnya, ‘oh ternyata polisi atau aparat penegak hukum tidak lagi memadai kapasitasnya’,” kata Connie. Jika pelibatan TNI dalam kontra terorisme menjadi instrumen biasa, bukan luar biasa, justru berpotensi memunculkan berbagai ancaman serius. “Kembali lagi, inti kata bahasanya tidak boleh menjadi rutin. Karena fungsi pertahanan negara akan terdistorsi, reformasi sektor keamanan mundur, pasti itu sudah jelas ya kan, lalu pola hubungan sipil-militer juga akan balik ke wilayah abu-abu,” tambah dia. Guru Besar Hubungan Internasional di Saint Petersburg State University Rusia itu menekankan, jika TNI dilibatkan, maka sifatnya harus ad hoc atau sementara dengan batas waktu yang jelas dan mandat yang tegas. Pelibatan tersebut juga harus ditetapkan secara formal.\r\n', 4, 1, '2026-01-15', 'img_1768511660.png'),
(25, 'Rossi Targetkan VR46 Menang Balapan Lagi di MotoGP 2026  ', 'VR46 Racing Team sudah lama puasa kemenangan. Valentino Rossi, sang pemilik tim balap, menargetkan timnya agar meraih kemenangan lain di MotoGP 2026.\r\nMusim ini akan menandai tahun kelima VR46 berlaga di kejuaraan dunia balap motor kelas premier. Fabio Di Giannantonio dan Franco Morbidelli masih jadi pebalap andalan.\r\n\r\nJelang MotoGP 2026 yang akan bergulir mulai akhir Februari mendatang, VR46 menetapkan targetnya. Diggia dan Morbidelli dituntut untuk menambah koleksi kemenangan, yang terakhir kali didapat di grand prix India 2023.\r\n\r\nSejauh ini VR46 baru tiga kali memenangi balapan MotoGP, yang seluruhnya dipersembahkan mantan pebalapnya Marco Bezzecchi. Sejak menang di Buddh, tim satelit Ducati itu melakoni hampir 50 seri tanpa naik podium teratas.\r\n', 1, 1, '2026-01-15', 'img_1768511776.jpeg'),
(26, 'Hasil India Open 2026: Putri KW Menang Comeback, Lolos ke 8 Besar!  ', 'Putri Kusuma Wardani menang comeback atas Line Hojmark Kjaersfeldt di 16 besar India Open 2026. Putri KW lolos ke perempatfinal dan akan menantang An Se-young.\r\nBabak 16 besar BWF Super 750 India Open nomor tunggal putri mempertemukan Putri KW kontra Kjaersfeldt dari Denmark. Pertandingan digelar di court 1 Arena Indira Gandhi, Kamis (15/1/2026) sore WIB.\r\n\r\nDuel sengit tersaji di awal gim pertama hingga kedudukan sama kuat 6-6. Kjaersfeldt mulai lepas dari tekanan dan memasuki interval dengan keunggulan 11-7.Putri tertinggal 6 angka 9-15 dan 11-17 selepas interval. Kjaersfeldt mencapai game point dengan keunggulan 20-15.\r\n\r\nBola out dari Putri KW jadi poin terakhir sebelum memasuki gim kedua. Kjaersfeldt merebut gim pertama dengan keunggulan 21-15.\r\n\r\nKjaersfeldt kembali menunjukkan dominasinya di awal gim kedua hingga memimpin 4 angka 6-2. Putri KW mampu menyeimbangkan kedudukan menjadi 6-6 dan berbalik unggul 7-6.\r\n\r\nPutri KW mencapai interval kedua dengan keunggulan 11-8. Pebulutangkis berusia 23 tahun ini unggul 11 angka 19-8 dan memaksa duel ke rubber game dengan keunggulan 21-9.\r\n\r\nPutri tampil lebih baik di awal gim ketiga hingga unggul 6 angka 9-3. Jawara Korea Masters 2024 ini mencapai interval dengan keunggulan 11-4.\r\n\r\nKjaersfeldt mulai memperkecil ketertinggalan menjadi 3 angka 12-15 dan 13-17. Putri KW memasuki match point dengan keunggulan 20-14.\r\n\r\n4 Poin beruntun didapat Kjaersfeldt untuk memperpanjang napasnya di gim ketiga. Putri KW akhirnya menuntaskan duel dengan kemenangan 21-18 setelah bola lob Kjaersfeldt out dan jadi poin terakhir bagi wakil RI.\r\n\r\nKemenangan ini membawa Putri ke babak 8 besar India Open 2026. Putri akan menantang unggulan pertama An Se Young yang melaju usai menyingkirkan Huang Yu-hsun (Taiwan).\r\n', 1, 1, '2026-01-15', 'img_1768511897.jpeg'),
(27, 'Lanjutkan, Gyokeres!', 'Viktor Gyokeres bikin satu gol dan satu asis saat Arsenal mengatasi Chelsea di Piala Liga Inggris. Ini jadi momentum besar buat striker 27 tahun tersebut.\r\nPenampilan Gyokeres bersama Arsenal musim ini cukup disorot. Dibeli senilai 63,5 juta Euro dari Sporting untuk jadi solusi gol Arsenal, pemain internasional Swedia itu malah kurang bertaji.\r\n\r\nDi Premier League, ia baru mengoleksi lima gol dari 19 penampilan. Lima gol itu juga didapatkan dari empat laga saja, masing-masing melawan Leeds United, Nottingham Forest, Burnley, dan Everton.\r\n\r\nIni turut bikin kualitas Gyokeres di laga-laga besar dipertanyakan, sebab dampaknya saat melawan tim-tim kuat kurang terasa. Tapi torehan satu gol dan satu asis saat Arsenal mengatasi Chelsea 3-2 di leg pertama semifinal Piala Liga Inggris bisa menjadi momentum.\r\n', 1, 1, '2026-01-15', 'img_1768511972.jpeg'),
(28, 'Penantian Manis Lando Norris  ', 'Lando Norris menjadi juara dunia Formula 1 2025 usai finis ketiga di GP Abu Dhabi. Perjalanan naik turun sepanjang musim pun berbuah manis.\r\nDalam balapan pamungkas di Yas Marina Circuit, Minggu (7/12), Norris yang butuh finis tiga besar demi mengunci gelar berhasil menjalankan tugasnya dengan baik. Kemenangan yang diraih Max Verstappen jadi tak berarti banyak.\r\n\r\nTambahan 15 poin sudah cukup bagi Norris untuk finis di posisi teratas klasemen akhir dengan 423 poin, unggul dua poin saja dari Verstappen. Ia sukses menurunkan sang juara bertahan dari takhta yang sudah dikuasainya selama empat tahun.\r\n\r\nPerjalanan Norris menuju tangga juara jauh dari kata mulus. Ia harus bersaing dengan Oscar Piastri yang merupakan rekan setimnya sendiri. Sampai Agustus lalu, pebalap Australia itu memegang kendali dengan berada di puncak klasemen.\r\n\r\nTerlebih setelah insiden gagal finis di GP Belanda yang membuat Norris tertinggal 34 poin dari Piastri di klasemen dengan sembilan balapan sisa. Namun siapa sangka, Norris bangkit di sisa musim, bersamaan dengan penuruna performa Piastri.\r\n\r\nKlimaksnya saat Norris merebut puncak klasemen dari tangan Piastri usai meraih kemenangan di GP Meksiko Oktober lalu. Sejak itu, ia pun tak tergoyahkan dari posisi teratas. Meski kemudian datang Verstappen ikut bersaing usai mengalami kemajuan pesat di paruh kedua musim, namun itu semua sudah terlambat.\r\n\r\nNorris pun keluar sebagai juara dunia usai menyentuh garis finis di Abu Dhabi. Ia pun menuntaskan dahaga 17 tahun yang dirasakan McLaren sejak Lewis Hamilton menjadi juara bersama tim asal Woking tersebut.\r\n\r\n\"Keren sekali, gila sekali, sulit bagi saya untuk mengatakannya. Musim ini penuh pasang surut. Apakah sempurna? Tentu saja tidak, saya mengalami kesulitan dan keberuntungan. Menjadi juara dunia adalah soal konsistensi. Saya fokus pada diri sendiri,\" ujar Norris kepada Sky Sports.', 1, 1, '2026-01-15', 'img_1768512104.jpeg'),
(29, 'Rizky Ridho: Semoga Indonesia Juara Piala AFF dengan Herdman  ', 'Rizky Ridho berharap kehadiran John Herdman sebagai arsitek baru Timnas Indonesia bisa mengakhiri penantian panjang untuk meraih juara di Piala AFF 2026.\r\nDalam undian pada Kamis (15/1), Indonesia tergabung dalam Grup A Piala AFF 2026 bersama Vietnam, Singapura, Kamboja, dan Brunei/Timor Leste. Turnamen regional Asia Tenggara ini akan digelar pada 24 Juli - 26 Agustus mendatang.\r\n\r\nBagi Ridho, Piala AFF mendatang akan kembali menjadi tantangan bagi Indonesia yang terus mengusung gelar juara perdana. Bek Persija Jakarta itu meyakini bahwa perjalanan Indonesia tidak akan mudah, karena akan jumpa Vietnam di fase grup.\r\n\r\n', 1, 1, '2026-01-15', 'img_1768512184.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(3) NOT NULL,
  `kategori` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Olahraga'),
(2, 'Ekonomi'),
(4, 'Politik'),
(5, 'Gaming');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(3) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `user_name`, `password`, `level`, `status`) VALUES
(1, 'admin', '12345', 'admin', 'aktif'),
(2, 'editor', '12345', 'editor', 'aktif'),
(7, 'Falaah123', '123456', 'user', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
