
<?php

// 안드로이드 회원가입 연동 부분
header('content-type: text/html; charset=utf-8');
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
$conn = mysqli_connect("211.218.150.109", "ci2020colorful", "2020colorful", "ci2020colorful"); // MySQL 접속 및 설정 저장

// 세션 시작
session_start();

$ps_email = $_POST[u_email]; // 이메일(아이디)

//1. 원단 정보 가져오기
//1_1. 회원 테이블에서 s_name 가져오기
$sn_slct = "select s_name from members where m_email='".$ps_email."'";

//1_2. s_name으로 원단 정보 가져오기
$f_info="select f_no, f_name, f_quantity, f_price, f_touch, f_glossy, f_flexibility from fabric where 
s_name = (".$sn_slct.")";
$f_info_slct = mysqli_query($conn, $f_info);

$f_info_slct_result = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
while ($row = mysqli_fetch_array($f_info_slct)) {
    array_push($f_info_slct_result, array(
        'f_no' => $row[0],
        'f_name' => $row[1],
        'f_quantity' => $row[2],
        'f_price' => $row[3],
        'f_touch' => $row[4],
        'f_glossy' => $row[5],
        'f_flexibility' => $row[6]
    ));
}

// 2. json 형식으로 원단 이름, 매장 이름 출력
$sfslct_list = array();
// 쿼리문의 결과(res)를 배열형식으로 변환(result)
$sfslct_list = json_encode(array(
    // 배열 하나로 출력
    'finfo'=>$f_info_slct_result
));

if ($sfslct_list != null)    echo $sfslct_list;
else                          echo "Fail<br>";

?>
