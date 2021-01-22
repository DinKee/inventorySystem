<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>系統登入</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <style>
            * {position: relative;}
                /* border: solid 1px black;} */
            html, body {
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
            }
            #login {
                /* border: solid 1px black; */
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                width: 300px;
                height: fit-content;
                text-align: center;
                display: inline-block;
                background-color: #ffe6cc;
                box-shadow: 5px 5px 20px rgba(0,0,0,0.6);
                border-radius: 6px;
            }
            .logo {width: 35px; height: 35px;margin: 10px;}
            h3 {text-align: center;}
            button {
                    text-align: center;
                    margin: 30px 10px;
                    width: 80%;
                    border-radius: 12px;}
            input {
                width: 70%;
                border-radius: 4px;}
            .account, .password {
                display: flex;
                justify-content: center;
                align-items: center; }
        </style>
    </head>
    <body>
        <div id="login">
            <form action="index.php" method="POST">
                <h3>登　入</h3><br>
                <div class="account">
                    <img class="logo" src="https://www.flaticon.com/svg/static/icons/svg/61/61205.svg">
                    <input name="username" type="text" size="10" maxlength="20" placeholder="帳號" required>
                </div>
                <div class="password">
                    <img class="logo" src="https://www.flaticon.com/svg/static/icons/svg/3064/3064197.svg">
                    <input name="password" type="password" size="10" maxlength="20" placeholder="密碼" required>
                </div>
                <button type="submit">登　入</button>
            </form>            
        </div>
        <?php
            session_start();  // 啟用交談期
            $account = "";  $password = "";
            // 取得表單欄位值
            if ( isset($_POST["username"]) )
            $account = $_POST["username"];
            if ( isset($_POST["password"]) )
            $password = $_POST["password"];
            // 檢查是否輸入使用者名稱和密碼
            if ($account != "" && $password != "") {
                // 建立MySQL的資料庫連接 
                require_once("dbconnect.inc");
                // 建立SQL指令字串
                $sql = "SELECT * FROM Member WHERE m_password='";
                $sql.= $password."' AND m_account='".$account."'";
                // 執行SQL查詢
                $result = mysqli_query($link, $sql);
                $total_records = mysqli_num_rows($result);
                // 是否有查詢到使用者記錄
                if ( $total_records > 0 ) {
                    // 成功登入, 指定Session變數
                    $_SESSION["login_session"] = true;
                    header("Location: homepage.php");
                } else {  // 登入失敗
                    echo "<div style = 'font-size: 40px; text-align: center; height: 120px; background: red; z-index:100000; position: relative; top: 300px'>";
                    echo "<font color=\"WHITE\">登入失敗</font>";
                    echo "</div>";
                    $_SESSION["login_session"] = false;
                }
                mysqli_close($link);  // 關閉資料庫連接  
            }
        ?>
    </body>
</html>