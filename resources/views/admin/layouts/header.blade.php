<header class="admin-header">
    <div class="header-left">
        <div class="page-info">
            <span class="root-page">Panel Admin</span>
            <span class="separator">/</span>
            <span class="current-page">Dashboard Utama</span>
        </div>
    </div>

    <div class="header-right">
        <div class="header-search">
            <input type="text" placeholder="Cari data pengurus atau donatur...">
            <span class="search-icon">🔍</span>
        </div>

        <div class="header-icon-btn">
            <span class="badge">3</span>
            🔔
        </div>

        <div class="admin-profile">
            <div class="admin-text">
                <p class="admin-name">Kepengurusan</p>
                <p class="admin-role">Yota Foundation</p>
            </div>
            <div class="admin-avatar">
                <span>YA</span> </div>
        </div>
    </div>
</header>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .admin-header {
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        height: 80px;
        padding: 0 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f0f0f0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Bagian Kiri: Breadcrumb */
    .page-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    .root-page {
        color: #A0A0A0;
        font-weight: 500;
    }

    .separator {
        color: #D9E021; /* Aksen Lemon */
        font-weight: bold;
    }

    .current-page {
        color: #222;
        font-weight: 700;
    }

    /* Bagian Kanan */
    .header-right {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    /* Search Bar Lembut */
    .header-search {
        position: relative;
        display: flex;
        align-items: center;
    }

    .header-search input {
        background: #F8F9FA;
        border: 1px solid #eee;
        padding: 10px 15px 10px 40px;
        border-radius: 12px;
        width: 280px;
        font-family: inherit;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .header-search input:focus {
        outline: none;
        border-color: #D9E021;
        background: #fff;
        box-shadow: 0 4px 12px rgba(217, 224, 33, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        font-size: 0.9rem;
        opacity: 0.5;
    }

    /* Notifikasi */
    .header-icon-btn {
        position: relative;
        cursor: pointer;
        font-size: 1.2rem;
        opacity: 0.7;
        transition: 0.2s;
    }

    .header-icon-btn:hover {
        opacity: 1;
    }

    .header-icon-btn .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #D9E021;
        color: #000;
        font-size: 0.6rem;
        font-weight: 800;
        padding: 2px 5px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    /* Profile Section */
    .admin-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-left: 20px;
        border-left: 1px solid #f0f0f0;
        cursor: pointer;
    }

    .admin-text {
        text-align: right;
    }

    .admin-name {
        font-size: 0.9rem;
        font-weight: 700;
        color: #222;
        margin: 0;
    }

    .admin-role {
        font-size: 0.75rem;
        color: #999;
        margin: 0;
        font-weight: 500;
    }

    .admin-avatar {
        width: 45px;
        height: 45px;
        background-color: #D9E021;
        border-radius: 12px; /* Kotak membulat (modern) */
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #222;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(217, 224, 33, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-search, .admin-text {
            display: none;
        }
        .admin-header {
            padding: 0 20px;
        }
    }
</style>
