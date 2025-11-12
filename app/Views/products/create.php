<?php include __DIR__ . '/../header.php'; ?>
<h2>Criar Produto</h2>
<form method="post" action="/?p=products/store">
  <div class="mb-3"><label>Nome</label><input name="name" class="form-control" required></div>
  <div class="mb-3"><label>Descrição</label><textarea name="description" class="form-control"></textarea></div>
  <div class="mb-3"><label>Preço</label><input type="number" step="0.01" name="price" class="form-control" required></div>
  <div class="mb-3"><label>Quantidade</label><input type="number" name="quantity" class="form-control" required></div>
  <button class="btn btn-success">Salvar</button>
</form>
<?php include __DIR__ . '/../footer.php'; ?>
