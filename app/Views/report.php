<?php include __DIR__ . '/header.php'; ?>
<h2>Relatório de Produtos</h2>
<p><a class="btn btn-outline-primary" href="/?p=export_csv">Exportar CSV</a></p>
<table class="table table-hover">
  <thead><tr><th>Nome</th><th>Descrição</th><th>Preço</th><th>Quantidade</th></tr></thead>
  <tbody>
  <?php foreach($products as $p): ?>
    <tr>
      <td><?php echo e($p['name']); ?></td>
      <td><?php echo e($p['description']); ?></td>
      <td>R$ <?php echo number_format($p['price'],2,',','.'); ?></td>
      <td><?php echo e($p['quantity']); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/footer.php'; ?>
