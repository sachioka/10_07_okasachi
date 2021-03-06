<?php
// var_dump($_GET["serchWord"]);
// exit();

include("functions.php");

$search_word =$_GET["serchWord"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = "SELECT * FROM `registration list` where `stockcode` LIKE '%{$search_word}%'";
// "SELECT * FROM tablea LEFT OUTER JOIN tableb ON tablea.id = tableb.id";
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  // var_dump($result);
  echo json_encode($result);

  exit();

}