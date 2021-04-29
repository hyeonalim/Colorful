<?php
// 안드로이드 회원가입 연동 부분
header('content-type: text/html; charset=utf-8');
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)

$conn = mysqli_connect("211.218.150.109", "ci2020colorful", "2020colorful", "ci2020colorful"); // MySQL 접속 및 설정 저장

// 세션 시작
session_start();

$sm_email = $_POST[u_email];

//1. 회원 이름, 매장 이름, 위치 slf
$setting_info = "SELECT members.m_name FROM members WHERE m_email = '".$sm_email."'";
$setting_info_result = mysqli_query($conn, $setting_info);

$setting_result = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
while ($row = mysqli_fetch_array($setting_info_result)) {
    array_push($setting_result, array(
        'm_name' => $row[0]
    ));
}

// 2. json 형식으로 원단 이름, 매장 이름 출력
$setting_list = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
$setting_list = json_encode(array(
    // 배열 하나로 출력
    'setting_list'=>$setting_result
));

if ($setting_list != null)    echo $setting_list;
else                          echo "Fail<br>";
        
?>
