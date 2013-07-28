<?php
ini_set("display_errors", 1);
ini_set("session.use_only_cookies", 0);
ini_set("session.use_trans_sid", 0);
session_name("trans_sid_test");
session_start();

if (!isset($_SESSION['c1'])) {
    $_SESSION['c1'] = 0;
}
$_SESSION['c1']++;
?>
<html>
<body>
<h2>$_COOKIE</h2>
<pre>
<?php var_export($_COOKIE); ?>
</pre>
<h2>$_SESSION</h2>
<pre>
<?php var_export($_SESSION); ?>
</pre>
<h2>session_id() = <?php echo session_id(); ?></h2>
<hr>
<a href="./t01.php">a link</a><br>
<form action="./t01.php" method="POST">
<input type="text" name="dummy1" value="v1">
<input type="submit" value="POST">
</form>
<form action="./t01.php" method="GET">
<input type="text" name="dummy1" value="v2">
<input type="submit" value="GET">
</form>
</body>
</html>
