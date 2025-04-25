<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <style>
        /* Simple Modal Styling */
        .modal {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
        }
        .modal-content h2 {
            margin-bottom: 10px;
        }
        .modal-content p {
            margin-bottom: 20px;
        }
        .modal-content button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-content button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h2>Success!</h2>
            <p>Quotation created successfully.<br>
            Quotation ID: <strong>{{ $invoice_no }}</strong></p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>

    <p>Please wait... Redirecting...</p>

    <script>
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            // After closing modal, clear localStorage and redirect
            localStorage.clear();
            window.location.href = "{{ route('catalogue.qr', ['business_id' => $business_id, 'location_id' => $location_id]) }}";
        }
    </script>
</body>
</html>
