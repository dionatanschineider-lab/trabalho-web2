<?php
namespace App\Controllers;
class ProductController {
    protected function checkAuth(){
        if (empty($_SESSION['user_id'])) {
            header('Location: /?p=login');
            exit;
        }
    }
    public function index(){
        global $pdo;
        $this->checkAuth();
        $stmt = $pdo->query('SELECT * FROM products ORDER BY created_at DESC');
        $products = $stmt->fetchAll();
        include __DIR__ . '/../Views/products/list.php';
    }
    public function create(){
        $this->checkAuth();
        include __DIR__ . '/../Views/products/create.php';
    }
    public function store(){
        global $pdo;
        $this->checkAuth();
        $name = $_POST['name'] ?? '';
        $desc = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $qty = $_POST['quantity'] ?? 0;
        $stmt = $pdo->prepare('INSERT INTO products (name,description,price,quantity) VALUES (?,?,?,?)');
        $stmt->execute([$name,$desc,$price,$qty]);
        header('Location: /?p=products');
        exit;
    }
    public function edit(){
        global $pdo;
        $this->checkAuth();
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        include __DIR__ . '/../Views/products/edit.php';
    }
    public function update(){
        global $pdo;
        $this->checkAuth();
        $id = $_POST['id'] ?? 0;
        $stmt = $pdo->prepare('UPDATE products SET name=?, description=?, price=?, quantity=? WHERE id=?');
        $stmt->execute([$_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $id]);
        header('Location: /?p=products');
        exit;
    }
    public function delete(){
        global $pdo;
        $this->checkAuth();
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
        header('Location: /?p=products');
        exit;
    }
    public function report(){
        global $pdo;
        $this->checkAuth();
        $stmt = $pdo->query('SELECT * FROM products ORDER BY name');
        $products = $stmt->fetchAll();
        include __DIR__ . '/../Views/report.php';
    }
    public function exportCsv(){
        global $pdo;
        $this->checkAuth();
        $stmt = $pdo->query('SELECT * FROM products ORDER BY id');
        $rows = $stmt->fetchAll();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=products_report.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['id','name','description','price','quantity','created_at']);
        foreach($rows as $r){
            fputcsv($out, $r);
        }
        fclose($out);
        exit;
    }
}
