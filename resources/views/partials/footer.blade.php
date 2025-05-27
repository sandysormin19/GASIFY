<!-- FOOTER START -->
<footer class="bg-success text-white pt-5 pb-4 mt-5" id="footer">
    <div class="container">
        <div class="row g-4">
            <!-- Brand -->
            <div class="col-md-4">
                <h4 class="fw-bold">Gasify</h4>
                <p>&copy; 2025 Gasify. Semua hak dilindungi.</p>
            </div>

            <!-- Navigasi -->
            <div class="col-md-2">
                <h6 class="fw-semibold">Navigasi</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none hover-link">Tentang</a></li>
                    <li><a href="#" class="text-white text-decoration-none hover-link">Cara Kerja</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-md-3">
                <h6 class="fw-semibold">Hubungi Kami</h6>
                <p class="mb-1">Email: Gasify@gmail.com</p>
                <p>Telepon: +62 811-8183-317</p>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-3">
                <h6 class="fw-semibold">Ikuti Kami</h6>
                <div class="d-flex gap-3 fs-4 social-icons">
                    <a href="https://taplink.cc/gasify.gg" class="text-white" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/gasify.official" class="text-white" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/gasify.official" class="text-white" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/gasify_gg" class="text-white" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- STYLE -->
<style>
    /* Hover efek pada link */
    .hover-link {
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .hover-link:hover {
        text-decoration: underline;
        color: #d4f2d2 !important;
    }

    /* Sosial media ikon efek */
    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
        color: #d4f2d2;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
        text-decoration: none !important;
        will-change: transform;
        backface-visibility: hidden;
    }

    .social-icons a:focus {
        outline: none;
        box-shadow: none;
        text-decoration: none;
    }

    .social-icons a i {
        text-decoration: none !important;
        font-style: normal;
    }

    .social-icons a:hover {
        transform: scale(1.3) rotate(15deg);
        background-color: #27ae60;
        color: #fff;
        box-shadow: 0 0 15px #27ae60;
    }

    /* Footer gradient background animasi */
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    footer.bg-success {
        background: linear-gradient(270deg, #198754, #157347, #1db954, #198754);
        background-size: 600% 600%;
        animation: gradientBG 15s ease infinite;
    }

    /* Fade-in saat muncul di viewport */
    #footer {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    #footer.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- SCRIPT -->
<script>
    // Tambahkan efek muncul footer saat scroll
    window.addEventListener('scroll', () => {
        const footer = document.getElementById('footer');
        const rect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;

        if (rect.top < windowHeight - 100) {
            footer.classList.add('visible');
        }
    });
</script>

<!-- FONT AWESOME -->
<!-- Tambahkan ini di bagian head halaman HTML jika belum ada -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
