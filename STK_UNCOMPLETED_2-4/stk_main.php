<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="stk_main.css">
    <title>STK - International</title>
    <?php
        function loadSignedIn(){
    ?>
    <script>
        var toLoad2 = document.getElementById('toLoad2');
        
        var MyAccount = document.createElement('button');
        MyAccount.addEventListener('click', function(){
            location.href='stk_MyAccount.php'
        });
        var MyAccountText = document.createTextNode('계정 설정');
        toLoad2.appendChild(MyAccount).appendChild(MyAccountText);
        
        var LogOut = document.createElement('button');
        LogOut.addEventListener('click', function(){
            
        });
        var LogOutText = document.createTextNode('로그아웃');
        toLoad2.appendChild(LogOut).appendChild(LogOutText);</script>";
    </script>
    <?php
        }   
        function loadNSignedIn(){
    ?>
    <script>
        var toLoad = document.getElementById('toLoad1');

        var textID = document.createTextNode('아이디:');

        var inputID = document.createElement('input');
        inputID.type = 'text';
        inputID.name = 'user_id';
        toLoad.appendChild(textID)
        toLoad.appendChild(inputID);

        var textPW = document.createTextNode('비밀번호:');
        var inputPW = document.createElement('input');
        inputPW.type = 'password';
        inputPW.name = 'user_pw';
        toLoad.appendChild(textPW)
        toLoad.appendChild(inputPW);

        var inputLogIn = document.createElement('input');
        inputLogIn.type = 'submit';
        inputLogIn.value = '로그인';
        toLoad.appendChild(inputLogIn);</script>";
    </script>
    <?php
        } 
        function check_login($mysqli){
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $sql = 'select *from STK_SIGNED_IN';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($user_ip == $row['user_ip']){
                    loadSignedIn($mysqli);
                    return 1;
                }
            }
            echo "<script>console.log('PHP Console: Not signed in')</script>";
            loadNSignedIn();
            return 0;
        }
        $host = 'localhost';
        $user = 'root';
        $pw = 'dpcmysql';
        $dbName = 'STK_ACCOUNT_DB';
        $mysqli = new mysqli($host, $user, $pw, $dbName);
        if($mysqli){echo "<script>console.log( 'PHP_Console: 계정 데이터베이스 접근 성공' );</script>";}
?>
</head>
<body>
    
    <img src="images/stk_logo.png" id="stklogo">
    <form method="POST" action="stk_main_login.php">
        <p style="text-align: right" id="toLoad1"></p>
    </form>
    <p id="toLoad2" style="text-align: right"></p>
    <hr>
    <div class="center">
        <button class="buttonfor" style=" border:5px solid blue" 
            onclick="window.open('stk_UploadCartoon.html', '업로드', 'width=500, height=500, scrollbars= 0, toolbar=0, menubar=no');"  
            title="당신의 만화를 공유하세요!">업로드</button>
        <button class="buttonfor" style=" border:5px solid green"  
            onclick="window.open('stk_join.html', '회원가입', 'width=435, height=300, scrollbars= 0, toolbar=0, menubar=no');" 
            title="사이트에 가입하고 같이 만화를 만듭시다.">회원가입</button>
        <a href="stk_CartoonViewer.html"><button class="buttonfor" style=" border:5px solid yellow" 
            title="다른 사람의 만화를 즐기세요.">만화보기</button></a>
    </div>
    <br>
    <img src="images/neuk.png" id="neukimg">
    <img src="images/무제31-3-2.png" id="developers">        
    <h2 style="text-align: center">|    STK는 STICK MAN의 약자로 만화, 웹사이트를 만드는 도곡중학교의 자율동아리입니다   |</h2>
    <br>
    <div class="center" style="background-color: rgb(240, 240, 240); ">
        <hr>
        <pre><a href="stk_help.html" target="_blank">도움말</a>        <a href="stk_TermOfService.html" target="_blank">이용약관</a>        <a href="stk_opinion.html" target="_blank">의견보내기</a></pre>
        <a href="stk_help.html" target="_blank">개발자: 정 수찬, 김 민재, 박 경찬, 안 준태, 이 정환, 임 강한, 전 대윤</a>
        <hr>
    </div>
    <br>
    <?php 
            check_login($mysqli);
    ?>
</body>
</html>