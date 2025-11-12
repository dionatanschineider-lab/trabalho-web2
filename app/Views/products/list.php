<?php include __DIR__ . '/../header.php'; ?>
<h2>Produtos</h2>
<a class="btn btn-primary mb-2" href="/?p=products/create">Criar produto</a>
<table class="table table-striped">
  <thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Quantidade</th><th>Ações</th></tr></thead>
  <tbody>
  <?php foreach($products as $p): ?>
    <tr>
      <td><?php echo e($p['id']); ?></td>
      <td><?php echo e($p['name']); ?></td>
      <td>R$ <?php echo number_format($p['price'],2,',','.'); ?></td>
      <td><?php echo e($p['quantity']); ?></td>
      <td>
        <a class="btn btn-sm btn-secondary" href="/?p=products/edit&id=<?php echo e($p['id']); ?>">Editar</a>
        <a class="btn btn-sm btn-danger" href="/?p=products/delete&id=<?php echo e($p['id']); ?>" onclick="return confirm('Excluir?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../footer.php'; ?>
