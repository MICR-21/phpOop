<?php
require_once "../includes/connect.php";

class User {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    // Store user information in the database
    public function storeUser($firstName, $lastName, $address, $email, $username) {
        $sql = "INSERT INTO users (firstName, lastName, address, email, username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $address, $email, $username);

        if ($stmt->execute()) {
            header("Location: ../ViewUsers.php");
            exit(); // Terminate script execution after redirect
        } else {
            return "Error updating user: " . $stmt->error;
        }
    }
}

if (isset($_POST["registerbtn"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    $storeUser = new User($con);
    $storeUser->storeUser($firstName, $lastName, $address, $email, $username);
}
?>
