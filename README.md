簡単に、セッションを利用した会員登録機能を作ってみました。

login.php // ログイン画面
regist.php // 新規登録画面
main.php // 登録済みユーザーのメイン画面
logout.php // ログアウト画面
registSucces.php // 新規登録成功画面

現状、パスワードが平文でデータベースに保存されているため、実際にWebアプリケーションで運用する際には、パスワードをハッシュ化させる処理を追加する必要があります。
