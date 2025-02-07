<?php
class User {
    private $conn;
    private int $idUser;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private string $status;
    private ?string $image;
    private ?string $phone;

    public function __construct($db, $username, $email, $password, $role = 'user', $image = null, $phone = null, $status = 'active') {
        $this->conn = $db;
        $this->username = htmlspecialchars(strip_tags($username));
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : throw new Exception("Invalid email format");
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
        $this->image = $image;
        $this->phone = $phone;
        $this->status = $status;
    }

    public function getId(): int {
        return $this->idUser;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function register(): bool {
        $query =  'INSERT INTO Users (username, email, password, role, status, image, phone) VALUES (:username, :email, :password, :role, :status, :image, :phone)';
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'status' => $this->status,
            'image' => $this->image,
            'phone' => $this->phone
        ]);
    }

    public static function login(string $email, string $password, $db): ?User {
        $query = "SELECT * FROM User WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return new User($db, $user['username'], $user['email'], $user['password'], $user['role'], $user['image'], $user['phone'], $user['status']);
        }
        return null;
    }

    public function updateProfile(string $username, string $email, ?string $image, ?string $phone): bool {
        $this->username = htmlspecialchars(strip_tags($username));
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : throw new Exception("Invalid email format");
        $this->image = $image;
        $this->phone = $phone;

        $query = "UPDATE User SET username = :username, email = :email, image = :image, phone = :phone WHERE idUser = :idUser";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'image' => $this->image,
            'phone' => $this->phone,
            'idUser' => $this->idUser
        ]);
    }

    public static function getUserById($db, int $idUser): ?array {
        $query = "SELECT * FROM User WHERE idUser = :idUser";
        $stmt = $db->prepare($query);
        $stmt->execute(['idUser' => $idUser]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
?>
