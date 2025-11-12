<?php include __DIR__ . '/../header.php'; ?>
<h2>Editar Produto</h2>
<form method="post" action="/?p=products/update">
  <input type="hidden" name="id" value="<?php echo e($product['id']); ?>">
  <div class="mb-3"><label>Nome</label><input name="name" value="<?php echo e($product['name']); ?>" class="form-control" required></div>
  <div class="mb-3"><label>Descrição</label><textarea name="description" class="form-control"><?php echo e($product['description']); ?></textarea></div>
  <div class="mb-3"><label>Preço</label><input type="number" step="0.01" name="price" value="<?php echo e($product['price']); ?>" class="form-control" required></div>
  <div class="mb-3"><label>Quantidade</label><input type="number" name="quantity" value="<?php echo e($product['quantity']); ?>" class="form-control" required></div>
  <button class="btn btn-primary">Atualizar</button>
</form>
<?php include __DIR__ . '/../footer.php'; ?>
