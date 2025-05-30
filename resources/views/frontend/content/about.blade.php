{{-- resources/views/frontend/content/about.blade.php --}}

@extends('frontend.layout.main')

@section('title', 'Tentang Kami - Wingster')

@section('content')
    <style>
        /* Styling Umum untuk Halaman About dan Contact */
        .page-header {
            background-color: #f8f8f8;
            padding: 60px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5em;
            color: #333;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }
        .page-header p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2em;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .page-content-section {
            padding: 50px 20px;
            max-width: 960px; /* Lebar konten utama */
            margin: 0 auto;
            font-family: 'Open Sans', sans-serif;
            color: #444;
            line-height: 1.8;
        }
        .page-content-section h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2em;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }
        .page-content-section h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #FFD700;
            margin: 15px auto 0;
            border-radius: 2px;
        }
        .page-content-section p {
            margin-bottom: 20px;
            font-size: 1.1em;
        }
        .page-content-section ul {
            list-style: none; /* Hapus bullet default */
            padding: 0;
            margin-bottom: 20px;
        }
        .page-content-section ul li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
            font-size: 1.05em;
        }
        .page-content-section ul li::before {
            content: '\2713'; /* Tanda centang unicode */
            color: #4CAF50; /* Warna centang */
            position: absolute;
            left: 0;
            top: 0;
            font-weight: bold;
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.8em;
            }
            .page-header p {
                font-size: 1em;
            }
            .page-content-section h2 {
                font-size: 1.8em;
            }
            .page-content-section p, .page-content-section ul li {
                font-size: 1em;
            }
            .page-content-section {
                padding: 30px 15px;
            }
        }
    </style>

    <div class="page-header">
        <h1>Tentang Kami</h1>
        <p>Wingster berkomitmen untuk menyajikan pengalaman kuliner terbaik dengan cita rasa yang tak terlupakan.</p>
    </div>

    <div class="page-content-section">
        <h2>Kisah Wingster</h2>
        <p>Didirikan pada tahun 2023, Wingster berawal dari mimpi sederhana untuk menciptakan tempat di mana setiap gigitan adalah perayaan rasa. Kami percaya bahwa makanan bukan hanya tentang nutrisi, tetapi juga tentang kenangan, kebersamaan, dan kegembiraan. Dengan dedikasi terhadap kualitas dan inovasi, kami terus berupaya menghadirkan hidangan yang memuaskan selera dan hati.</p>

        <h2>Filosofi Kami</h2>
        <p>Di Wingster, kami berpegang teguh pada beberapa prinsip utama:</p>
        <ul>
            <li>Kualitas Bahan Baku: Kami hanya menggunakan bahan-bahan segar dan berkualitas tinggi yang bersumber dari pemasok terpercaya.</li>
            <li>Cita Rasa Autentik: Setiap resep kami dibuat dengan perhatian pada detail, memastikan cita rasa yang kaya dan autentik.</li>
            <li>Pelayanan Prima: Kepuasan pelanggan adalah prioritas kami. Tim kami terlatih untuk memberikan pelayanan yang ramah dan efisien.</li>
            <li>Inovasi Kuliner: Kami selalu bereksperimen dengan ide-ide baru untuk menghadirkan menu yang menarik dan tak terduga.</li>
        </ul>

        <h2>Tim Kami</h2>
        <p>Di balik setiap hidangan lezat dan senyum ramah, ada tim Wingster yang berdedikasi. Dari koki berpengalaman hingga staf pelayanan yang penuh perhatian, setiap anggota tim kami bekerja sama untuk menciptakan pengalaman bersantap yang luar biasa bagi Anda.</p>
        <p>Kami berharap Anda menikmati waktu Anda di Wingster dan menjadi bagian dari kisah kami!</p>
    </div>
@endsection
