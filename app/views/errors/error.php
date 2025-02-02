<!-- views/errors/403.php or 404.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= $errorCode ?></title>
    <!-- Link Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .error-page {
            text-align: center;
            padding: 100px 15px;
        }

        .error-code {
            font-size: 100px;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 24px;
            color: #343a40;
        }

        .btn-home {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
        }

        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="error-page">
        <div class="error-code">
            <?= $errorCode ?>
        </div>
        <div class="error-message">
            <?= $errorMessage ?>
        </div>
        <a href="/events" class="btn-home">Go to Homepage</a>
    </div>

    <!-- Optionally, add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>