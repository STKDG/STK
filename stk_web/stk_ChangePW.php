

   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK-비밀번호 변경</title>
    <?php
    function check_password2($user_Npw, $user_Npw2){
        if($user_Npw === NULL||$user_Npw===''){
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 새로운 비밀번호가 입력되지 않았습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        }
        if($user_Npw === $user_Npw2)return 1;
        else{
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호와 확인 비밀번호가 일치하지 않습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        } 
    }
    function check_password($user_pw, $user_pw2){
        if($user_pw === NULL||$user_pw===''){
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 현재 비밀번호가 입력되지 않았습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        }
        if($user_pw === $user_pw2)return 1;
        else{
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 현재 비밀번호가 일치하지 않습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        } 
    }
    $host = 'localhost';
    $user = 'root';
    $pw = 'dpcmysql';
    $dbName = 'STK_ACCOUNT_DB';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
?>
</head>
<body>
    <div style="text-align:center;">
        <img src="images/changing.png" id="errorImg" style="width:150px; height:150px;">
        <p id="errorLog">변경중</p>
        <button onclick="location.href='stk_ChangePW.html'">비밀번호 변경 화면</button>
        <button onclick="location.href='stk_MyAccount.php'">비밀번호 변경 취소</button>
    </div> 
    <?php
    $user_Npw = $_POST['user_Npw'];
    $user_Npw2 = $_POST['user_Npw2'];
    $user_pw = $_POST['user_pw'];
    $user_id;
    $user_pw2;
    
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $sql = 'select *from STK_SIGNED_IN';
    $name = $mysqli->query($sql);
    while($row = mysqli_fetch_array($name)){
        if($user_ip == $row['user_ip']){
            $user_id = $row['user_id'];
        }
    }
    $sql = 'select *from STK_ACCOUNT';
    $name = $mysqli->query($sql);
    while($row = mysqli_fetch_array($name)){
        if($row['user_id'] == $user_id){
            $user_pw2 = $row['user_pw'];   
        }
    }
    if(check_password($user_pw, $user_pw2)){
        if(check_password2($user_Npw, $user_Npw2)){
            $sql = "update stk_account set user_pw = '$user_Npw' where user_id= '$user_id'";
            $mysqli->query($sql);
            echo "<script>location.href='stk_MyAccount.php';</script>";
        }
    }
    ?>
</body>
</html>