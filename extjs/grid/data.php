<?php
$sz = (isset($_REQUEST['total'])) ? (int)($_REQUEST['total']) : 10;
if ($sz < 1) {
    $sz = 1;
}
$email_domains = array();
for($i = 0; $i < 10; $i++) {
    $email_domains[] = '@mail' . $i . '.example.com';
}
$records = array();
for($i = 0; $i < $sz; $i++) {
    $records[] = array(
        'id' => $i,
        'name' => 'name' . $i,
        'email' => 'name' . $i . $email_domains[rand(0, 9)],
        'age' => rand(0, $sz),
        'active' => rand(0, 1) ? true : false,
        'birthday' => date('Y-m-d H:i:s', rand(1, time())),
    );
}

$json = array(
    'total' => $sz,
    'data' => $records,
    );

$json_opts = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;

echo json_encode($json, $json_opts);

