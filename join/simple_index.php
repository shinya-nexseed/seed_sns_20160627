<?php
    session_start();

    $error = array();
    if (!empty($_POST)) {
        // エラー項目の確認
        if ($_POST['nick_name'] == '') {
            $error['nick_name'] = 'blank';
        }

        if ($_POST['email'] == '') {
            $error['email'] = 'blank';
        }

        if ($_POST['password'] == '') {
            $error['password'] = 'blank';
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>SeedSNS</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/form.css" rel="stylesheet">
    <link href="../assets/css/timeline.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
  </head>
  <body>

    <legend>会員登録</legend>
    <form method="post" action="">
      <!-- ニックネーム -->
      <div>
        <label>ニックネーム</label>
        <input type="text" name="nick_name" placeholder="例： Seed kun">
        <?php if(isset($error['nick_name'])): ?>
            <?php if($error['nick_name'] == 'blank'): ?>
                <p class="error">ニックネームを入力して下さい。</p>
            <?php endif; ?>
        <?php endif; ?>
      </div>
      <!-- メールアドレス -->
      <div>
        <label>メールアドレス</label>
        <input type="email" name="email" placeholder="例： seed@nex.com">
        <!-- 修正ポイント -->
        <?php if($error['email'] == 'blank'): ?>
            <p class="error">メールアドレスを入力して下さい。</p>
        <?php endif; ?>
      </div>
      <!-- パスワード -->
      <div>
        <label>パスワード</label>
        <input type="password" name="password" placeholder="">
        <!-- 修正ポイント -->
        <?php if($error['password'] == 'blank'): ?>
            <p class="error">パスワードを入力して下さい。</p>
        <?php endif; ?>
      </div>
      <!-- プロフィール写真 -->
      <div>
        <label>プロフィール写真</label>
        <input type="file" name="picture_path">
      </div>

      <input type="submit" value="確認画面へ">
    </form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>
