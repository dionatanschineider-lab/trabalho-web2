<?php
session_start();

require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['erro_msg'] = "Preencha o e-mail e a senha.";
        header("Location: ../../login.php");
        exit;
    }

    try {
        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            session_regenerate_id(true);

            header("Location: ../../dashboard.php");
            exit;

        } else {
            $_SESSION['erro_msg'] = "E-mail ou senha incorretos.";
            header("Location: ../../login.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro no banco de dados: " . $e->getMessage();
        header("Location: ../../login.php");
        exit;
    }

} else {
    header("Location: ../../login.php");
    exit;
}
?>