    <!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="/ADMIN_PANEL/img/favicon1.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="/ADMIN_PANEL/CSS/index.css">
    <title>Header Design</title>
    </head>
    <style>
    .login-option {
        position: relative;
    }

    .login-option a::after {
        content: "Logout";
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        color: #333;
        font-size: 14px;
        font-weight: bold;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        white-space: nowrap;
        display: none;
        z-index: 1000;
    }

    .login-option a:hover::after {
        display: block;
    }
    </style>

    <body>
    <div class="content-box">
        <div class="content-box">
        <div class="header">
            <header class="top-bar">
            <div class="container">
                <!-- Social Icons -->
                <div class="social-icons">
                <a href="https://www.facebook.com/t.homeinspector/?locale=th_TH">
                    <img src="/ADMIN_PANEL/icon/ICON/Fb.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/t.homeinspector/">
                    <img src="/ADMIN_PANEL/icon/ICON/IG.png" alt="Instagram">
                </a>
                <a href="https://page.line.me/t.home?openQrModal=true">
                    <img src="/ADMIN_PANEL/icon/ICON/line.png" alt="Line">
                </a>
                <a href="tel:082-045-6165">
                    <img src="/ADMIN_PANEL/icon/ICON/phone.png" alt="Phone">
                </a>
                </div>
                <!-- Logo -->
                <div class="logo">
                <a href="/ADMIN_PANEL/index.html">
                    <img src="/ADMIN_PANEL/img/s1.png" alt="T. Home Inspector Logo">
                </a>
                </div>

                <div class="actions">
                <!-- Language Switcher -->
                <div class="language-switcher">
                    <a href="?lang=th" class="lang-link">
                    <img src="/ADMIN_PANEL/icon/ICON/thai.png" alt="Thai" title="ภาษาไทย">
                    </a>
                    <a href="?lang=en" class="lang-link">
                    <img src="/ADMIN_PANEL/icon/ICON/eng.png" alt="English" title="English">
                    </a>
                </div>

                <!-- Search Icon -->
                <i id="search-icon" class="fas fa-search"></i>
                <div id="search-bar" class="search-bar">
                    <input type="text" placeholder="Search..." />
                    <button onclick="searchFunction()">Search</button>
                </div>
                <!-- Hamburger Icon -->
                <i id="hamburger-icon" class="fas fa-bars hamburger-icon" onclick="toggleMenu()"></i>
                </div>
            </header>
            <nav class="nav-links" id="nav-links">
            <ul>
                <li><a href="/ADMIN_PANEL/index.html" data-translate="nav.home">หน้าหลัก</a>
                </li>
                <li><a href="/ADMIN_PANEL/backend/panel/admin_service.php" data-translate="nav.services">บริการ</a></li>
                <li><a href="/ADMIN_PANEL/promotion.html" data-translate="nav.promotion">สิทธิพิเศษ</a>
                </li>
                <li><a href="/ADMIN_PANEL/projects_media.html" data-translate="nav.projects">ผลงาน</a>
                </li>

                <!-- Dropdown Menu -->
                <li class="dropdown">
                <a href="#" class="menu-item" data-translate="nav.aboutUs">
                    เกี่ยวกับเรา <span class="dropdown-icon"><i class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/ADMIN_PANEL/ourstory.html" data-translate="nav.ourStory">ประวัติของเรา</a>
                    </li>
                    <li><a href="/ADMIN_PANEL/ourteam.html" data-translate="nav.ourTeam">ทีมงานของเรา</a></li>
                </ul>
                </li>

                <li><a href="/ADMIN_PANEL/articles.html" data-translate="nav.articles">บทความ</a></li>
                <li><a href="/ADMIN_PANEL/Review-home.html" data-translate="nav.reviewHome">รีวิวบ้าน</a></li>
                <li><a href="/ADMIN_PANEL/review_interior.php"
                    data-translate="nav.reviewInterior">บริการตกแต่งภายใน</a></li>
                <li class="dropdown">
                <a href="#" class="menu-item" data-translate="nav.aboutUs">
                    รวมงานกับเรา <span class="dropdown-icon"><i class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/ADMIN_PANEL/backend/panel/admin_joinus.php" data-translate="nav.ourStory">รวมงานกับเรา</a>
                    </li>
                    <li><a href="/ADMIN_PANEL/backend/panel/admin_job1.php" data-translate="nav.ourTeam">Job-details</a></li>
                    <li><a href="/ADMIN_PANEL/backend/panel/admin_manage_jobs.php" data-translate="nav.ourTeam">Manage Jobs</a></li>
                </ul>
                </li>
                <li><a href="/ADMIN_PANEL/backend/panel/admin_contact.php" data-translate="nav.contact">ติดต่อเรา</a>
                </li>
                <li class="login-option">
                <!-- Logout Icon with Logout Text -->
                <a href="/ADMIN_PANEL/backend/logout.php" id="logoutIcon">
                    <i class="fa-solid fa-user"></i> <!-- Font Awesome User Icon -->
                </a>
                </li>
            </ul>
            </nav>
            <!-- Fullscreen Navigation -->
            <div id="fullscreen-menu" class="fullscreen-menu">
            <!-- Close Icon -->
            <i id="close-icon" class="fas fa-times"></i>
            <header class="top-bar">
                <div class="container">
                <!-- Social Icons -->
                <div class="social-icons">
                    <a href="https://www.facebook.com/t.homeinspector/?locale=th_TH">
                    <img src="/ADMIN_PANEL/icon/ICON/Fb.png" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/t.homeinspector/">
                    <img src="/ADMIN_PANEL/icon/ICON/IG.png" alt="Instagram">
                    </a>
                    <a href="https://page.line.me/t.home?openQrModal=true">
                    <img src="/ADMIN_PANEL/icon/ICON/line.png" alt="Line">
                    </a>
                    <a href="tel:082-045-6165">
                    <img src="/ADMIN_PANEL/icon/ICON/phone.png" alt="Phone">
                    </a>
                </div>

                <!-- Logo -->
                <div class="logo">
                    <a href="/ADMIN_PANEL/index.html">
                    <img src="/ADMIN_PANEL/img/s1.png" alt="T. Home Inspector Logo">
                    </a>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <!-- Language Switcher -->
                    <div class="language-switcher">
                    <a href="?lang=th" class="lang-link">
                        <img src="/ADMIN_PANEL/icon/ICON/thai.png" alt="Thai" title="ภาษาไทย">
                    </a>
                    <a href="?lang=en" class="lang-link">
                        <img src="/ADMIN_PANEL/icon/ICON/eng.png" alt="English" title="English">
                    </a>
                    </div>
                </div>
                </div>
            </header>
            <!-- Navigation Content -->
            <div class="menu-content">
                <!-- Topics Section -->
                <div class="menu-section">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="/ADMIN_PANEL/index.html" data-translate="nav.home">หน้าหลัก</a>
                    </li>
                    <li><a href="/ADMIN_PANEL/service.html" data-translate="nav.services">บริการ</a></li>
                    <li><a href="/ADMIN_PANEL/promotion.html" data-translate="nav.promotion">สิทธิพิเศษ</a></li>
                    <li><a href="/ADMIN_PANEL/projects_media.html" data-translate="nav.projects">ผลงาน</a></li>

                    <!-- Dropdown Menu -->
                    <li class="dropdown1">
                    <a href="#" class="menu-item1" data-translate="nav.aboutUs">
                        เกี่ยวกับเรา <span class="dropdown-icon1"><i class="fa-solid fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu1">
                        <li><a href="/ADMIN_PANEL/ourstory.html" data-translate="nav.ourStory">ประวัติของเรา</a>
                        </li>
                        <li><a href="/ADMIN_PANEL/ourteam.html" data-translate="nav.ourTeam">ทีมงานของเรา</a></li>
                    </ul>
                    </li>

                    <li><a href="/ADMIN_PANEL/articles.html" data-translate="nav.articles">บทความ</a></li>
                    <li><a href="/ADMIN_PANEL/Review-home.html" data-translate="nav.reviewHome">รีวิวบ้าน</a></li>
                    <li><a href="/ADMIN_PANEL/review_interior.php"
                        data-translate="nav.reviewInterior">บริการตกแต่งภายใน</a></li>
                    <li><a href="/ADMIN_PANEL/joinwithus.php" data-translate="nav.joinUs">รวมงานกับเรา</a></li>
                    <li><a href="/ADMIN_PANEL/admin_contact.php" data-translate="nav.contact">ติดต่อเรา</a></li>
                </ul>
                </div>

                <!-- Series & Podcast Section -->
                <div class="menu-section">
                <h3>Content/Articles</h3>
                <ul>
                    <li><a href="#">รายการทั้งหมด</a></li>
                    <li><a href="#">มนุษย์ต่างวัย Talk</a></li>
                    <li><a href="#">บพุทธ์ที่โครฟ</a></li>
                    <li><a href="#">Life Long Investing</a></li>
                    <li><a href="#">มนุษย์ต่างวัย Podcast</a></li>
                    <li><a href="#">ชีวิตชีวา 2</a></li>
                    <li><a href="#">The O Idol</a></li>
                    <li><a href="#">มนุษย์ต่างวัย Talk</a></li>
                </ul>
                </div>

                <!-- Other Sections -->
                <div class="menu-section">
                <h3><a href="/ADMIN_PANEL/Contactus.php" class="menu-link">Contact</a></h3>
                <h3><a href="/ADMIN_PANEL/projects_media.html" class="menu-link">Projects</a></h3>
                <h3><a href="/ADMIN_PANEL/joinwithus.php" class="menu-link">joinwithus</a></h3>
                </div>
            </div>
            </div>
        </div>