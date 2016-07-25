<?php
		session_start();
		require('dbconnect.php');

		if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
				// ログインしている
				$_SESSION['time'] = time();

				$sql = sprintf('SELECT * FROM members WHERE member_id=%d',
					mysqli_real_escape_string($db, $_SESSION['id'])
				);
				$record = mysqli_query($db, $sql) or die(mysqli_error($db));
				// ログインしているメンバー情報すべてが入る
				$member = mysqli_fetch_assoc($record);
		} else {
				// ログインしていない
				header('Location: login.php');
				exit();
		}

		// 投稿を記録する
		if (!empty($_POST)) {
				if ($_POST['message'] != '') {
						$sql = sprintf('INSERT INTO tweets SET member_id=%d, tweet="%s", created=NOW()',
							mysqli_real_escape_string($db, $member['member_id']),
							mysqli_real_escape_string($db, $_POST['message'])
						);
						mysqli_query($db, $sql) or die(mysqli_error($db));
						header('Location: sample_index.php');
						exit();
				}
		}

		// 投稿を取得する
		$sql = sprintf('SELECT m.nick_name, m.picture_path, t.* FROM members m, tweets t WHERE m.member_id=t.member_id ORDER BY t.created DESC');

		$posts = mysqli_query($db, $sql) or die(mysqli_error($db));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ひとこと掲示板</title>
</head>

<body>
<div id="wrap">
	<div id="head">
		<h1>ひとこと掲示板</h1>
	</div>
	<div id="content">
		<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
	<form action="sample_index.php" method="post">
		<dl>
			<dt><?php echo htmlspecialchars($member['nick_name']); ?>さん、メッセージをどうぞ</dt>
			<dd>
			<textarea name="message" cols="50" rows="5"></textarea>
			<input type="hidden" name="reply_post_id" value="<?php echo htmlspecialchars($_REQUEST['res'], ENT_QUOTES, 'UTF-8'); ?>" />
			</dd>
		</dl>
		<div>
		<p>
			<input type="submit" value="投稿する" />
		</p>
		</div>
	</form>

<?php while($post = mysqli_fetch_assoc($posts)): ?>
	<div class="msg">
	  <img src="member_picture/<?php echo htmlspecialchars($post['picture_path'], ENT_QUOTES, 'UTF-8'); ?>" width="48" height="48" alt="<?php echo htmlspecialchars($post['nick_name'], ENT_QUOTES, 'UTF-8'); ?>" />
	  <p>
	    <?php echo htmlspecialchars($post['tweet'], ENT_QUOTES, 'UTF-8'); ?>
	    <span class="name">（<?php echo htmlspecialchars($post['nick_name'], ENT_QUOTES, 'UTF-8'); ?>）</span>
	  </p>
	  <p class="day">
	    <?php echo htmlspecialchars($post['created'], ENT_QUOTES, 'UTF-8'); ?>
	  </p>
	</div>
<?php endwhile; ?>

</div>
	<div id="foot">
		<p><img src="images/txt_copyright.png" width="136" 	height="15" alt="(C) H2O SPACE, Mynavi" /></p>
	</div>
</div>
</body>
</html>
