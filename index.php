<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>和製チャート・ローソク足を学ぶ</title>
</head>

<body>

  <main>
    <div id="leftarea">
      <div><input type="button" value="データ登録へ" id="GoToset_csv" class="btn" onclick="location.href='set_csv.php'"></div>
      <div><input type="text" id="show" class="btn"></div>

      <div id="resultarea">
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
      </div>
      <div><input type="button" id="cheat"></div>
    </div>
    </div>
    <div id="mainarea">
      <div id="chart">
        <!--チャートは上-->
        <div id="chart_div">チャート</div>
        <div id="chart_div2"></div>
      </div>
      <!-- ★★★★★http://www.htmq.com/html5/input_type_number.shtml  HTMLタグリファ　あとでstepとmax/minを設定する-->
      <div id="input4">
        <div id="input_div">
          <!--四本値は下-->
          <div class="day_container">

          </div>
        </div>
      </div>
    </div>
  </main>
  </div>

</body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- <script>
  $(function () {
    let csschang = ['#d1c3', '#d1c4', '#d1c1', '#d1c2', "2日目", '#d2c3', '#d2c4', '#d2c1', '#d2c2', "3日目", '#d3c3', '#d3c4', '#d3c1', '#d3c2']


    $('#check').on('click', function () {
      const candledata = [["1日目", $('#d1c3').val(), $('#d1c4').val(), $('#d1c1').val(), $('#d1c2').val()], ["2日目", $('#d2c3').val(), $('#d2c4').val(), $('#d2c1').val(), $('#d2c2').val()], ["3日目", $('#d3c3').val(), $('#d3c4').val(), $('#d3c1').val(), $('#d3c2').val()]];
      console.log(candledata);
      const jsonData = JSON.stringify(candledata);
      localStorage.setItem('candle', jsonData);
      location.reload();
    });

    $('#judge').on('click', function () {

      const alrt = localStorage.getItem('ans_');
      const judge = JSON.parse(alrt);
      if (judge == 0) {
        alert("正解！！");
      } else {
        alert("不正解!もう一度見直そう");

      }
    });

    $('#retry').on('click', function () {

    });

    $('#all_clear').on('click', function () {
      localStorage.clear();
      location.reload();
    });


    //検証用に正解の数字を入力できるボタン
    $('#cheat').on('click', function () {
      let basedata = [["1日目", 520, 520, 600, 680], ["2日目", 520, 650, 580, 650], ["3日目", 490, 550, 520, 600]];
      $('#d1c1').val(basedata[0][3]);
      $('#d1c2').val(basedata[0][4]);
      $('#d1c3').val(basedata[0][1]);
      $('#d1c4').val(basedata[0][2]);
      $('#d2c1').val(basedata[1][3]);
      $('#d2c2').val(basedata[1][4]);
      $('#d2c3').val(basedata[1][1]);
      $('#d2c4').val(basedata[1][2]);
      $('#d3c1').val(basedata[2][3]);
      $('#d3c2').val(basedata[2][4]);
      $('#d3c3').val(basedata[2][1]);
      $('#d3c4').val(basedata[2][2]);

    });

  });       
