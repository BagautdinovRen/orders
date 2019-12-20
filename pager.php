<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$pager = new ISPager\DirPager(
    new App\CPView\CustomPagesList(),
    '../..',
    5,
    2
);

echo "<pre>";
print_r($pager->getItems());
echo "</pre>";
echo $pager;
/*
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=shop',
        'root',
        '2728154bourne',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $obj = new ISPager\PdoPager(
        new ISPager\ItemsRange(),
        $pdo,
        'sections',
        "",
        array(),
        "",
        "1"
    );


    echo "<pre>";
    print_r($obj->getItems());
    echo "</pre>";
    echo "<p>$obj</p>";
}
catch (PDOException $e) {
    echo "Can't connect to database";
}

*/