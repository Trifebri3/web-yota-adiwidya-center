<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $identity->full_name }} | Portfolio</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --yota-lemon: #BEF264;
            --yota-dark: #052c24;
            --yota-bg: #FFFFFF;
            --yota-soft: #F7F9F2;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--yota-soft); /* Body background mengikuti sidebar agar seamless */
            color: var(--yota-dark);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Container Utama ala App */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Kiri - Rail Style */
        .app-sidebar {
            width: 280px;
            background-color: var(--yota-soft);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
        }

        /* Main Content - Floating Dashboard Style */
        .app-main {
            flex: 1;
            margin-left: 280px;
            margin-top: 15px;
            margin-right: 15px;
            margin-bottom: 15px;
            padding: 4rem;
            background: white;
            border-radius: 40px; /* Melengkung di semua sisi agar terlihat seperti card melayang */
            box-shadow: 0 20px 60px rgba(5, 44, 36, 0.03);
            min-height: calc(100vh - 30px);
            z-index: 1;
        }

        /* Profile Card */
        .sidebar-profile {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 35px;
            object-fit: cover;
            border: 4px solid var(--yota-lemon);
            box-shadow: 0 15px 30px rgba(190, 242, 100, 0.3);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .profile-avatar:hover {
            transform: rotate(-5deg) scale(1.05);
        }

        .sidebar-profile h5 {
            font-weight: 800;
            margin-top: 1.2rem;
            font-size: 1.15rem;
            color: var(--yota-dark);
        }

        .sidebar-profile p {
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Menu Navigasi */
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item-playful {
            margin-bottom: 0.75rem;
        }

        .nav-link-playful {
            display: flex;
            align-items: center;
            padding: 14px 22px;
            color: var(--yota-dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 20px;
            transition: 0.3s all cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link-playful i {
            margin-right: 15px;
            font-size: 1.1rem;
            opacity: 0.4;
            transition: 0.3s;
        }

        /* Hover & Active States */
        .nav-link-playful:hover {
            background-color: rgba(190, 242, 100, 0.15);
            color: var(--yota-dark);
            padding-left: 28px;
        }

        .nav-link-playful.active {
            background-color: var(--yota-lemon);
            color: var(--yota-dark);
            box-shadow: 0 10px 20px rgba(190, 242, 100, 0.25);
        }

        .nav-link-playful.active i {
            opacity: 1;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem;
            background: white;
            border-radius: 25px;
            text-align: center;
        }

        /* Section Spacing */
        section {
            padding-top: 2rem;
            padding-bottom: 4rem;
            border-bottom: 1px dashed #f1f5f9;
        }

        section:last-child { border-bottom: none; }

        /* Responsive Mobile */
        @media (max-width: 991px) {
            .app-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1.5rem;
                border-right: none;
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }
            .app-main {
                margin-left: 15px;
                margin-top: 0;
                padding: 2rem;
                border-radius: 30px;
            }
            .app-container { flex-direction: column; }
            .sidebar-profile { margin-bottom: 1.5rem; display: flex; align-items: center; text-align: left; gap: 15px; }
            .sidebar-profile h5, .sidebar-profile p { margin: 0; }
            .profile-avatar { width: 50px; height: 50px; border-radius: 15px; }
            .nav-menu { display: flex; overflow-x: auto; gap: 10px; padding-bottom: 10px; }
            .nav-link-playful { white-space: nowrap; padding: 10px 18px; }
            .sidebar-footer { display: none; }
        }

        /* Custom Scrollbar for the App Vibe */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--yota-soft); }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; border: 2px solid var(--yota-soft); }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body>

    <div class="app-container">
        <aside class="app-sidebar">
            <div class="sidebar-profile">
                <img src="{{ $identity->avatar_url }}" class="profile-avatar">
                <div class="profile-info-mob">
                    <h5>{{ $identity->full_name }}</h5>
                    <p>{{ $identity->professional_title }}</p>
                </div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item-playful">
                    <a href="#about" class="nav-link-playful active">
                        <i class="fas fa-user-astronaut"></i> <span class="label-text">About</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#experience" class="nav-link-playful">
                        <i class="fas fa-briefcase"></i> <span class="label-text">Experience</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#skills" class="nav-link-playful">
                        <i class="fas fa-bolt"></i> <span class="label-text">Expertise</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#projects" class="nav-link-playful">
                        <i class="fas fa-rocket"></i> <span class="label-text">Portfolio</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#leadership" class="nav-link-playful">
                        <i class="fas fa-hands-helping"></i> <span class="label-text">Leadership</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#education" class="nav-link-playful">
                        <i class="fas fa-graduation-cap"></i> <span class="label-text">Academic</span>
                    </a>
                </li>
                <li class="nav-item-playful">
                    <a href="#contact" class="nav-link-playful">
                        <i class="fas fa-comment-dots"></i> <span class="label-text">Contact</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <p class="small fw-800 mb-2">Have a project?</p>
                <a href="mailto:{{ $user->email }}" class="btn btn-dark btn-sm w-100 rounded-pill fw-bold py-2">
                    Let's Talk <i class="fas fa-arrow-right ms-1" style="font-size: 0.7rem;"></i>
                </a>
            </div>
        </aside>

        <main class="app-main">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link-playful');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 200)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href').includes(current)) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
