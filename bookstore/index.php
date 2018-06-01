<?php 


	require_once __DIR__ . '/vendor/autoload.php';

	$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
	$twig = new Twig_Environment($loader);

	$bookModel = new \Bookstore\Models\BookModel(\Bookstore\Core\Db::getInstance());
	$books = $bookModel->getAll(2,3);

	$saleModel = new Bookstore\Models\SaleModel(Bookstore\Core\Db::getInstance());

	$sales = $saleModel->getByUser(1);
	$sale = $saleModel->get(1);

	$params3 = ['sale' => $sale];
	$params2 = ['sales' => $sales];

	$params = ['books' => $books, 'currentPage' => 2];
	echo $sales;
	echo $twig->loadTemplate('sale.twig')->render($params2);