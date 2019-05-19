<?php
$access_token = 'E6AIJe2emkkTPjsF2ob/Fpu9MIb9sivs0lCQMKI4Tkoc5wnkOfB1rxZHr7XVdWpZxzo9cEqayKclErQSycfJmMlKsGuBF+Q77SS67yvl95QQVF4TwwBFb1b2pOU0rkM5rJWtVJHK2md89aggRd9IoQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
