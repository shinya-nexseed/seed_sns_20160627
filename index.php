<?php
    session_start();
    require('dbconnect.php');

    // $_SESSION['id']を使ってログインユーザーのデータを取得

    // 「$_SESSION['id']が存在する」
    // これがログインしているかどうかの条件
    if (isset($_SESSION['id'])) {
        // ログインしている場合

        // ログインユーザーの情報をデータベースより取得
        $sql = sprintf('SELECT * FROM `members`
                   WHERE `member_id`=%d',
                   mysqli_real_escape_string($db, $_SESSION['id']));

        $record = mysqli_query($db, $sql) or die(mysqli_error($db));
        $member = mysqli_fetch_assoc($record);

    } else {
        // ログインしていない場合

        // loginページへリダイレクトさせる
        header('Location: login.php');
        exit();
    }
?>


<p>
  <?php echo $member['member_id']; ?>
</p>
<p>
  <?php echo $member['nick_name']; ?>
</p>
<p>
  <?php echo $member['email']; ?>
</p>





