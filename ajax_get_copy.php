<?php

// var_dump($_GET["path"]);
// exit();

include("functions.php");

// $path =$_GET["path"];
$path = "upload/20200730162253d41d8cd98f00b204e9800998ecf8427e.csv";


$fp = fopen($path, 'r');
$data = array();
$row = 0;
while ($ret_csv = fgetcsv($fp, 500)) {
  for ($col = 0; $col < count($ret_csv); $col++) {
    $data[$col][$row] = $ret_csv[$col];
  }
  $row++;
}
fclose($fp);

  echo json_encode($data);
  // var_dump($data);
  // exit();

