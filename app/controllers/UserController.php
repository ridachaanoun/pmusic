<?php
class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/"; // Ensure this directory exists
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
                $imagePath = $targetFile;
            } else {
                $imagePath = null;
            }
            $user = new User(
                $this->db,
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
                $_POST['role'] ?? 'user', // Default to 'user' if not provided
                $imagePath ?? null, // Handle file uploads properly
                $_POST['phone'] ?? null,
                $_POST['status'] ?? 'active' // Default to 'active' if not provided
            );

            if ($user->register()) {
                include "app/views/register.php";
                echo "noooooooooooooo";
                exit();
            } else {
                include "app/views/register.php";
                echo "noooooooooooooo";
                exit();
            }
        } else {
            include "app/views/register.php";
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::login($email, $password, $this->db);
            if ($user) {
                $_SESSION['user'] = [
                    'idUser' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRole(),
                ];
                header("Location: profile");
                exit();
            } else {
                header("Location: login?error=invalid");
                exit();
            }
        } else {
            include "app/views/login.php";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login");
        exit();
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
            $user = new User(
                $this->db,
                $_POST['username'],
                $_POST['email'],
                $_SESSION['user']['password'],
                $_SESSION['user']['role'],
                $_POST['image'] ?? null,
                $_POST['phone'] ?? null
            );

            if ($user->updateProfile($_POST['username'], $_POST['email'], $_POST['image'], $_POST['phone'])) {
                $_SESSION['user']['username'] = $_POST['username'];
                $_SESSION['user']['email'] = $_POST['email'];
                header("Location: profile?success=updated");
                exit();
            } else {
                header("Location: profile?error=updateFailed");
                exit();
            }
        } else {
            include "app/views/profile.php";
        }
    }
}

