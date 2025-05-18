<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        localStorage.clear(); // Clear localStorage
        window.location.href = "{{ route('catalogue.qr', ['business_id' => $business_id, 'location_id' => $location_id]) }}";
    </script>
</head>
<body>
    <p>Please wait... Redirecting...</p>
</body>
</html>
