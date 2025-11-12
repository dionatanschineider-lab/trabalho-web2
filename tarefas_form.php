<?php
require_once 'src/templates/header.php';
require_once 'config/database.php';

$usuario_id_logado = $_SESSION['usuario_id'];

$tarefa_id = null;
$titulo = '';
$descricao = '';
$status = 'pendente';
$titulo_pagina = "Adicionar Nova Tarefa";
$action_url = "src/actions/tarefa_create.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $tarefa_id = (int)$_GET['id'];
    
    try {
        $sql = "SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tarefa_id, $usuario_id_logado]);
        $tarefa = $stmt->fetch();
        if ($tarefa) {
            $titulo = $tarefa['titulo'];
            $descricao = $tarefa['descricao'];
            $status = $tarefa['status'];

            $titulo_pagina = "Editar Tarefa";
            $action_url = "src/actions/tarefa_update.php"; // Ação (Atualizar)
        } else {
            $_SESSION['erro_msg'] = "Tarefa não encontrada ou acesso negado.";
            header("Location: tarefas_listar.php");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['erro_msg'] = "Erro ao buscar tarefa: " . $e->getMessage();
        header("Location: tarefas_listar.php");
        exit;
    }
}
?>

<script>document.title = '<?php echo $titulo_pagina; ?> - Gestor de Tarefas';</script>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?php echo $titulo_pagina; ?></h4>
                </div>
                <div class="card-body">

                    <form action="<?php echo $action_url; ?>" method="POST">
                        
                        <?php if ($tarefa_id): ?>
                            <input type="hidden" name="id" value="<?php echo $tarefa_id; ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título da Tarefa</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" 
                                   value="<?php echo htmlspecialchars($titulo); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pendente" <?php echo ($status == 'pendente') ? 'selected' : ''; ?>>
                                    Pendente
                                </option>
                                <option value="em_andamento" <?php echo ($status == 'em_andamento') ? 'selected' : ''; ?>>
                                    Em Andamento
                                </option>
                                <option value="concluida" <?php echo ($status == 'concluida') ? 'selected' : ''; ?>>
                                    Concluída
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição (Opcional)</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo htmlspecialchars($descricao); ?></textarea>
                        </div>

                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <a href="tarefas_listar.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Salvar Tarefa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'src/templates/footer.php'; 
?>