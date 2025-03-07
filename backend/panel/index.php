<?php
include 'db.php';

function getContent($section) {
    global $conn;
    $stmt = $conn->prepare("SELECT content FROM ourteam WHERE section = ?");
    $stmt->bind_param("s", $section);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['content'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/HOMESPECTOR/CSS/ourteam.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <title>Document</title>
</head>
<body>
    <section class="about">
                <div class="about-container">
                    <?php echo getContent('about'); ?>
                </div>
            </section>

            <!-- <section class="our-founders">
                <div class="founders-container">
                    <?php 
                        // echo getContent('founders'); 
                    ?> 
                </div>
            </section> -->
            <section class="our-founders">
                <h2 data-aos="fade-up">Our Founders</h2>
                <div class="founders-container">
                    <div class="founder" data-aos="fade-right">
                        <img src="/HOMESPECTOR/img/staff/CEO.jpg" alt="Sumes Chetthamrongchai" class="founder-photo">
                        <h3>Sumes Chetthamrongchai</h3>
                        <p>Founder & Managing Director, NACHI Certified Inspector</p>
                        <div class="certification-container">
                            <p class="certification">
                                ได้รับการรับรองผู้ตรวจสอบบ้านจากสมาคมระดับโลกอย่าง INTERNACHI
                            </p>
                            <img src="/HOMESPECTOR/img/certified3.png" alt="Certification Badge"
                                class="certification-badge">
                        </div>
                    </div>
                    <div class="founder" data-aos="fade-left">
                        <img src="/HOMESPECTOR/img/staff/Co-founder.jpg" alt="Suthep Chetthamrongchai"
                            class="founder-photo">
                        <h3>Suthep Chetthamrongchai</h3>
                        <p>Co-Founder & Civil Engineer</p>
                    </div>
                </div>
            </section>


            <section class="team-section">
                <div class="team-container">
                    <?php echo getContent('team'); ?>
                </div>
            </section>
            <footer class="footer">
                <div class="footer-container">
                    <!-- Left Section: Social Media & Branding -->
                    <div class="footer-left">
                        <!-- <h2>HomeInspector</h2> -->
                        <img src="/HOMESPECTOR/img/footer_logo.png" alt="HomeInspector Logo" class="footer-logo">
                        <div class="social-icons">
                            <a href="https://www.facebook.com/t.homeinspector/" target="_blank"><img
                                    src="/HOMESPECTOR/icon/ICON/Fb.png" alt="Facebook"></a>
                            <a href="https://www.instagram.com/t.homeinspector/" target="_blank"><img
                                    src="/HOMESPECTOR/icon/ICON/IG.png" alt="Instagram"></a>
                            <a href="https://page.line.me/t.home?openQrModal=true" target="_blank"><img
                                    src="/HOMESPECTOR/icon/ICON/line.png" alt="Line"></a>
                            <a href="https://www.tiktok.com/@thomeinspector" target="_blank"><img
                                    src="/HOMESPECTOR/icon/ICON/Tiktok.png" alt="TikTok"></a>
                            <a href="https://www.youtube.com/channel/UC1BPUCVPBW4-ml7MrxQWjug" target="_blank"><img
                                    src="/HOMESPECTOR/icon/ICON/YB.png" alt="YouTube"></a>
                        </div>
                    </div>

                    <!-- Center Section: Company -->
                    <div class="footer-center">
                        <h2>เกี่ยวกับเรา <span class="toggle-icon">+</span></h2>
                        <ul>
                            <li><a href="/HOMESPECTOR/Homepage/ourstory.php">ประวัติของเรา</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/ourteam.php">ทีมงานของเรา</a></li>
                        </ul>
                    </div>

                    <!-- Right Section: Our Services -->
                    <div class="footer-right">
                        <h2>บริการของเรา <span class="toggle-icon">+</span></h2>
                        <ul>
                            <li><a href="/HOMESPECTOR/Homepage/Hinspector.html">ต.ตรวจบ้าน</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/Hinterior.html">ต.ตงแต่ง</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/Hconstruction.html">ต.เติม</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/Hbulter.html">H.Bulter</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/cal-electric.html">ตรวจสอบระบบไฟฟ้า</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/app-inspector.html">ตรวจบ้านเอง</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/checklist.html">เทียบสเปกบ้าน</a></li>
                        </ul>
                    </div>

                    <!-- Extra Section: Customer Help -->
                    <div class="footer-help">
                        <h2>ช่วยเหลือ <span class="toggle-icon">+</span></h2>
                        <ul>
                            <li><a href="/HOMESPECTOR/Homepage/index.html#faq">คำถามที่พบบ่อย (FAQ)</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/joinwithus.php">รวมงานกับเรา</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/promotion.html">โปรโมชั่น</a></li>
                            <li><a href="/HOMESPECTOR/Homepage/Contactus.php">ติดต่อเรา</a></li>
                        </ul>
                    </div>

                    <!-- Payment Logos -->
                    <div class="footer-payment">
                        <h2>ชำระเงินด้วย</h2>
                        <div class="payment-logos">
                            <img src="/HOMESPECTOR/img/visacard.png" alt="Visa">
                            <img src="/HOMESPECTOR/img/Mastercard.webp" alt="MasterCard">
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <p>© 2024 HomeInspector. All Rights Reserved.</p>
                </div>
            </footer>

        </div>
    </div>


    <script src="/HOMESPECTOR/JS/Toggle_Navbar.js"></script>
    <script src="/HOOMESPECTOR/JS/dropdown.js"></script>
    <script src="/HOMESPECTOR/JS/ourteam.js"></script>
    <script src="/HOMESPECTOR/JS/search_ham.js"></script>
    <script src="/HOMESPECTOR/JS/footer.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const carousel = document.getElementById("carousel");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
            const teamMembers = document.querySelectorAll(".team-member");
            const visibleItems = 4;
            let currentIndex = 0;

            function updateCarousel() {
                const offset = -(currentIndex * teamMembers[0].offsetWidth + 20 * currentIndex);
                carousel.style.transform = `translateX(${offset}px)`;
            }

            prevBtn.addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            nextBtn.addEventListener("click", () => {
                if (currentIndex < teamMembers.length - visibleItems) {
                    currentIndex++;
                    updateCarousel();
                }
            });
        });
    </script>
</body>
</html>

