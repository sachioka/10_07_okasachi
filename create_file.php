<?php
// var_dump($_POST);
// exit();
// session_start();
include("functions.php");
// check_session_id();

if (
  !isset($_POST['stockcode']) || $_POST['stockcode'] == '' ||
  !isset($_POST['stockname']) || $_POST['stockname'] == ''
  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
  }
  
  
  // 受け取ったデータを変数に入れる
  $stockcode = $_POST['stockcode'];
  $stockname = $_POST['stockname'];
  // var_dump($stockcode);
  // exit();

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  $uploadedFileName = $_FILES['upfile']['name'];
  $tempPathName = $_FILES['upfile']['tmp_name'];
  $fileDirectoryPath = 'upload/';

  $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
  $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
  $fileNameToSave = $fileDirectoryPath . $uniqueName;
  // var_dump($fileNameToSave);
  // exit();
  // $img = '';

  if (is_uploaded_file($tempPathName)) {
    if (move_uploaded_file($tempPathName, $fileNameToSave)) {
      chmod($fileNameToSave, 0644);
      // $img = '<img src="' . $fileNameToSave . '" >';
    } else {
      exit('Error:アップロードできませんでした');
    }
  } else {
    exit('Error:データがありません');
  }
} else {
  // exit('Error:画像が送信されていません');
}
//DB

$pdo = connect_to_db();
// var_dump($_POST);
// exit();
$sql = 'INSERT INTO `registration list`(`id`, `stockcode`, `stockname`, `csv_file`, `created_at`) VALUES (NULL, :stockcode, :stockcode, :csv_file, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':stockcode', $stockcode, PDO::PARAM_STR);
$stmt->bindValue(':stockname', $stockname, PDO::PARAM_STR);
$stmt->bindValue(':csv_file', $fileNameToSave, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
//



  ///////////////
  $fp = fopen($fileNameToSave, 'r');
  $data = array();
  while ($ret_csv = fgetcsv($fp, 256)) {
    for ($col = 0; $col < count($ret_csv); $col++) {
      $data[$col][$row] = $ret_csv[$col];
    }
    $row++;
  }
  fclose($fp);
  echo json_encode($result);
////////////

  header("Location:index.html");
}
