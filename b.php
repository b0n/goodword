<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

class util {

	public function random_choice($sources) {
		$max = count($sources) - 1;
		return $sources[rand(0, $max)];
	}

}

$file = "b.json";
if (file_exists($file)) {
	$json = file_get_contents($file);
	$messages = json_decode($json);
}
if (!isset($messages) || !$messages) {
	$messages = array(
		"これまでは一生懸命、これからは要領よく！人生は短い。",
		"前に出てリスクを取ること。失敗しても死なないし、別にいいやん",
		"今年は精神修行。レベルアップを目指す。すべては自分に用意されたミッション",
		"やりたいことはいくらでも出てくる。やれる時間は限られている。スケジュールを埋めるしかない。その前に何をやりたいのか何をやるのか考えていくこと。",
		"やり方は自分で考える。問われているのは成果だから。自分で考えること。",
		'ブログは自分を知ってもらうために書く。後からでは間にあわない。',
		'重いもの持つときは、重いもの持つぞと言ってから持つ。',
		'楽しいこと考えようよ。今死ぬかも知れんぞ。',
		'時間の使い方の比率変えた。人生変わった。input:output:communication = 1:7:2。',
	);
	file_put_contents($file, json_encode($messages));
}

if ( isset($_POST['word']) && $_POST['word'] && !array_search($_POST['word'], $messages) ) {
	array_push($messages, $_POST['word']);
	file_put_contents($file, json_encode($messages));
}

if( isset($argv) ) {
	if ( count($argv) > 1 ) {

		$to = "hoge@example.com";
		$subjects = array(
			"よっしゃやったったー",
			"よっしゃー",
			"よし",
		);

		$signature = "ポジティブサーより";

		$util = new util();
		$subject = $util->random_choice($subjects);
		$message = $util->random_choice($messages);
		$message = $message . " $signature";
		$headers = null;
		$params = null;
		mb_send_mail($to, $subject, $message, $headers, $params);
	}

	exit;

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/docs.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png">
  </head>
<body>
<div class="container">
	<header class="jumbotron masthead">
		<div class="inner">
			<h1>Good word.</h1>
			<p>Send good word to you per hour.</p>
		</div>
	</header>
	<hr class="soften">
	<ul><?php foreach ($messages as $message) : ?>
		<li><?php echo $message; ?></li>
	<?php endforeach; ?></ul>
	<hr class="soften">
	<form method="POST">
	<textarea name="word"></textarea>
	<input type="submit" value="Add">
	</form>
</div>
</body>
</html>
