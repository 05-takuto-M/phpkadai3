<!-- 処理の流れ
表示ファイル（todo_read.php）へアクセス時，DB接続する．
データ参照用SQL作成→実行．
取得したデータをHTMLに埋め込んで画面を表示．
※必要に応じて，並び替えやフィルタリングを実施してみよう． -->

<?php
// 新規データ作成の場合と同様の処理
// DB接続
$dbn ='mysql:dbname=gsacs_d03_05;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// require_once('functions.php');

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}


// SQL作成&実行
// データ作成処理と同様にSQLを記述して実行する．今回は「ユーザが入力したデータ」を使用しないのでバインド変数は不要．

// また，$statusには実行結果が入るが，この時点ではまだデータ自体の取得はできていない点に注意．

$sql = 'SELECT * FROM product_todo_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// SQL実行後の処理
// SQLの実行に失敗した場合はエラーを表示して処理を中止する．

// SQLが正常に実行された場合は以下の流れで処理が実行される．

// fetchAll()関数でデータ自体を取得する．
// 繰り返し処理を用いて，取得したデータからHTMLタグを生成する．
// （HTML内の任意の位置に作成したタグを設置

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:'.$error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output1 = "";
  foreach ($result as $record) {
    $output1 .= "
      <tr>
        <td>{$record["deadline"]}</td>
        <td>{$record["todo"]}</td>
        <td>{$record["reason"]}</td>
      </tr>
    ";
  }
}
?>


<?php
require_once('functions.php');

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得
    $sql = 'SELECT * FROM images ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();

} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];

        $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();
    }
    header('Location:list.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Images</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
  <!--Todoのセクション-->
  <div>
<div>
  <form action="todo_create.php" method="POST">
    <fieldset>
      <legend>MyProduct_todoリスト（入力画面）</legend>
      <div>
        todo: <input type="text" name="todo">
      </div>
      <div>
        reason: <input type="text" name="reason">
      </div>
      <div>
        deadline: <input type="date" name="deadline">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>
  </div>
  <div>
  <fieldset>
  <legend>MyProduct_todoリスト（一覧）</legend>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th>reason</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
      <tr>
        <div>
        <td><?= $output1 ?></td>
        </div>
      </tr>
      </tbody>
    </table>
  </fieldset>
  </div>
  </div>
  <!--Todoのセクション-->
  <!--Imageのセクション-->
  <div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <?php for($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                        <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100px" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                        <h5><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size']/1000, 2); ?> KB)</h5>
                        <a href="javascript:void(0);" 
                        onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">
                        <i class="far fa-trash-alt"></i> 削除</a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
        <div class="col-md-4 pt-4 pl-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>画像を選択</label>
                    <input type="file" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
</div>

<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($images); $i++): ?>
                <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>

        <div class="carousel-inner">
        <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                </div>
            <?php endfor; ?>
        </div>

        <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
<!--Imageのセクション-->
</body>
</html>