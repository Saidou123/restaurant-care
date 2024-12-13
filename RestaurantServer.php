<?php
require_once 'RestaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        try {
            switch ($action) {
                case 'addReservation':
                    $this->addReservation();
                    break;
                case 'viewReservations':
                    $this->viewReservations();
                    break;
                case 'modifyReservation':
                    $this->modifyReservation();
                    break;
                case 'deleteReservation':
                    $this->deleteReservation();
                    break;
                default:
                    $this->home();
            }
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    private function home() {
        include 'templates/home.php';
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerName = $_POST['customer_name'];
            $contactInfo = $_POST['contact_info'];
            $reservationDate = $_POST['reservation_date'];
            $tableNumber = $_POST['table_number'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservationWithPreferences(
                $customerName,
                $contactInfo,
                $reservationDate,
                $tableNumber,
                $specialRequests
            );

            header("Location: index.php?action=viewReservations");
            exit();
        } else {
            include 'templates/addReservation.php';
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        include 'templates/viewReservations.php';
    }

    private function modifyReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId = $_POST['reservation_id'];
            $reservationDate = $_POST['reservation_date'];
            $tableNumber = $_POST['table_number'];
            $specialRequests = $_POST['special_requests'];

            $this->db->updateReservation(
                $reservationId,
                $reservationDate,
                $tableNumber,
                $specialRequests
            );

            header("Location: index.php?action=viewReservations");
            exit();
        } else {
            if (isset($_GET['id'])) {
                $reservationId = $_GET['id'];
                $reservation = $this->db->getReservationById($reservationId);
                include 'templates/modifyReservation.php';
            } else {
                throw new Exception("Invalid reservation ID for modification.");
            }
        }
    }

    private function deleteReservation() {
        if (isset($_GET['id'])) {
            $reservationId = $_GET['id'];
            $this->db->deleteReservation($reservationId);
            header("Location: index.php?action=viewReservations");
            exit();
        } else {
            throw new Exception("Invalid reservation ID for deletion.");
        }
    }

    private function handleError($message) {
        echo "<h1>Error</h1>";
        echo "<p>$message</p>";
        echo '<a href="index.php">Back to Home</a>';
    }
}
?>
