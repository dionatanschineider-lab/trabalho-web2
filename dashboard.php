<?php
require_once 'src/templates/header.php'; 
?>

<script>document.title = 'Dashboard - Gestor de Tarefas';</script>

<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
        <p class="col-md-8 fs-4">
            Aqui você pode organizar seu dia e gerenciar todas as suas tarefas.
        </p>
        <p>Comece vendo sua lista de tarefas ou crie uma nova.</p>
        <a href="tarefas_listar.php" class="btn btn-primary btn-lg" role="button">
            <i class="bi bi-check2-square"></i> Ver Minhas Tarefas
        </a>
    </div>
</div>

<?php
require_once 'src/templates/footer.php'; 
?>