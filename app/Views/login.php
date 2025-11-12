<?php include __DIR__ . '/header.php'; ?>
<h2>Login</h2>
<?php if(!empty($error)): ?><div class="alert alert-danger"><?php echo e($error); ?></div><?php endif; ?>
<form method="post" action="/?p=login">
  <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label>Senha</label><input type="password" name="password" class="form-control" required></div>
  <button class="btn btn-primary">Entrar</button>
</form>
<?php include __DIR__ . '/footer.php'; ?>
