<?php

// 안드로이드 회원가입 연동 부분
header('content-type: text/html; charset=utf-8');

// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
$conn = mysqli_connect("211.218.150.109", "ci2020colorful", "2020colorful", "ci2020colorful"); // MySQL 접속 및 설정 저장

// 세션 시작
session_start();

//1. 옷감 이름
$pf_name = $_POST[sf_name];

//1. 옷감 이름을 통해 가게 이름, 가게 위치 가져오기
$snslct="select s_name from fabric where f_name = '".$pf_name."'";

$sinfo="select s_name, s_local from store where s_name =(".$snslct.")";
$sinfo_slct = mysqli_query($conn, $sinfo);

$s_info_slct_result = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
while ($row = mysqli_fetch_array($sinfo_slct)) {
    array_push($s_info_slct_result, array(
        's_name' => $row[0],
        's_local' => $row[1]
    ));
}

// 2. json 형식으로 원단 이름, 매장 이름 출력
$s_list = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
$s_list = json_encode(array(
    // 배열 하나로 출력
    'sinfo'=>$s_info_slct_result
));

if ($s_list != null)    echo $s_list;
else                          echo "Fail<br>";

?>