<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Akademik Akademi Persib' ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        /* Sidebar Navigasi */
        .sidebar {
            width: 250px;
            background-color: #0055A4;
            color: #FFFFFF;
            padding-top: 20px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s;
        }

        .sidebar .nav-item {
            padding: 10px 15px;
            cursor: pointer;
        }

        .sidebar .nav-item a {
            color: #FFFFFF;
            text-decoration: none;
            display: block;
        }

        .sidebar .nav-item.active a,
        .sidebar .nav-item:hover a {
            background-color: #FFC107;
            color: #0055A4;
            font-weight: bold;
            border-radius: 5px;
        }

        /* Konten Utama */
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #FFFFFF;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #0055A4;
            color: #FFFFFF;
            border-radius: 10px 10px 0 0;
        }

        .btn-primary {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #0055A4;
        }

        .btn-primary:hover {
            background-color: #ffca2c;
            border-color: #ffca2c;
        }

        .alert {
            border-radius: 5px;
        }

        .form-check-input:checked {
            background-color: #FFC107;
            border-color: #FFC107;
        }

        .list-group-item {
            background-color: #FFFFFF;
            border: 1px solid #dee2e6;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php if (session()->get('role') === 'student'): ?>
            <div class="nav-item">
                <a href="/student/dashboard">Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="/student/courses">Courses</a>
            </div>
            <div class="nav-item">
                <a href="/student/profile">Profile</a>
            </div>
            <div class="nav-item">
                <a href="/logout" class="text-danger">Logout</a>
            </div>
        <?php elseif (session()->get('role') === 'admin'): ?>
            <div class="nav-item">
                <a href="/admin/dashboard">Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="/admin/manage_students">Manage Students</a>
            </div>
            <div class="nav-item">
                <a href="/admin/manage_courses">Manage Courses</a>
            </div>
            <div class="nav-item">
                <a href="/logout" class="text-danger">Logout</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <footer
        style="position: fixed; bottom: 0; width: calc(100% - 250px); margin-left: 250px; background-color: #0055A4; color: #FFFFFF; padding: 10px; text-align: center;">
        <p>&copy; <?= date('Y') ?> | Sistem Akademik by <b>Ersya Hasby Satria</b></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/data.js"></script>
    <script src="/js/dom.js"></script>
    <script src="/js/event.js"></script>
    <script>
        // Set menu aktif berdasarkan URL
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.sidebar .nav-item a');
            navItems.forEach(item => {
                const href = item.getAttribute('href');
                if (currentPath.includes(href.replace('/', '')) || (href === '/logout' && currentPath.includes('/logout'))) {
                    item.parentElement.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>