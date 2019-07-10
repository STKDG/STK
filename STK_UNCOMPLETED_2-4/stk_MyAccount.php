<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK - 계정설정</title>
    <?php
        function checkLogin($mysqli){
            $sql = 'select *from STK_SIGNED_IN';
            $name = $mysqli->query($sql);
            if(!($row = mysqli_fetch_array($name))){
            echo "<script>location.href='stk_main.php';</script>";
            }
        }

        $host = 'localhost';
        $user = 'root';
        $pw = 'dpcmysql';
        $dbName = 'STK_ACCOUNT_DB';
        $mysqli = new mysqli($host, $user, $pw, $dbName);

        checkLogin($mysqli);
    ?>
</head>
<body>
    <button onclick="window.open('stk_ChangePW.php', '비밀번호 재설정', 'width=435, height=300, scrollbars= 0, toolbar=0, menubar=no');">
        비밀번호 재설정</button>
    <button onclick="location.href='stk_main.php'">메인 화면</button>
</body>
</html>