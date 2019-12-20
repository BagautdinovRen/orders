<?php
/**
 * Created by PhpStorm.
 * User: bagau
 * Date: 10.12.2019
 * Time: 23:19
 */

error_reporting(E_ALL & ~E_NOTICE);

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/config/database.php';

$opts = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => FALSE
);

try
{
    $pdo = new PDO("mysql:host={$dbConfig['host']}:{$dbConfig['port']};dbname={$dbConfig['dbname']}",
        $dbConfig['login'],
        $dbConfig['pass'],
        $opts
    );
}
catch(Throwable $e)
{
    die($e->getMessage());
}

if (!empty($_GET['order_id'])) {
    $query = "select * from orders where id = ?";

    $dbOrders = $pdo->prepare($query);
    $dbOrders->execute(array($_GET['order_id']));
}
else{
    $query = "select * from orders";

    $dbOrders = $pdo->prepare($query);
    $dbOrders->execute();
}

$orders = $dbOrders->fetchAll();

$smarty = new Smarty();

$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/src/View');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'] . '/tmp');

$smarty->assign('title', 'Список заказов');
$smarty->assign('orders', $orders);
$smarty->display('orders.html');