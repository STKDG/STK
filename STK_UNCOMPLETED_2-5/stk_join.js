function changeLangSelect(){
    var langSelect = document.getElementById("type");
    var selectText = langSelect.options[langSelect.selectedIndex].text;
    if(selectText == "독자"){
        document.getElementById("type_info").innerText = '사용자 타입 "독자"는 업로드권한이 없으며 다른 것은 모두 동일 합니다.';
    }if(selectText == "작가"){
        document.getElementById("type_info").innerText = '사용자 타입 "작가"는 업로드권한이 있으며 다른 것은 모두 동일 합니다.';
    }
}