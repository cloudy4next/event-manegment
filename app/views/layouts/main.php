<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar a {
            padding: 10px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .toast-container {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1050;
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/events">Event Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="nav-link" href="/events">Events</a>
                        <a class="nav-link" href="/logout">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="/login">Login</a>
                        <a class="nav-link" href="/register">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <?php if (isset($_SESSION['user'])): ?>
                <aside class="col-md-2 sidebar p-3">
                    <h5>Dashboard</h5>
                    <a href="/events">All Events</a>
                    <a href="/events/create">Create Event</a>
                    <a href="/registrations">Registrations</a>
                </aside>
            <?php endif; ?>

            <main class="<?php echo isset($_SESSION['user']) ? 'col-md-10' : 'col-md-12'; ?> p-4">
                <?php
                $viewFile = __DIR__ . '/../' . $view . '.php';
                if (file_exists($viewFile)) {
                    include $viewFile;
                } else {
                    echo "View file not found: " . htmlspecialchars($view) . '.php';
                }
                ?>
            </main>
        </div>
    </div>

    <div class="toast-container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= htmlspecialchars($_SESSION['success']); ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['success']); endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= htmlspecialchars($_SESSION['error']); ?>
                    </div>
                    <button type="button" class="btn-close btn-sm btn-close-white ms-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['error']); endif; ?>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <footer class="bg-light text-center p-3 mt-4">
            <div class="container">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Event Management System. Developed by <a
                        href="tel:01712020833" target="_blank">Jahangir Hossein</a></p>
            </div>
        </footer>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var toastElements = document.querySelectorAll('.toast');
        toastElements.forEach(function (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        });
    </script>

</body>

</html>