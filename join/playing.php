<?php
    // 変数
    $name = 'Shinya Hirai'; // 定義
    echo $name; // 実行

    // 配列
    $my_profiles1 = array('190cm', '88kg', 'Japanese', '26'); // 定義
    var_dump($my_profiles1);  // 実行
    echo '<br>';
    echo $my_profiles1[0]; // 配列から指定した要素をひとつ取得して表示
    echo $my_profiles1[1];

    // 連想配列
    $my_profiles2 = array('height' => '190cm', 'weight' => '88kg', 'nationality' => 'Japanese', 'age' => '26'); // 定義
    echo '<br>';
    var_dump($my_profiles2);  // 実行
    echo $my_profiles2['height'];
    echo $my_profiles2['age'];

    // $_POSTの内容
    // 送信されたformタグの要素を元に連想配列を生成する
    // 連想配列の要素数はinputタグの数で決まる (typeがsubmitのものは除外)
    // inputタグのnameに指定されている文字列をキーに、実際に入力された内容を値にする

    // 下記フォームの入力値を例に$_POSTを生成すると。。。
    // $_POST = array('nick_name' => 'ネクシード', 'email' => 'php@nexseed.net', 'password' => 'seedkun');
    // $_POSTはPHPの予約語なので、実際に自分で生成することはできない。
    // 今回は変わりに$postとしている

    echo '<br>';
    // $_POSTを実行 (画面に内容を出力)
    var_dump($_POST);
    echo '<br>';
    echo $_POST['nick_name'];
    // $_大文字 という名前の変数のことを「スーパーグローバル変数」と言います。
    // これはPHP言語側が用意した特別な変数で、自分で定義する必要がない。
    // それぞれ適切なタイミングで変数が定義されます。
    // 今後使っていくものの例
    // $_SESSION
    // $_COOKIE
    // $_GET
    // $_REQUEST
    // などなど

    echo '<br>';
    // sprintf()関数
    // 複数の文字列を結合するための関数
    $parag = sprintf('My %s is %s. Hello!', 'height' , '190cm');
    echo $parag;

    // sha1()関数
    // 指定した文字列を暗号化 (ハッシュ化) してくれる関数
    $str = sha1('hogehoge');
    echo '<br>';
    echo $str;

 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="UTF-8">
 </head>
 <body>
  <!--
    methodにPOSTが指定されたformタグの中にある送信ボタン(inputタグ)が押されると、
    $_POST変数が生成される
  -->
  <form action="" method="POST">
    <input type="text" name="nick_name"> <!-- 値 : ネクシード -->
    <input type="text" name="email"> <!-- 値 : php@nexseed.net -->
    <input type="text" name="password"> <!-- 値 : seedkun -->
    <input type="submit" value="送信">
  </form>

 </body>
 </html>
