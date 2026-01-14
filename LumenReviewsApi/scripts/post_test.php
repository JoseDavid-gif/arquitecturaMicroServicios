<?php

$data = json_encode([
    'book_id' => 1,
    'review' => 'Muy buena',
    'rating' => 5,
    'reviewer' => 'Ana'
]);

$opts = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n",
        'content' => $data,
    ]
];

$context = stream_context_create($opts);
$res = @file_get_contents('http://localhost:8003/reviews', false, $context);
if ($res === false) {
    // try to show last error
    $err = error_get_last();
    echo "REQUEST_FAILED\n";
    if ($err) echo $err['message'];
    exit(1);
}

echo $res;