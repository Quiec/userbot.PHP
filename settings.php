<?php
//settings
$settings = [
  'session' => 'sessions/default.madeline',
  'readmsg' => false,
  'old_update_parser' => false,
  'multithread' => false,
  'auto_reboot' => true
];

//functions
function sm($chatID, $text, $reply = 0, $parsemode = 'HTML') {
  global $update;
  global $MadelineProto;
  if (isset($chatID) and isset($text) and $reply == 0) $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $text, 'parse_mode' => $parsemode], ['noResponse' => true]);
  if (isset($chatID) and isset($text) and $reply == 1) $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $text, 'reply_to_msg_id' => $update['message']['id'], 'parse_mode' => $parsemode], ['noResponse' => true]);
  return true;
}
function em($chatID, $text, $msgid, $parsemode = 'HTML') {
  global $update;
  global $MadelineProto;
  if (isset($chatID) and isset($text)) $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msgid, 'message' => $text, 'parse_mode' => $parsemode]);
   return true;
}
function dm($msgid) {
  global $update;
  global $MadelineProto;
$MadelineProto->messages->deleteMessages(['revoke' => true, 'id' => [$msgid], ]); 
  return true;
}
