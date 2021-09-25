<?php
// データベースに接続
function connectDB() {
    // 自分のデータベーステーブル
    $param = 'mysql:dbname=my_image;charset=utf8;port=3306;host=localhost';
    try {
        $pdo = new PDO($param, 'root', '');
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage('error'));
    }
}
?>