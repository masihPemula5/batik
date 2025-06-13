<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batik Nusantara | Koleksi Eksklusif 2025</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* [TOTAL OVERHAUL] CSS UNTUK DESAIN BARU */
           :root {
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Manrope', sans-serif;
            --color-primary: #1a1a1a;
            --color-secondary: #B99767; /* Emas/Ochre Mewah */
            --color-bg: #FFFFFF;
            --color-light-gray: #f5f5f5;
            --color-text: #333;
        }

        /* Pengaturan Dasar & Kursor */
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-sans);
            margin: 0;
            background-color: var(--color-bg);
            color: var(--color-text);
            overflow-x: hidden;
        }
        .cursor { /* ... CSS Kursor tidak berubah ... */ }
        @media (max-width: 900px) { .cursor { display: none; } }

        /* Utility & Container */
        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }
        .section { padding: 100px 0; }

        /* --- 1. Navigasi Baru (DIPERBAIKI) --- */
        .navbar {
            background-color: transparent; padding: 30px 0; position: fixed;
            top: 0; left: 0; width: 100%; z-index: 1000;
            transition: background-color 0.3s ease, padding 0.3s ease;
        }
        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.9); padding: 20px 0;
            backdrop-filter: blur(10px); box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .navbar .container { display: flex; justify-content: space-between; align-items: center; }
        .nav-logo {
            font-family: var(--font-serif); font-size: 2em;
            color: var(--color-primary); text-decoration: none;
        }
        
        /* [BARU] Wrapper untuk ikon agar rapi */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 30px; /* Jarak antar ikon */
        }
        .nav-icons i {
            font-size: 1.5em;
            cursor: pointer;
            color: var(--color-primary);
        }

            /* --- 5. [DIUBAH] SEKSI TENTANG & KUALITAS --- */
        .about-quality-section {
            background-color: var(--color-light-gray);
        }
        .quality-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-top: 60px;
            text-align: center;
        }
        .quality-item .icon {
            font-size: 3em;
            color: var(--color-secondary);
            margin-bottom: 20px;
        }
        .quality-item h3 {
            font-family: var(--font-serif);
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .quality-item p {
            line-height: 1.7;
            color: #555;
        }
        /* --- 2. Hero Section Baru (Split Layout) --- */
        .hero { display: flex; align-items: center; height: 100vh; min-height: 700px; padding-top: 80px; }
        .hero-text { width: 50%; padding-right: 5%; }
        .hero-text h1 {
            font-family: var(--font-serif); font-size: clamp(3rem, 7vw, 6rem);
            line-height: 1.1; margin: 0 0 20px 0; color: var(--color-primary);
        }
        .hero-text p { font-size: 1.1rem; line-height: 1.8; max-width: 500px; margin-bottom: 30px; }
        .hero-image {
            width: 50%; height: 80vh;
            background-image: url('b.jpg');
            background-size: cover; background-position: top; border-radius: var(--border-radius);
        }
        .btn-hero {
            padding: 15px 35px; background-color: var(--color-primary);
            color: var(--color-bg); text-decoration: none; border-radius: 50px;
            font-weight: 500; transition: background-color 0.3s ease;
        }
        .btn-hero:hover { background-color: var(--color-secondary); }

        /* --- 3. Animasi "Reveal on Scroll" --- */
        .reveal-element { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal-element.is-visible { opacity: 1; transform: translateY(0); }

        /* --- 4. Product Section Baru --- */
        .section-title { font-family: var(--font-serif); font-size: clamp(2.5rem, 5vw, 4rem); text-align: center; margin-bottom: 60px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; }
        
        .product-card {
            text-decoration: none; color: inherit; display: block;
            border-radius: var(--border-radius); overflow: hidden; position: relative;
        }
        .product-card img { width: 100%; height: 450px; object-fit: cover; display: block; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .product-card:hover img { transform: scale(1.1); }
        .product-overlay {
            position: absolute; bottom: 0; left: 0; width: 100%; padding: 40px 20px 20px;
            color: var(--light-text-color, #fff); background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            transform: translateY(100%); transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .product-card:hover .product-overlay { transform: translateY(0); }
        .product-overlay h3 {
            font-family: var(--font-serif); font-size: 1.8em; margin: 0;
            transform: translateY(20px); transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.1s;
        }
        .product-overlay .price {
            font-size: 1.2em; margin: 5px 0 0 0;
            transform: translateY(20px); transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.2s;
        }
        .product-card:hover .product-overlay h3, .product-card:hover .product-overlay .price { transform: translateY(0); }
        .view-details-prompt {
            position: absolute; top: 20px; right: 20px; background-color: rgba(255,255,255,0.9);
            color: var(--color-primary); padding: 8px 15px; border-radius: 50px;
            font-size: 0.9em; font-weight: 500; opacity: 0; transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .product-card:hover .view-details-prompt { opacity: 1; transform: translateY(0); }
        
        /* --- 5. Banner Section --- */
        .promo-banner {
            height: 50vh; min-height: 400px; display: flex; align-items: center; justify-content: center;
            text-align: center; color: var(--light-text-color, #fff); background-color: var(--color-primary);
            background-image: url('https://www.batikain.com/wp-content/uploads/2021/08/Mencanting-Batik.jpg');
            background-size: cover; background-position: center; background-blend-mode: multiply;
        }
        .promo-banner h2 { font-family: var(--font-serif); font-size: clamp(2rem, 4vw, 3rem); }
        .promo-banner .btn-hero { margin-top: 20px; display: inline-block; background-color: var(--color-secondary); color: var(--color-primary); }

        /* --- 6. Modal (Quick View) --- */
        .modal-backdrop {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6); z-index: 2000; display: none;
            align-items: center; justify-content: center; opacity: 0;
            transition: opacity 0.3s ease; backdrop-filter: blur(5px);
        }
        .modal-backdrop.active { display: flex; opacity: 1; }
        .modal-content {
            background-color: var(--color-bg); border-radius: var(--border-radius);
            width: 90%; max-width: 800px; display: flex; max-height: 90vh;
            overflow: hidden; transform: scale(0.95); transition: transform 0.3s ease;
            position: relative;
        }
        .modal-backdrop.active .modal-content { transform: scale(1); }
        .modal-image { width: 50%; object-fit: cover; }
        .modal-details { width: 50%; padding: 40px; overflow-y: auto; }
        .modal-details h2 { text-align: left; font-family:var(--font-serif); font-size: 2.2em; margin-top:0; }
        .modal-details .price { font-size: 1.8em; font-weight: 500; color: var(--color-secondary); }
        .modal-details .description { margin: 20px 0; line-height: 1.8; font-size: 1em; }
        .modal-close {
            position: absolute; top: 15px; right: 15px; font-size: 1.5em;
            color: var(--color-text); cursor: pointer; background: #eee;
            border: none; border-radius: 50%; width: 40px; height: 40px;
            display:flex; align-items:center; justify-content:center;
        }
        .modal-details .btn-primary { width:100%; padding: 15px; border-radius: 8px; text-decoration:none; text-align:center; display:block; background-color:var(--color-primary); color:var(--color-bg); }

        /* --- 7. Footer Baru --- */
        footer { background-color: var(--color-light-gray); color: var(--color-text); padding: 80px 0; margin-top: 60px; text-align: center; }
        .footer-logo { font-family: var(--font-serif); font-size: 2.5em; color: var(--color-primary); text-decoration: none; margin-bottom: 20px; display: block; }
        .footer-links { margin: 30px 0; }
        .footer-links a { color: var(--color-text); text-decoration: none; margin: 0 20px; font-weight: 500; }
        .social-icons { margin-bottom: 30px; }
        .social-icons a { color: var(--color-text); margin: 0 15px; font-size: 1.5em; }
        .footer-bottom { color: #888; font-size: 0.9em; }

        /* --- Responsive Design --- */
        @media (max-width: 900px) {
            body { padding-top: 60px; }
            .hero { flex-direction: column-reverse; height: auto; text-align: center; padding-top: 40px; }
            .hero-text { width: 100%; padding: 0; }
            .hero-text p { margin-left: auto; margin-right: auto; }
            .hero-image { width: 100%; margin-top: 40px; }
            .navbar { padding: 15px 0; }
            .navbar .container { padding: 0 20px; }
            .container { padding: 0 20px; }
            .modal-content { flex-direction: column; width: 95%; max-height: 95vh; }
            .modal-image, .modal-details { width: 100%; }
            .modal-image { height: 300px; }
        }
    </style>
</head>
<body>
    <div class="cursor"></div>

    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="nav-logo interactive-element">Batik Nusantara</a>
            <i class="bi bi-search search-icon interactive-element" onclick="document.getElementById('searchInput').focus()"></i>
            <a href="admin/dashboard.php"><i class="bi bi-person"></i></a>
        </div>
    </nav>
    
    <header class="hero container">
        <div class="hero-text">
            <h1 class="reveal-element">Seni dalam Setiap Helai.</h1>
            <p class="reveal-element">Temukan mahakarya batik tulis yang memadukan tradisi adiluhung dengan desain kontemporer. Dibuat oleh tangan-tangan terampil untuk Anda yang berkelas.</p>
            <a href="#produk" class="btn-hero interactive-element reveal-element">Jelajahi Koleksi</a>
        </div>
        <div class="hero-image reveal-element"></div>
    </header>

    <>
        <section id="produk" class="section">
            <div class="container">
                <h2 class="section-title reveal-element">Koleksi Eksklusif</h2>
                <div style="max-width: 600px; margin: 0 auto 60px auto; position: relative;" class="reveal-element">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama..." style="width: 100%; padding: 15px 20px; border: 1px solid #ddd; border-radius: 50px; font-size: 1em;">
                </div>
                <div class="product-grid">
                    <?php
                    $sql = "SELECT * FROM produk ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $nama_produk_encoded = urlencode($row['nama_produk']);
                            $nomor_wa = '6289673044343'; // GANTI NOMOR WA ANDA
                            $link_wa = "https://api.whatsapp.com/send?phone={$nomor_wa}&text=Halo,%20saya%20tertarik%20dengan%20produk%20{$nama_produk_encoded}.";
                    ?>
                    <a href="#" class="product-card interactive-element reveal-element"
                        data-nama="<?php echo htmlspecialchars($row['nama_produk']); ?>"
                        data-harga="Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>"
                        data-deskripsi="<?php echo htmlspecialchars($row['deskripsi']); ?>"
                        data-gambar="uploads/<?php echo htmlspecialchars($row['gambar']); ?>"
                        data-linkwa="<?php echo $link_wa; ?>">
                        <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                        <div class="view-details-prompt">Lihat Detail</div>
                        <div class="product-overlay">
                            <h3><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
                            <p class="price">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </a>
                    <?php
                        }
                    } else {
                        echo "<p style='text-align:center; grid-column: 1/-1;'>Koleksi akan segera hadir.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

         <section class="section about-quality-section">
            <div class="container">
                <h2 class="section-title reveal-element">Warisan dalam Genggaman Anda</h2>
                <div class="quality-grid">
                    <div class="quality-item reveal-element">
                        <div class="icon"><i class="bi bi-brush"></i></div>
                        <h3>100% Batik Tulis Asli</h3>
                        <p>Setiap kain adalah kanvas yang dilukis dengan tangan oleh para maestro, memastikan setiap karya adalah unik dan penuh jiwa.</p>
                    </div>
                    <div class="quality-item reveal-element">
                        <div class="icon"><i class="bi bi-gem"></i></div>
                        <h3>Bahan Kualitas Terbaik</h3>
                        <p>Kami hanya menggunakan kain sutra dan katun primisima pilihan yang terasa lembut di kulit dan memiliki daya tahan warna yang luar biasa.</p>
                    </div>
                    <div class="quality-item reveal-element">
                        <div class="icon"><i class="bi bi-patch-check"></i></div>
                        <h3>Desain Eksklusif</h3>
                        <p>Satu desain untuk satu mahakarya. Koleksi kami terbatas dan tidak diproduksi massal, menjamin keunikan gaya Anda.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <a href="#" class="footer-logo interactive-element">Batik Nusantara</a>
            <div class="footer-links">
                <a href="#" class="interactive-element">Beranda</a>
                <a href="#produk" class="interactive-element">Koleksi</a>
                <a href="#" class="interactive-element">Tentang Kami</a>
            </div>
            <div class="social-icons">
                <a href="#" class="interactive-element"><i class="bi bi-instagram"></i></a>
                <a href="#" class="interactive-element"><i class="bi bi-facebook"></i></a>
                <a href="#" class="interactive-element"><i class="bi bi-tiktok"></i></a>
            </div>
            <div class="footer-bottom">
                &copy; <?php echo date('Y'); ?> Batik Nusantara. Semua hak dilindungi.
            </div>
        </div>
    </footer>
    
    <div class="modal-backdrop" id="productModal">
        <div class="modal-content">
            <button class="modal-close" id="modalCloseBtn"><i class="bi bi-x"></i></button>
            <img src="" alt="Gambar Produk" class="modal-image" id="modalImage">
            <div class="modal-details">
                <h2 id="modalTitle"></h2>
                <p class="price" id="modalPrice"></p>
                <p class="description" id="modalDescription"></p>
                <a href="#" target="_blank" class="btn-primary" id="modalWhatsAppBtn">
                    <i class="bi bi-whatsapp"></i> Pesan Sekarang
                </a>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- 1. Kursor Kustom ---
        const cursor = document.querySelector('.cursor');
        const interactiveElements = document.querySelectorAll('.interactive-element, .product-card, .btn-hero');
        if (window.matchMedia("(min-width: 901px)").matches) {
            window.addEventListener('mousemove', e => {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
            });
            interactiveElements.forEach(item => {
                item.addEventListener('mouseenter', () => cursor.classList.add('grow'));
                item.addEventListener('mouseleave', () => cursor.classList.remove('grow'));
            });
        }

        // --- 2. Efek Scroll pada Navbar ---
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // --- 3. Animasi "Reveal on Scroll" ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('is-visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal-element').forEach(el => observer.observe(el));

        // --- 4. Live Search ---
        const searchInput = document.getElementById('searchInput');
        const allProductCards = document.querySelectorAll('.product-card');
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            allProductCards.forEach(card => {
                const productName = card.dataset.nama.toLowerCase();
                if (productName.includes(searchTerm)) card.style.display = 'block';
                else card.style.display = 'none';
            });
        });
        
        // --- [DIPERBAIKI] KODE JAVASCRIPT MODAL YANG HILANG KINI DITAMBAHKAN KEMBALI ---
        const modal = document.getElementById('productModal');
        const productCards = document.querySelectorAll('.product-card'); // Pemicu modal adalah kartu produk
        const closeModalBtn = document.getElementById('modalCloseBtn');
        
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalPrice = document.getElementById('modalPrice');
        const modalDescription = document.getElementById('modalDescription');
        const modalWhatsAppBtn = document.getElementById('modalWhatsAppBtn');

        const openModal = (e) => {
            e.preventDefault(); // Mencegah link '#' berpindah halaman
            const card = e.currentTarget;
            
            modalImage.src = card.dataset.gambar;
            modalTitle.textContent = card.dataset.nama;
            modalPrice.textContent = card.dataset.harga;
            modalDescription.textContent = card.dataset.deskripsi;
            modalWhatsAppBtn.href = card.dataset.linkwa;
            
            modal.classList.add('active');
        };

        const closeModal = () => {
            modal.classList.remove('active');
        };

        productCards.forEach(card => card.addEventListener('click', openModal));
        closeModalBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
    });

    
    </script>
</body>
</html>