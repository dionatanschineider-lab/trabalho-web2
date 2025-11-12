<?php
session_start();
require_once __DIR__ . '/../app/bootstrap.php';
use App\Controllers\AuthController;
use App\Controllers\ProductController;

$path = $_GET['p'] ?? '';

$auth = new AuthController();
$productController = new ProductController();

if ($path === 'login') { $auth->login(); }
elseif ($path === 'logout') { $auth->logout(); }
elseif ($path === 'register') { $auth->register(); }
elseif ($path === 'products') { $productController->index(); }
elseif ($path === 'products/create') { $productController->create(); }
elseif ($path === 'products/store') { $productController->store(); }
elseif ($path === 'products/edit') { $productController->edit(); }
elseif ($path === 'products/update') { $productController->update(); }
elseif ($path === 'products/delete') { $productController->delete(); }
elseif ($path === 'report') { $productController->report(); }
elseif ($path === 'export_csv') { $productController->exportCsv(); }
else { include __DIR__ . '/../app/Views/home.php'; }
