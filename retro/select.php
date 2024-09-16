<?php
//エラー表示 (全部これ)
ini_set("display_errors", 1);

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM kadai08");
$status = $stmt->execute();

//３．データ表示
$values="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>レトロスペクティブ一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- DataTablesのCSSを読み込む -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<style>div{padding: 10px;font-size:16px;}
  /* DataTablesのカスタムスタイリング */
  .dataTables_wrapper {
    margin: 20px 0;
  }

  table.dataTable thead {
    background-color: #343a40; /* ヘッダーの背景色 */
    color: white; /* ヘッダーの文字色 */
  }

  table.dataTable tbody tr:nth-child(even) {
    background-color: #f8f9fa; /* 偶数行の背景色 */
  }

  table.dataTable tbody tr:hover {
    background-color: #f1f1f1; /* ホバー時の背景色 */
  }

  table.dataTable thead th,
  table.dataTable tbody td {
    padding: 12px 15px;
    border: 1px solid #dee2e6; /* セルの境界線 */
  }

  .btn-action {
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
  }

  .btn-update {
    background-color: #007bff;
    color: white;
    border: none;
  }

  .btn-delete {
    background-color: #dc3545;
    color: white;
    border: none;
  }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ホームに戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div class="container">
  <table id="table_id" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>名前</th>
        <th>URL</th>
        <th>メモ</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($values as $v){ ?>
        <tr>
          <td><?=$v["name"]?></td>
          <td><a href="<?=$v["url"]?>" target="_blank">リンク</a></td>
          <td><?=$v["memo"]?></td>
          <td><a href="detail.php?id=<?=$v['id']?>" class="btn-action btn-update">更新</a></td>
          <td><a href="delete.php?id=<?=$v['id']?>" class="btn-action btn-delete">削除</a></td>
        </tr>
      <?php }?>
    </tbody>
  </table>
</div>
<!-- Main[End] -->

<!-- jQueryの読み込み -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTablesのJavaScriptを読み込む -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
  //JSON受け取り
  const j = JSON.parse('<?=$json?>');
  console.log(j);

  // DataTablesの初期化処理
  $(document).ready(function() {
    $('#table_id').DataTable({
      "pagingType": "full_numbers",
      "language": {
        "lengthMenu": "1ページあたり _MENU_ 件表示",
        "zeroRecords": "該当するデータが見つかりません",
        "info": "ページ _PAGE_ / _PAGES_ を表示中",
        "infoEmpty": "利用できるデータがありません",
        "infoFiltered": "(_MAX_ 件からフィルタリング)"
      }
    });
  });

</script>
</body>
</html>
