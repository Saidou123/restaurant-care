<html>
<head><title>Modify Reservation</title></head>
<body>
<header>
    <h1>Modify Reservation</h1>
</header>
<div class="container">
    <form method="POST" action="index.php?action=modifyReservation">
        <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reservation['reservationId']) ?>">
        Customer Name: <?= htmlspecialchars($reservation['customerName']) ?><br>
        Contact Info: <?= htmlspecialchars($reservation['contactInfo']) ?><br>
        Reservation Date: <input type="date" name="reservation_date" value="<?= htmlspecialchars($reservation['reservationDate']) ?>" required><br>
        Table Number: <input type="number" name="table_number" value="<?= htmlspecialchars($reservation['tableNumber']) ?>" required><br>
        Special Requests: <textarea name="special_requests"><?= htmlspecialchars($reservation['specialRequests']) ?></textarea><br>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
