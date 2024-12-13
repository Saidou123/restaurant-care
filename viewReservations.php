<html>
<head>
    <title>Your Reservations</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <h1>Reservation List</h1>
</header>
<div class="container">
    <h2>Manage Your Reservations</h2>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Customer Name</th>
                    <th>Reservation Date</th>
                    <th>Table Number</th>
                    <th>Special Requests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
                    <td><?= htmlspecialchars($reservation['customerName']) ?></td>
                    <td><?= htmlspecialchars($reservation['reservationDate']) ?></td>
                    <td><?= htmlspecialchars($reservation['tableNumber']) ?></td>
                    <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
                    <td>
                        <a href="index.php?action=modifyReservation&id=<?= $reservation['reservationId'] ?>" class="btn-secondary">Edit</a>
                        <a href="index.php?action=deleteReservation&id=<?= $reservation['reservationId'] ?>" class="btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p><a href="index.php">Back to Home</a></p>
</div>
</body>
</html>
