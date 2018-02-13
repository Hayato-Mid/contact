<?php

// 変数の初期化
$page_flag = 0;

//サニタイズ
$clean = array();
 
if( !empty($_POST) ){
    foreach( $post as $key => $value){
        $clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
    }
}


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
	$header .= "From: Hayato Midorikawa <@gmail.com>\n";
	$header .= "Reply-To: Hayato Midorikawa<@gmail.com>\n";

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
	mb_send_mail( '@gmail.com', $admin_reply_subject, $admin_reply_text, $header);
	
	// ---------自動メール機能---------//
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
    <link rel="stylesheet" href="./css/style.1.css" />   
    
    <title>contact | Hayato Midorikawa</title>
</head>

<body id="contact_form">

<!--    global_nav-->
   
    <header>
        <nav>
            <ul id="gl_nav">
                <li><a href="" id="disp2">Home</a></li>
                <li><a href="#section1">Profile</a></li>
                <li><a href="#section2">My Skill</a></li>
                <li><a href="#section3">Use Tool</a></li>
                <li><a href="#section4">Works</a></li>
                <li><a href="#section5">Contact</a></li>
            </ul>
        </nav>

    </header>
    
    
    
    
<!--    section_top-->
 
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
      <h3>性別</h3>
            <?php 
            if( $_POST['gender'] === "1" ){ echo '男性'; }
		        else{ echo '女性'; } 
		        ?>
      </div>
      
      <div class="contents_container">
      <h3>年齢</h3>
            <?php 
            if( $_POST['age'] === "1" ){ echo '〜19才'; }
		        elseif( $_POST['age'] === "2" ){ echo '20才〜29才'; }
		        elseif( $_POST['age'] === "3" ){ echo '30才〜39才'; }
		        elseif( $_POST['age'] === "4" ){ echo '40才〜49才'; }
		        elseif( $_POST['age'] === "5" ){ echo '50才〜'; }
		        ?>
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
	    <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
    	<input type="hidden" name="age" value="<?php echo $_POST['age']; ?>">
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
      <a href="https://contact-hayato19.c9users.io/contact.php" class="btn">TOP</a>
    </div>
  
  <!--end flag2-->
  <!--flag3-->
  
  <?php else: ?>
  
  <!--contactフォーム-->
  <form action="" method="post" name="contact">
      <div class="form_wrapper">
      <div class="contents_container">
      <h3>お名前</h3>
      <input type="text" name="name" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>" maxlength="30" required/>
      </div>
      
      <div class="contents_container">
      <h3>性別</h3>
      <div class="radio_box">
        <label for="gender1">男性</label>
          <input type="radio" name="gender" id="gender1" value="1" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "1" ){ echo 'checked'; } ?> maxlength="30" required/>
        <label for="gender2">女性</label>
        <input type="radio" name="gender" id="gender2" value="2" <?php if( !empty($_POST['gender']) && $_POST['gender'] === "2" ){ echo 'checked'; } ?> maxlength="30" required/>
      </div>
      </div>
      
      <div class="contents_container">
        <h3>年齢</h3>
        <select name="age" id="age" required>
          <option value="">選択してください</option>
          <option value="1" <?php if( !empty($_POST['age']) && $_POST['age'] === "1" ){ echo 'selected'; } ?>>~19才</option>
          <option value="2" <?php if( !empty($_POST['age']) && $_POST['age'] === "2" ){ echo 'selected'; } ?>>20~29才</option>
          <option value="3" <?php if( !empty($_POST['age']) && $_POST['age'] === "3" ){ echo 'selected'; } ?>>30~39才</option>
          <option value="4" <?php if( !empty($_POST['age']) && $_POST['age'] === "4" ){ echo 'selected'; } ?>>40~49才</option>
          <option value="5" <?php if( !empty($_POST['age']) && $_POST['age'] === "5" ){ echo 'selected'; } ?>>50才~</option>
        </select>
      </div>
      
      
      <div class="contents_container">
      <h3>E-mail</h3>
      <input type="text" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" maxlength="100" required/>
      </div>
      
      <div class="contents_container">
      <h3>問い合わせ内容</h3>
      <textarea name="content"value="" rows="8" cols="40" maxlength="999" required><?php if( !empty($_POST['content']) ){ echo $_POST['content']; } ?></textarea>
      </div>
      </div>
      
      <div class="submit_container">
      <input type="submit" name="confirm" id="submit" value="確認">
      </div>
  </form>
  <?php endif; ?>
  <!--end flag3-->

  
</body>

</html>
