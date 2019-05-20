<?php
curl -X GET \
-H 'Authorization: Bearer {1574629918}' \https://api.line.me/v2/oauth/verify
{
  "channelId":1574629918,
  "mid":"Ue8db11d8a42859e27190b633b89b321e"
}

$access_token = '1574629918';


$channel_token = 'qUtNPu8a0rxW/G+Di3or3/CahLygNd13Hu7bjLCIEcEelj03SrXos1f7V1DWaGQhxzo9cEqayKclErQSycfJmMlKsGuBF+Q77SS67yvl95R8myd0xlV1YjqUWpSrsRp6tLrQzmwgK0hDQfutIYTBHAdB04t89/1O/w1cDnyilFU=';

$channel_secret = '7dc268634ce661c05a98ddae277cb16e';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
   // Get text sent
   $text = $event['message']['text'];
   // Get replyToken
   $replyToken = $event['replyToken'];

   // Build message to reply back
   $messages = [
    'type' => 'text',
    'text' => $text
   ];

   // Make a POST Request to Messaging API to reply to sender
   $url = 'https://api.line.me/v2/bot/message/reply';
   $data = [
    'replyToken' => $replyToken,
    'messages' => [$messages],
   ];
   $post = json_encode($data);
   $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $result = curl_exec($ch);
   curl_close($ch);

   echo $result . "\r\n";
  }
 }
}
echo "OK";
