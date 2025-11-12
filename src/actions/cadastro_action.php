<?php
session_start();

require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['erro_msg'] = "Todos os campos são obrigatórios!";
        header("Location: ../../cadastro.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erro_msg'] = "Formato de e-mail inválido!";
        header("Location: ../../cadastro.php");
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql_check = "SELECT id FROM usuarios WHERE email = ?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([$email]);

        if ($stmt_check->fetch()) {
            $_SESSION['erro_msg'] = "Este e-mail já está em uso!";
            header("Location: ../../cadastro.php");
            exit;
        }

        $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt_insert = $pdo->prepare($sql_insert);

        if ($stmt_insert->execute([$nome, $email, $senhaHash])) {
            $_SESSION['sucesso_msg'] = "Cadastro realizado com sucesso! Faça o login.";
            header("Location: ../../login.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro ao cadastrar: " . $e->getMessage();
        header("Location: ../../cadastro.php");
        exit;
    }

} else {
    header("Location: ../../cadastro.php");
    exit;
}
?>