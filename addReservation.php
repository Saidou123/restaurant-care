<html>
<head>
    <title>Make a Reservation</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <h1>Welcome to Saidou Jalloh Restaurant</h1>
</header>
<div class="container">
    <h2>Reserve Your Table</h2>
    <form method="POST" action="index.php?action=addReservation">
        <div class="form-group">
            <label for="customer_name">Full Name</label>
            <input type="text" id="customer_name" name="customer_name" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
            <label for="contact_info">Contact Information</label>
            <input type="text" id="contact_info" name="contact_info" placeholder="Enter your email/phone" required>
        </div>

        <div class="form-group">
            <label for="reservation_date">Reservation Date & Time</label>
            <input type="datetime-local" id="reservation_date" name="reservation_date" required>
        </div>

        <div class="form-group">
            <label for="table_number">Table Preference</label>
            <select id="table_number" name="table_number" required>
                <option value="" disabled selected>Select a table</option>
                <option value="1">Table 1 (Window View)</option>
                <option value="2">Table 2 (Near the Bar)</option>
                <option value="3">Table 3 (Family Seating)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests" placeholder="Any special requests?"></textarea>
        </div>

        <button type="submit" class="btn-primary">Book Now</button>
    </form>
    <p><a href="index.php">Back to Home</a></p>
</div>
</body>
</html>
