<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Allowed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4 text-center" style="max-width: 500px;">
            <div class="card-body">
                <h2 class="card-title text-danger mb-4">Access Denied</h2>
                <p class="card-text fs-5">Sorry, you cannot edit any details as you are already approved.</p>
                <a href="{{ route('mobile.form') }}" class="btn btn-primary mt-3">Return to Home</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
