<?php
// 안드로이드 회원가입 연동 부분
header('content-type: text/html; charset=utf-8');
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)

$conn = mysqli_connect("211.218.150.109", "ci2020colorful", "2020colorful", "ci2020colorful"); // MySQL 접속 및 설정 저장

session_start(); // 세션

$pf_touch = $_POST[af_touch]; // 촉감(3)
$pf_glossy = $_POST[af_glossy]; // 광택감(1)
$pf_flex = $_POST[af_flex]; // 신축성(0)

$pf_thick = $_POST[bf_thick];
$pf_refle = $_POST[bf_refle];

$pf_red = $_POST[bf_red];
$pf_green = $_POST[bf_green];
$pf_blue = $_POST[bf_blue];

//1. 원단 이름, 아두이노 원단 이미지 slct
$survery = "select f_name, f_pic from fabric where f_touch=".$pf_touch." AND f_glossy=".$pf_glossy." AND f_flexibility=" .$pf_flex ." 
AND f_R=".$pf_red ." AND f_G=".$pf_green." AND f_B=".$pf_blue."";
$survery_result = mysqli_query($conn, $survery);

$sv_result = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
while ($row = mysqli_fetch_array($survery_result)) {
    array_push($sv_result, array(
        'f_name' => $row[0],
        'f_pic' => $row[1]
    ));
}

// 2. json 형식으로 원단 이름, 매장 이름 출력
$show = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
$show = json_encode(array(
    // 배열 하나로 출력
    'survery'=>$sv_result
));

if ($show != null)    echo $show;

?>