<?php
session_start();

require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro_msg'] = "Você precisa estar logado para excluir tarefas.";
    header("Location: ../../login.php");
    exit;
}

$usuario_id_logado = $_SESSION['usuario_id'];

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $tarefa_id = (int)$_GET['id'];

    try {
        $sql = "DELETE FROM tarefas WHERE id = ? AND usuario_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tarefa_id, $usuario_id_logado]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['sucesso_msg'] = "Tarefa excluída com sucesso!";
        } else {
            $_SESSION['erro_msg'] = "Tarefa não encontrada ou acesso negado.";
        }

        header("Location: ../../tarefas_listar.php");
        exit;

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro ao excluir tarefa: " . $e->getMessage();
        header("Location: ../../tarefas_listar.php");
        exit;
    }

} else {
    $_SESSION['erro_msg'] = "ID da tarefa não fornecido.";
    header("Location: ../../tarefas_listar.php");
    exit;
}
?>