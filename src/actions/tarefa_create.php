<?php
session_start();

require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro_msg'] = "Você precisa estar logado para criar tarefas.";
    header("Location: ../../login.php");
    exit;
}

$usuario_id_logado = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);

    if (empty($titulo) || empty($status)) {
        $_SESSION['erro_msg'] = "O Título e o Status são obrigatórios.";
        header("Location: ../../tarefas_form.php");
        exit;
    }

    if (!in_array($status, ['pendente', 'em_andamento', 'concluida'])) {
         $_SESSION['erro_msg'] = "Status inválido.";
        header("Location: ../../tarefas_form.php");
        exit;
    }

    try {
        $sql_insert = "INSERT INTO tarefas (titulo, descricao, status, usuario_id) 
                       VALUES (?, ?, ?, ?)";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        
        if ($stmt_insert->execute([$titulo, $descricao, $status, $usuario_id_logado])) {
            
            $_SESSION['sucesso_msg'] = "Tarefa cadastrada com sucesso!";
            header("Location: ../../tarefas_listar.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro ao cadastrar tarefa: " . $e->getMessage();
        header("Location: ../../tarefas_form.php");
        exit;
    }

} else {
    $_SESSION['erro_msg'] = "Acesso inválido.";
    header("Location: ../../tarefas_listar.php");
    exit;
}
?>