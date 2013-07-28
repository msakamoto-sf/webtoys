<?php
$strgroup = array(
	// exclude i, l, I, 1, 0, O
	"sa" => array(
		"alias" => "Small Alphabet",
		"weight" => 8,
		"data" => "abcdefghijkmnopqrstuvwxyz"),
	"la" => array(
		"alias" => "Large Alphabet",
		"weight" => 8,
		"data" => "ABCDEFGHJKLMNPQRSTUVWXYZ"),
	"num" => array(
		"alias" => "Number",
		"weight" => 4,
		"data" => "2345679"),
	"m1" => array(
		"alias" => "Marks",
		"weight" => 3,
		"data" => "!/=+:#,@$-%._"),
	);

function make_passwd($sg, $len) {
	global $strgroup;

	$passwd = "";
	for($i = 0; $i < $len; $i++) {
		$sg_type = decide_type($sg);
		$d = $strgroup[$sg_type]["data"];
		$passwd .= decide_char($d);
	}
	return $passwd;
}

function decide_char($str) {
	$l = strlen($str);
	$r = rand(0, $l - 1);
	return $str[$r];
}

function decide_type($sg) {
	global $strgroup;

	$sg_sz = count($sg);
	if($sg_sz == 1) {
		return $sg[0];
	}

	do {
		$sg_idx = rand(0, $sg_sz - 1);
		$sg_type = $sg[$sg_idx];
		$weight = $strgroup[$sg_type]["weight"];
		$t = rand(1, 10);
		$t = 10 - $t;
	} while($t > $weight);

	return $sg_type;
}

$pwdlen = isset($_GET['len']) ? $_GET['len'] : 8;
$make_count = isset($_GET['cnt']) ? $_GET['cnt'] : 3;

if(!isset($_GET['sg']) || !is_array($_GET['sg'])) {
	$sg[] = "sa";
} else {
	$sg = $_GET['sg'];
}

?>
<html>
<head>
<title>make password</title>
<style type="text/css">
<!--
body {
	font-family: monospace;
}
-->
</style>
</head>
<body>
<form action="" method="GET">
<h2>Choice Character Group</h2>
<table border="1">
<?php
foreach($strgroup as $k => $group) {
	printf("<tr>"
		.'<td><input type="checkbox" name="sg[]" value="%s" %s></td>'
		."<th>%s</th><td>%s</td></tr>\n",
		$k, (in_array($k, $sg) ? 'checked="1"' : ''), 
		$group["alias"], $group["data"]);
}
?>
</table>
How long password would you make ? ... <input type="text" name="len" value="<?php echo $pwdlen; ?>"><br>
How much password would you make ? ... <input type="text" name="cnt" value="<?php echo $make_count; ?>"><br>
<input type="submit" value="make password">
</form>

<h2>passwords.</h2>
<?php
for($i = 0; $i < $make_count; $i++) {
	echo make_passwd($sg, $pwdlen);
	echo "<br>\n";
}
?>
</body>
</html>
