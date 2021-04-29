<?php
// 안드로이드 회원가입 연동 부분
header('content-type: text/html; charset=utf-8');
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)

$conn = mysqli_connect("211.218.150.109", "ci2020colorful", "2020colorful", "ci2020colorful"); // MySQL 접속 및 설정 저장

// 세션 시작
session_start();

// 1. 회원 정보 넣기
// nm_? : registDB 에서 정의, sm_id : insert 에서 사용
// sm_grade: 0 상인 1 고객
// 이름, 이메일, 비번, 비번 확인(확인)

$sm_email = $_POST[u_email]; // 이메일(아이디) $_POST 내의 u_email 은 안드로이드 또는 html 에서 받아서 사용하게 될 변수
$sm_pwd = $_POST[u_pw]; // 비번
$sm_name = $_POST[u_name]; // 이름
$sm_grade = $_POST[u_job]; // 등급

// 1. 고객일 때 정보 넣기
if ($sm_grade == 1) {
    // member 테이블의 레코드 삽입하기
    $sing = "INSERT INTO `members` (m_email, m_pwd, m_name, m_grade) VALUES ('" . $sm_email . "','" . $sm_pwd . "', '" . $sm_name . "'," . $sm_grade . ")";
    // 질의(위 내용)를 삽입하라.
    $sing_result = mysqli_query($conn, $sing);
    
    // sql_result 중 어디가 잘못 되었는가 확인
    if (! $sing_result) {
        echo ("쿼리오류 발생: " . mysqli_error($conn));
    }
}

// 2. 상인일 때 정보 넣기
if ($sm_grade == 0) {
    $own_sname = $_POST[u_storeName]; // 매장 이름
    $own_local = $_POST[u_local]; // 매장 위치

    // member 테이블의 레코드 삽입하기
    $sing1 = "INSERT INTO `members` (m_email, m_pwd, m_name, m_grade, s_name) VALUES ('" . $sm_email . "','" . $sm_pwd . "', '" . $sm_name . "'," . $sm_grade . ", '".$own_sname."')";
    // 질의(위 내용)를 삽입하라.
    $sing1_result = mysqli_query($conn, $sing1);

    
    if (! $sing1_result) {
        echo ("쿼리오류 발생: " . mysqli_error($conn));
    }
    
    // store 테이블의 레코드 삽입하기
    $own = "INSERT INTO store (s_name, s_local) VALUES ('" . $own_sname . "','" . $own_local . "')";
    // 질의(위 내용)를 삽입하라.
    $own_result = mysqli_query($conn, $own);    

    // sql_result 중 어디가 잘못 되었는가 확인
    if (! $own_result) {
        echo ("쿼리오류 발생: " . mysqli_error($conn));
    }    
}

?>