<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("Acesso negado. Você precisa estar logado.");
}

require_once '../../config/database.php';

$usuario_id_logado = $_SESSION['usuario_id'];

try {
    $sql = "SELECT titulo, descricao, status, data_criacao 
            FROM tarefas 
            WHERE usuario_id = ? 
            ORDER BY status, data_criacao DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario_id_logado]);
    $tarefas = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Erro ao consultar o banco de dados: " . $e->getMessage());
}
$filename = "relatorio_tarefas_" . date('Y-m-d') . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

$headers = ['Titulo', 'Status', 'Descricao', 'Data de Criacao'];
fputcsv($output, $headers, ';');

if ($stmt->rowCount() > 0) {
    foreach ($tarefas as $tarefa) {
        $tarefa['data_criacao'] = date('d/m/Y H:i', strtotime($tarefa['data_criacao']));
        $tarefa['status'] = ucfirst($tarefa['status']); 
        fputcsv($output, $tarefa, ';');
    }
}
fclose($output);
exit;
?>