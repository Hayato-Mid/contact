<?php
// var_dump($_POST);
// phpinfo();
// 変数の初期化
$page_flag = 0;

if( !empty($_POST['confirm']) ) {

	$page_flag = 1;

} elseif( !empty($_POST['submit']) ) {
	
	$page_flag = 2;
	
	// ---------自動メール機能---------//
	//言語設定
	mb_language("Japanese");
  mb_internal_encoding("UTF-8");
	//変数とタイムゾーンを初期化
	$header = null;
	//ユーザー
	$auto_reply_subject = null;
	$auto_reply_text = null;
	//運営
	$admin_reply_subject = null;
	$admin_reply_text = null;
	
	date_default_timezone_set('Asia/Tokyo');
	
	//headerの定義
	$header = "MIME-Version: 1.0\n";
	$header .= "From: Hayato Midorikawa <black.has.it.all@gmail.com>\n";
	$header .= "Reply-To: Hayato Midorikawa<black.has.it.all@gmail.com>\n";

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$auto_reply_text .= "お問い合わせ内容：" . $_POST['contact'] . "\n\n";
	$auto_reply_text .= "Hayato Miedorikawa";

	// ユーザーへメール送信
	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);
	 
	// 運営側へ送るメールの件名
	$admin_reply_subject = "お問い合わせを受け付けました";
	
	// 本文を設定
	$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "氏名：" . $_POST['name'] . "\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$admin_reply_text .= "メールアドレス：" . $_POST['contact'] . "\n\n";

	// 運営側へメール送信
	mb_send_mail( 'black.has.it.all@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
	
	// ---------自動メール機能---------//
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./style.css" type="text/css" />
  <title>mail form</title>
</head>
<body>
  <h1>contact form</h1>
  
  <!--flag1-->
  <?php if ($page_flag === 1):?> 
  
    <!--確認ページ-->
     <form action="" method="post">
      <div class="form_wrapper">
      <div class="contents_container">
      <h3>お名前</h3>
      <?php echo $_POST['name']?>
      </div>
      
      <div class="contents_container">
      <h3>E-mail</h3>
      <?php echo $_POST['email']?>
      </div>
      
      <div class="contents_container">
      <h3>問い合わせ内容</h3>
      <?php echo $_POST['content']?>
      </div>
      </div>
      
      <div class="submit_container">
      <input type="submit" name="btn_back" value="戻る">
	    <input type="submit" name="submit" value="送信">
	    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
	    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
	    <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>">
      
      </div>
  </form>
  
  <!--end flag1-->
  <!--flag2-->
  
  <!--サンクスページ-->
  <?php elseif ($page_flag === 2):?> 
  <p class="thanks_cmt">ご連絡ありがとうございます。</p>
    <div class="submit_container">
      <a href="./" class="btn">TOP</a>
    </div>
  
  <!--end flag2-->
  <!--flag3-->
  
  <?php else: ?>
  
  <!--contactフォーム-->
  <form action="" method="post">
      <div class="form_wrapper">
      <div class="contents_container">
      <h3>お名前</h3>
      <input type="text" name="name" value="" maxlength="30" required/>
      </div>
      
      <div class="contents_container">
      <h3>E-mail</h3>
      <input type="text" name="email" value="" maxlength="100" required/>
      </div>
      
      <div class="contents_container">
      <h3>問い合わせ内容</h3>
      <textarea name="content"value="" rows="8" cols="40" maxlength="999" required></textarea>
      </div>
      </div>
      
      <div class="submit_container">
      <input type="submit" name="confirm" value="確認">
      </div>
  </form>
  <?php endif; ?>
  <!--end flag3-->
</body>
</html>