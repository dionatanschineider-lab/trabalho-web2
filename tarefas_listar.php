<?php
require_once 'src/templates/header.php';
require_once 'config/database.php';
$usuario_id_logado = $_SESSION['usuario_id'];

try {
    $sql = "SELECT * FROM tarefas 
            WHERE usuario_id = ? 
            ORDER BY FIELD(status, 'pendente', 'em_andamento', 'concluida'), data_criacao DESC";
    
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$usuario_id_logado]);

    $tarefas = $stmt->fetchAll();

} catch (PDOException $e) {
    echo "Erro ao buscar tarefas: " . $e->getMessage();
    exit;
}
?>

<script>document.title = 'Minhas Tarefas - Gestor de Tarefas';</script>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Minhas Tarefas</h2>
    <div>
        <a href="src/reports/gerar_relatorio_tarefas.php" class="btn btn-primary me-2">
            <i class="bi bi-file-earmark-excel"></i> Baixar (Excel)
        </a>
        <a href="tarefas_form.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Adicionar Nova Tarefa
        </a>
    </div>
</div>

    <?php
    if (isset($_SESSION['sucesso_msg'])) {
        echo '<div class="alert alert-success">' . $_SESSION['sucesso_msg'] . '</div>';
        unset($_SESSION['sucesso_msg']);
    }
    if (isset($_SESSION['erro_msg'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['erro_msg'] . '</div>';
        unset($_SESSION['erro_msg']);
    }
    ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Criada em</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($stmt->rowCount() > 0): ?>
                            <?php foreach ($tarefas as $tarefa): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                                    
                                    <td class="text-center">
                                        <?php
                                        $status_cor = '';
                                        switch ($tarefa['status']) {
                                            case 'pendente': $status_cor = 'warning'; break;
                                            case 'em_andamento': $status_cor = 'primary'; break;
                                            case 'concluida': $status_cor = 'success'; break;
                                        }
                                        ?>
                                        <span class="badge bg-<?php echo $status_cor; ?>">
                                            <?php echo htmlspecialchars(ucfirst($tarefa['status']));?>
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?php echo date('d/m/Y', strtotime($tarefa['data_criacao'])); ?>
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="tarefas_form.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>
                                        <a href="src/actions/tarefa_delete.php?id=<?php echo $tarefa['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                            <i class="bi bi-trash-fill"></i> Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Nenhuma tarefa cadastrada ainda.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'src/templates/footer.php'; 
?>