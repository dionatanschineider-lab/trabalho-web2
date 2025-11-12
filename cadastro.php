<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dionatan - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Criar Conta</h3>

                        <?php
                        if (isset($_SESSION['erro_msg'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['erro_msg'] . '</div>';
                            unset($_SESSION['erro_msg']);
                        }
                        ?>

                        <form action="src/actions/cadastro_action.php" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>