var CorrectPW;
var CheckedID;
var CheckedPW;
var CorrectMenberType;
var CheckedMenterType;
var tempData = new Array();
//아직 DataBase가 없으므로 DataBase 리스트가 DataBase라고 가장
var DataBase = new Array();

//2 구조체 Struct 함수 선언
function structMenber(){
    var MenberType;//(Administer, Reader, Cartooner)등의 타입이 있다.
    var ID;
    var PW;
}
function loadMenberData(){
    for(let i = 0; i < DataBase.length; i++){
        tempData[i] = new structMenber;
        tempData[i].MenberType = DataBase[i].MenberType;
        tempData[i].ID = DataBase[i].ID;
        tempData[i].PW = DataBase[i].PW;
    }
}

//sign up 알고리즘
//sign up 알고리즘 이지만 현재 sign up 이 없으므로 이곳에 구현
function insertMenberData(){
    //현재 데이타 베이스가 시작 되었다 가정하고 임의로 데이타 베이스에 Menber들을 추가 합니다.
    DataBase[0] = new structMenber;
    DataBase[0].MenberType = "Cartooner";
    DataBase[0].ID = "Cartoon001";
    DataBase[0].PW = "1111";
    DataBase[1] = new structMenber;
    DataBase[1].MenberType = "Cartooner";
    DataBase[1].ID = "Cartoon002";
    DataBase[1].PW = "1234";
    DataBase[2] = new structMenber;
    DataBase[2].MenberType = "Reader";
    DataBase[2].ID = "Reader001";
    DataBase[2].PW = "0000";
    DataBase[3] = new structMenber;
    DataBase[3].MenberType = "Administer";
    DataBase[3].ID = "Administer001";
    DataBase[3].PW = "4321";
}//이곳까지가 sign up 알고리즘(이부분은 제가 도와 드리겠습니다.)

insertMenberData();
loadMenberData();

function onClick(){
    CheckedID = false;
    var id = document.getElementById("ID").value;
    var pw = document.getElementById("PW").value;
    checkID(id);
    if(CheckedID === true) checkPW(pw, id);
    if(CheckedPW === true) checkMenberType(id);
    if(CheckedID === true && CheckedPW === true && CheckedMenterType === true){
        alert("접속을 허가 합니다.");
        close();
        window.open('upload.html', '업로드', 'width=1000, height=800, scrollbars= 0, toolbar=0, menubar=no');
    }
}
function checkID(id){
    for (let i = 0; i < tempData.length; i++) {
        if(tempData[i].ID === id){
            CheckedID = true;
            CorrectPW = tempData[i].PW;
            CorrectMenberType = tempData[i].MenberType;
            break;
        }
    }
    if(CheckedID === false) alert("아이디 '" + id +"'가 존재하지 않습니다.");
}
function checkPW(pw, id){
    if(CorrectPW == pw){
        CheckedPW = true;
    }
    else{
        CheckedPW = false;
        alert("아이디 '" + id + "'의 비밀번호가 비밀번호'" + pw + "'과 일치하지 않습니다.");
    }
}
function checkMenberType(id){
    if(CorrectMenberType === "Reader"){
        alert("귀하의 계정 '"+ id +"'는 업로드 권한이 없습니다.");
    }
    else{
        CheckedMenterType = true;
    }
}