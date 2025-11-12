<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema Web - Trabalho</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
    <a class="navbar-brand" href="/">WebSystem</a>
    <div>
      <ul class="navbar-nav me-auto">
        <?php if(!empty($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link" href="/?p=products">Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="/?p=report">Relatórios</a></li>
        <li class="nav-item"><a class="nav-link" href="/?p=logout">Sair</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="/?p=login">Entrar</a></li>
        <li class="nav-item"><a class="nav-link" href="/?p=register">Registrar</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
