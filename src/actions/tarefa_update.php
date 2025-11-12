<?php
session_start();

require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro_msg'] = "Você precisa estar logado.";
    header("Location: ../../login.php");
    exit;
}

$usuario_id_logado = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarefa_id = (int)$_POST['id'];
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);
    if (empty($titulo) || empty($status) || $tarefa_id <= 0) {
        $_SESSION['erro_msg'] = "Dados inválidos! Título e Status são obrigatórios.";
        header("Location: ../../tarefas_form.php?id=" . $tarefa_id);
        exit;
    }

    if (!in_array($status, ['pendente', 'em_andamento', 'concluida'])) {
         $_SESSION['erro_msg'] = "Status inválido.";
        header("Location: ../../tarefas_form.php?id=" . $tarefa_id);
        exit;
    }

    try {
        $sql_update = "UPDATE tarefas SET 
                           titulo = ?, 
                           descricao = ?, 
                           status = ? 
                       WHERE id = ? AND usuario_id = ?";
        
        $stmt_update = $pdo->prepare($sql_update);

        $stmt_update->execute([$titulo, $descricao, $status, $tarefa_id, $usuario_id_logado]);
        if ($stmt_update->rowCount() > 0) {
            $_SESSION['sucesso_msg'] = "Tarefa atualizada com sucesso!";
        } else {
            $_SESSION['erro_msg'] = "Nenhuma alteração detectada ou acesso negado.";
        }
        
        header("Location: ../../tarefas_listar.php");
        exit;

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro ao atualizar tarefa: " . $e->getMessage();
        header("Location: ../../tarefas_form.php?id=" . $tarefa_id);
        exit;
    }

} else {
    $_SESSION['erro_msg'] = "Acesso inválido.";
    header("Location: ../../tarefas_listar.php");
    exit;
}
?>