</script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  $(function() {
    $('#show').on('keyup', function() {
      console.log($(this).val());
      const serchWord = $(this).val();
      const requestUrl = 'ajax_get.php';
      axios.get(`${requestUrl}?serchWord=${serchWord}`)
        .then(function(response) {
          console.log(response.data);
          let result = response.data.map(x =>
            `<tr><td><button type="button" class="code" value="${x.csv_file}">${x.stockcode}</button></td><td>${x.stockname}</td></tr>`
          );
          console.log(result)
          $('#resultarea').html(result);
        })
        .catch(function(error) {})
        .finally(function() {

        });
    });

  });


  $(function() {
    $(document).on("click", ".code", function() {
      console.log($(this).val());
      const path = $(this).val();
      const requestUrl = 'ajax_get_copy.php';
      axios.get(`${requestUrl}?path=${path}`)
        .then(function(response) {
          console.log(response);

          let dataA = [
            response.data['0'],
            response.data['3'],
            response.data['4'],
            response.data['1'],
            response.data['2']
          ];
          console.log(dataA[1]);












          $(function() {
            // ライブラリのロード
            // name:visualization(可視化),version:バージョン(1.1),packages:パッケージ(corechart)
            google.load('visualization', '1', {
              'packages': ['corechart']
            });

            // グラフを描画する為のコールバック関数を指定
            google.setOnLoadCallback(drawChart);

            function drawChart() {
              //最初に表示されるチャート用のデータを宣言
              // let basedata = [
              //   ["1日目", 520, 520, 600, 680],
              //   ["2日目", 520, 650, 580, 650],
              //   ["3日目", 490, 550, 520, 600]
              // ];
              let basedata = [
                [dataA[0][1], Number(dataA[1][1]), Number(dataA[2][1]), Number(dataA[3][1]), Number(dataA[4][1])],
                [dataA[0][2], Number(dataA[1][2]), Number(dataA[2][2]), Number(dataA[3][2]), Number(dataA[4][2])],
                [dataA[0][3], Number(dataA[1][3]), Number(dataA[2][3]), Number(dataA[3][3]), Number(dataA[4][3])],
                [dataA[0][4], Number(dataA[1][4]), Number(dataA[2][4]), Number(dataA[3][4]), Number(dataA[4][4])],
                [dataA[0][5], Number(dataA[1][5]), Number(dataA[2][5]), Number(dataA[3][5]), Number(dataA[4][5])],
                [dataA[0][6], Number(dataA[1][6]), Number(dataA[2][6]), Number(dataA[3][6]), Number(dataA[4][6])],
                [dataA[0][7], Number(dataA[1][7]), Number(dataA[2][7]), Number(dataA[3][7]), Number(dataA[4][7])]
              ];
              console.log(basedata);

              //-----------------------------------------------------------
              // データの順 安値,終値,始値,高値
              // ※Excelだと始値,高値,安値,終値の順番
              var data = new google.visualization.arrayToDataTable([
                basedata[0],
                basedata[1],
                basedata[2],
                basedata[3],
                basedata[4],
                basedata[5]
              ], true);
              console.log(data);
              // オプションの設定
              var options = {
                legend: 'none',
                vAxis: {
                  gridlines: {
                    count: 21,
                    color: '#0c5020'
                  },
                  title: '株価'
                },
                colors: ['darkslategray', '#004411'],
                animation: {
                  startup: true,
                  duration: 1000
                },
                backgroundColor: '#72a782'
              };

              // 指定されたIDの要素にローソク足を作成
              let chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

              // グラフの描画
              chart.draw(data, options);

              $('#save_status').html('');
            }
          });










        })
        .catch(function(error) {})
        .finally(function() {

        });
    });
  });


  //   $(function () {
  //   });




  //Googl Chart
  $(function() {
    ////////////////////////////ajax//////////////////////////////////
    //データを取得して取得したデータのリストをどこかに表示させてそのボタンをクリックするとチャートが生成される

    ////////////////////////////ajax//////////////////////////////////
    // ライブラリのロード
    // name:visualization(可視化),version:バージョン(1.1),packages:パッケージ(corechart)
    google.load('visualization', '1', {
      'packages': ['corechart']
    });

    // グラフを描画する為のコールバック関数を指定
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      //最初に表示されるチャート用のデータを宣言
      let basedata = [
        ["1日目", 520, 520, 600, 680],
        ["2日目", 520, 650, 580, 650],
        ["3日目", 490, 550, 520, 600]
      ];
      // let basedata = [
      //   [dataA[0][1], dataA[1][1], dataA[2][1], dataA[3][1], dataA[4][1], dataA[5][1]],
      //   [dataA[0][2], dataA[1][2], dataA[2][2], dataA[3][2], dataA[4][2], dataA[5][2]],
      //   [dataA[0][3], dataA[1][3], dataA[2][3], dataA[3][3], dataA[4][3], dataA[5][3]],
      //   [dataA[0][4], dataA[1][4], dataA[2][4], dataA[3][4], dataA[4][4], dataA[5][4]],
      //   [dataA[0][5], dataA[1][5], dataA[2][5], dataA[3][5], dataA[4][5], dataA[5][5]],
      //   [dataA[0][6], dataA[1][6], dataA[2][6], dataA[3][6], dataA[4][6], dataA[5][6]],
      //   [dataA[0][7], dataA[1][7], dataA[2][7], dataA[3][7], dataA[4][7], dataA[5][7]]
      // ];

      if (localStorage.getItem('candle')) {
        //JSONデータをローカルストレージから取ってくる
        const jsonData = localStorage.getItem('candle');
        //JSONデータ（文字列）を配列を構築
        const dataself = JSON.parse(jsonData);
        let dataself_num = [];
        for (let i = 0; i < 3; i++) {
          var day = []; //この先繰り返す
          day.push(dataself[i][0]); //この先繰り返す
          for (let j = 1; j < 5; j++) {
            var num = parseFloat(dataself[i][j]);
            day.push(num);
          }
          dataself_num.push(day)
        }
        let data = new google.visualization.arrayToDataTable([
          dataself_num[0],
          dataself_num[1],
          dataself_num[2]
        ], true);
        // オプションの設定
        //最大値と最小値を変数に入れておく必要があるかも？
        var options = {
          legend: 'none',
          vAxis: {
            minValue: 460,
            maxValue: 690,
            gridlines: {
              count: 20,
              color: '#0c5020'
            },
            title: '株価'
          },
          colors: ['darkslategray', '#004411'],
          animation: {
            startup: true,
            duration: 3000
          },
          backgroundColor: '#72a782'
        };

        // 指定されたIDの要素にローソク足を作成
        let chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

        // グラフの描画
        chart.draw(data, options);

        //入力されたデータをjちゃんにいれる
        let ansdata = [];
        var ans_ = 0;
        for (let i = 0; i < 3; i++) {
          for (let j = 1; j < 5; j++) {
            if (dataself_num[i][j] == basedata[i][j]) {
              var ans = 0;
              ansdata.push(ans);
            } else {
              var ans = 1;
              ansdata.push(ans);
              var ans_ = ans_ + 1
            }
          }
        }
        const jsonData_ans = JSON.stringify(ansdata);
        localStorage.setItem('ans', jsonData_ans);
        const jsonData_ans_ = JSON.stringify(ans_);
        localStorage.setItem('ans_', jsonData_ans_);
        $('#save_status').val('データあり');

      } else {
        //-----------------------------------------------------------
        // データの順 安値,終値,始値,高値
        // ※Excelだと始値,高値,安値,終値の順番
        var data = new google.visualization.arrayToDataTable([
          basedata[0],
          basedata[1],
          basedata[1],
          basedata[1],
          basedata[1],
          basedata[2]
        ], true);
        console.log(data);
        // オプションの設定
        var options = {
          legend: 'none',
          vAxis: {
            minValue: 460,
            maxValue: 690,
            gridlines: {
              count: 21,
              color: '#0c5020'
            },
            title: '株価'
          },
          colors: ['darkslategray', '#004411'],
          animation: {
            startup: true,
            duration: 1000
          },
          backgroundColor: '#72a782'
        };

        // 指定されたIDの要素にローソク足を作成
        let chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

        // グラフの描画
        chart.draw(data, options);
      }
      $('#save_status').html('');
    }
  });
</script>

</html>