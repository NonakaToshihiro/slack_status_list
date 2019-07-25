# Slack status list

特定のワークスペースに所属するメンバーのステータスを一覧表示します。

動作させるには以下の手順を踏む必要があります。

1. https://api.slack.com/apps で [Create New App] を実行
1. Create a Slack App 画面で作成したいアプリの名前を入力しワークスペースを選択して [Create App] を実行
1. Basic Information 画面の Add features and functionality で [Permissions] を選択
1. OAuth & Permissions 画面の Scopes で `users:read` のパーミッションを選択し [Save Changes] を実行
1. OAuth & Permissions 画面で [Install App to Workspace] を実行
1. 確認画面で [インストール] を選択
1. OAuth & Permissions 画面の OAuth Access Token をコピー
1. `slack_status_list.php` の `$token` にコピーした OAuth Access Token を設定

現状の実装では、人数が多いと表示が完了するまでにかなり時間がかかります。
