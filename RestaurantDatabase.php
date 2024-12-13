<?php
class RestaurantDatabase {
    private $host = "localhost";
    private $database = "restaurant_care";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function addReservationWithPreferences($customerName, $contactInfo, $reservationDate, $tableNumber, $specialRequests) {
        // Check if the customer already exists
        $stmt = $this->connection->prepare("SELECT customerId FROM Customers WHERE customerName = ? AND contactInfo = ?");
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If customer exists, get the customerId
            $customer = $result->fetch_assoc();
            $customerId = $customer['customerId'];
        } else {
            // If customer does not exist, insert into Customers
            $stmt = $this->connection->prepare("INSERT INTO Customers (customerName, contactInfo) VALUES (?, ?)");
            $stmt->bind_param("ss", $customerName, $contactInfo);
            $stmt->execute();
            $customerId = $this->connection->insert_id;
        }

        // Insert reservation into Reservations table
        $stmt = $this->connection->prepare("INSERT INTO Reservations (customerId, reservationDate, tableNumber, specialRequests) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $customerId, $reservationDate, $tableNumber, $specialRequests);
        $stmt->execute();

        $stmt->close();
    }

    public function getAllReservations() {
        $result = $this->connection->query("SELECT Reservations.*, Customers.customerName, Customers.contactInfo 
            FROM Reservations 
            JOIN Customers ON Reservations.customerId = Customers.customerId");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReservationById($reservationId) {
        $stmt = $this->connection->prepare(
            "SELECT Reservations.*, Customers.customerName, Customers.contactInfo
             FROM Reservations
             JOIN Customers ON Reservations.customerId = Customers.customerId
             WHERE reservationId = ?"
        );
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservation = $result->fetch_assoc();
        $stmt->close();
        return $reservation;
    }

    public function updateReservation($reservationId, $reservationDate, $tableNumber, $specialRequests) {
        $stmt = $this->connection->prepare("UPDATE Reservations SET reservationDate = ?, tableNumber = ?, specialRequests = ? WHERE reservationId = ?");
        $stmt->bind_param("sisi", $reservationDate, $tableNumber, $specialRequests, $reservationId);
        $stmt->execute();
    }

    public function deleteReservation($reservationId) {
        $stmt = $this->connection->prepare("DELETE FROM Reservations WHERE reservationId = ?");
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
    }
}
