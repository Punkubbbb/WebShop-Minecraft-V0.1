<?php
	session_start();
    ob_start();
    ini_set('display_errors', 0);
    date_default_timezone_set("Asia/Bangkok");

	$config = array(
		'site' => 'http://localhost', //	ไม่ต้องมี / ลงท้าย
        'line_token' => '',
        'wallet_name' => 'ชื่อ',  //	ชื่อวอเลท
		'wallet_phone' => 'เบอร์วอเลท', //	เบอร์วอเลท
		'title' => 'webshop',
        'background' => 'http://localhost/assets/images/bg.jpg',
		'mysql_host' => 'localhost',
		'mysql_username' => 'root',
		'mysql_password' => '',
		'mysql_dbname' => 'webshop',
        'backend_password' => '1234',
        'step2' => '', // หากไม่ต้องการเปิด ให้เว้นว่างไว้ ตอนขึ้นล็อกอินก็ไม่ต้องกรอกอะไร
        'name_server' => '',
        'ip_server' => '127.0.0.1', // IP SERVER Query
		'ip_show' => '127.0.0.1', //IP SERVER SHOW
        'query_port' => '25565', // ใช้สำหรับเช็คสถานะ Server
        'port_server' => '25565', // DEFUALT 25565 ไม่ต้องตั้งค่าหากใช้ Port เดิม.
        'version_server' => '1.7 - 1.15.2',
        'discord_id' => '',
        'page_facebook' => 'http://facebook.com/', // Link Page Facebook
        'detail_server' => 'เซิฟเวอร์คุณภาพ แอดมินใจดี สังคมดี ของเติมโหด ของเควสโหด ผู้เล่นทุกคนเป็นมิตร สังคมดี กิจกรรมเยอะมากๆ เข้ามาเล่นกันเลย',
        'announce' => 'เซิฟเวอร์คุณภาพ แอดมินใจดี สังคมดี ของเติมโหด ของเควสโหด ผู้เล่นทุกคนเป็นมิตร สังคมดี กิจกรรมเยอะมากๆ เข้ามาเล่นกันเลย',
        'max_reg' => 5 // จำกัดจำนวน IP Register
	);
    #คำเตือน ที่คั่นคอมเม้นท์ด้านหลัง คือตัวอย่างเท่านั้น

    $topup['tmpay']['merchant_id'] = 'FC20052723';
    $topup['tmpay']['callback_url'] = 'https://localhost/settings/_tmpay.php';

    $recaptcha_config = array(
        'site_key' => '6LemR58UAAAAAC5w_HNRikX86I0qHt0kRf-h0KGA',
        'secret_key' => '6LemR58UAAAAACUH0o5kqD3LZ-6s5CSpmQV4e6af'
    );
		//	อัตราคูณ ของ วอเลท      
        // SET 1
        $topup[1] = 1; // มากกว่าหรือเท่ากับ 10
        $multiple_u[1] = 2; // จะคูณ 1

        // SET 2
        $topup[3] = 10; // มากกว่าหรือเท่ากับ 50
        $multiple_u[2] = 2; // จะคูณ 2

        // SET 3
        $topup[5] = 50; // มากกว่าหรือเท่ากับ 200
        $multiple_u[3] = 2; // จะคูณ 3

        // SET 4
        $topup[7] = 100; // มากกว่าหรือเท่ากับ 500
        $multiple_u[4] = 2; // จะคูณ 4

        // SET 5
        $topup[9] = 300; // มากกว่าหรือเท่ากับ 1001
        $multiple_u[5] = 2; // จะคูณ 5

        // SET 6
        $topup[11] = 500; // มากกว่าหรือเท่ากับ 1000001
        $multiple_u[6] = 2; // จะคูณ 6
		// 	อัตราคูณ ของ ทรูมันนี้
        // SET Bank 1
        $banktopup[1] = 50; // มากกว่าหรือเท่ากับ 10
        $bankmultiple_u[1] = 1; // จะคูณ 1

        // SET Bank 2
        $banktopup[3] = 90; // มากกว่าหรือเท่ากับ 50
        $bankmultiple_u[2] = 1; // จะคูณ 2

        // SET Bank 3
        $banktopup[5] = 150; // มากกว่าหรือเท่ากับ 200
        $bankmultiple_u[3] = 1; // จะคูณ 3

        // SET Bank 4
        $banktopup[7] = 300; // มากกว่าหรือเท่ากับ 500
        $bankmultiple_u[4] = 1; // จะคูณ 4

        // SET Bank 5
        $banktopup[9] = 500; // มากกว่าหรือเท่ากับ 1001
        $bankmultiple_u[5] = 1; // จะคูณ 5

        // SET Bank 6
        $banktopup[11] = 1000; // มากกว่าหรือเท่ากับ 1000001
        $bankmultiple_u[6] = 1; // จะคูณ 6

    //echo hash('sha256', 'รหัสผ่าน STEP2'); #ลบ // ข้างหน้าสุดออก และรีเฟรชหน้าเว็บ แล้วก็อปไปใส่ใน 'step2' => ''

	$connect = new mysqli($config['mysql_host'],$config['mysql_username'],$config['mysql_password'],$config['mysql_dbname']);
    $connect->query('SET names utf8');
    if($connect->connect_errno){
        exit("Error-> ".$connect->connect_error);
    }

    # ป้องกัน sql injection จาก $_GET
    foreach($_GET as $key => $value){
        $_GET[$key]=addslashes(strip_tags(trim($value)));
    }
    if(isset($_GET['id']) && $_GET['id'] !='')
    { 
        $_GET['id']=(int) $_GET['id'];
    }
    extract($_GET);