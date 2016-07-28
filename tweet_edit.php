<?php
    session_start();
    require('dbconnect.php');

    // URLにパラメータidが存在しなければindex.phpへ強制遷移
    if (empty($_REQUEST['id'])) {
        header('Location: sample_index.php');
        exit();
    }

    // もし$_POSTが存在すれば、UPDATE処理
    if (!empty($_POST)) {
        // UPDATE処理
        echo 'フォームが送信されました。';
        // 1, データベースに接続
          // すでにdbconnect.phpがこなしている
        // 2, SQL文を作成
        // UPDATE文
        // UPDATE `テーブル名` SET カラム1=値1 WHERE 条件
        $sql = sprintf('UPDATE `tweets` SET `tweet`="%s" WHERE `tweet_id`=%d',
              $_POST['tweet'],
              $_REQUEST['id']
          );
        // 3, SQL文を実行
        mysqli_query($db, $sql) or die(mysqli_error($db));

        // header関数を使って好きなページに遷移させる
    }

    // 投稿を取得する
    $sql = sprintf('SELECT m.nick_name, m.picture_path, t.* FROM members m, tweets t WHERE m.member_id=t.member_id AND t.tweet_id=%d ORDER BY t.created DESC',
      mysqli_real_escape_string($db, $_REQUEST['id'])
    );
    $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"
/>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ひとこと掲示板</title>
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ひとこと掲示板</h1>
  </div>
  <div id="content">
  <p>&laquo;<a href="index.php">一覧にもどる</a></p>
<?php
if ($post = mysqli_fetch_assoc($posts)):
?>

    <div class="msg">
    <img src="member_picture/<?php echo htmlspecialchars($post['picture_path'], ENT_QUOTES, 'UTF-8'); ?>" width="48" height="48" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>" />
    <p>
      <span class="name">
        （<?php echo $post['nick_name']; ?>）
      </span>
      <form action="" method="post">
        <textarea name="tweet"><?php echo $post['tweet']; ?></textarea>
        <!-- $_POST['tweet']でこのtextareaの値を取得できる -->
        <input type="submit" value="更新">
      </form>
    </p>

  <p class="day">
    <?php echo htmlspecialchars($post['created'], ENT_QUOTES, 'UTF-8'); ?>
  </p>
</div>

<?php
else:
?>
  <p>その投稿は削除されたか、URLが間違えています</p>
<?php
endif;
?>
</div>

<div id="foot">
  <p><img src="images/txt_copyright.png" width="136" height="15" alt="(C) H2O SPACE, Mynavi" />
  </p>
</div>

</div>
</body>
</html>
