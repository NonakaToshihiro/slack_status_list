<?php

function getJson($api_and_params)
{
	$token = "TODO: input your token";
	$url = sprintf("https://slack.com/api/%stoken=%s", $api_and_params, $token);
	
	$json = file_get_contents($url);

	return json_decode($json, true);
}

$users_list = getJson("users.list?");
if (!$users_list['ok']) {
    printf("Error from users.list: %s", $users_list['error']);
    return;
}

echo '<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8" /><title>Slack Status List</title></head><body><h1>Slack Status List</h1>';

echo "<p><b>名前の太字</b>はアクティブであることを表します。</p>";

echo "<table cellpadding=5>";

for ($i = 0; $i < count($users_list['members']); ++$i){
    $real_name = $users_list['members'][$i]['real_name'];
    if ($deleted || $always_active) {	// ボットは $always_active が true になる
        continue;
    }
   
    $real_name = $users_list['members'][$i]['profile']['real_name'];
    $icon = urldecode($users_list['members'][$i]["profile"]['image_32']);
    $status_text = $users_list['members'][$i]["profile"]['status_text'];

	$api_and_params = sprintf("users.getPresence?user=%s&", $users_list['members'][$i]['id']);
	$presence_json = getJson($api_and_params);
	$presence = $presence_json['ok'] ? $presence_json['presence'] : $presence_json['error'];
	$style = $presence == "active" ? "font-weight:bold" : "";
   
	printf("<tr><td><img src=\"$icon\" /></td><td><span style=\"$style\">$real_name</span><br />$status_text</tr>");
}

echo "</table>";

echo '</body></html>';

?>
