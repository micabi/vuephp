<?php

try{
// $_POST[''] or $_GET[''] で値の受け取り

$pdo = new PDO("sqlite:vue.db");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// echo("接続成功");

$sql = "select * from contacts where 1";
$stmt = $pdo->prepare($sql);
// $data[] = ; // {column A} value *POST['']されてきたものをdata[]に入れる
// $data[] = ; // {column B} value
// $data[] = ; // {column C} value
$stmt->execute(); // where 1ならdataは要らない。

$pdo = null;

while($stmt == true){
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
if($rec == false){
break;
}

$data = $rec;
// $data = json_encode($rec);
var_dump($data);
// 処理 ここでrec['COLUMN-NAME']を、変数を作って代入する。

}

}catch(PDOException $Exception){
echo( $Exception->getMessage() );
echo("データベースサーバーがダウンしています。しばらく経ってから再度お試し下さい。");
exit();
}