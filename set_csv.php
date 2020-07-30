<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>株価データアップロード</title>
</head>

<body>
  <form action="create_file.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>ファイルアップロード</legend>
      <div>銘柄コード<input type="text" min="4" max="4" id="stockcode" name="stockcode"></div>
      <div>銘柄名<input type="text" id="stockname" name="stockname"></div>
      <!-- <div>銘柄名<select name="stockname" id="stockname">
      入力したコードで選択肢が出るようにしたい
        </div>  -->
      <div>
        <input type="file" name="upfile" accept="text/csv" capture="camera">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>