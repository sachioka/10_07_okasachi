<?php
// var_dump($_GET["serchWord"]);
// exit();

include("functions.php");

$path =$_GET["path"];

$fp = fopen($path, 'r');
$data = array();
while ($ret_csv = fgetcsv($fp, 256)) {
  for ($col = 0; $col < count($ret_csv); $col++) {
    $data[$col][$row] = $ret_csv[$col];
  }
  $row++;
}
fclose($fp);
  echo json_encode($data);
  exit();

