<?php
namespace App\Controllers;
class AuthController {
    public function login(){
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /?p=products');
                exit;
            } else {
                $error = 'Credenciais inválidas.';
                include __DIR__ . '/../Views/login.php';
            }
        } else {
            include __DIR__ . '/../Views/login.php';
        }
    }
    public function register(){
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if (!$name || !$email || !$password) {
                $error = 'Preencha todos os campos.';
                include __DIR__ . '/../Views/register.php';
                return;
            }
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
            try {
                $stmt->execute([$name,$email,$hash]);
                header('Location: /?p=login');
                exit;
            } catch (\PDOException $e) {
                $error = 'Erro: ' . $e->getMessage();
                include __DIR__ . '/../Views/register.php';
            }
        } else {
            include __DIR__ . '/../Views/register.php';
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}
