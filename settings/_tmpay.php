<?php
header('Content-Type: text/html; charset=utf-8');
include_once('_config.php');
//$_SERVER['REMOTE_ADDR']='203.146.127.112';
if($_SERVER['REMOTE_ADDR']!='203.146.127.112')
{
  exit('ERROR|ACCESS_DENIED');
}
$transaction_id = $_GET['transaction_id'];
$password = $_GET['password'];
$amount = $_GET['real_amount'];
$status = $_GET['status'];

  $chk_q = $connect->query("SELECT * FROM tmpay_data WHERE txtid = '".$transaction_id."' LIMIT 1");
  if($chk_q->num_rows == 1) {
    $chk = $chk_q->fetch_assoc();
    if(!is_numeric($status)) {
      exit('ERROR|STATUSisNumeric');
    }
    $connect->query("UPDATE tmpay_data SET status = '".$status."' , amount = '".$amount."' WHERE txtid = '".$transaction_id."' LIMIT 1");
    if($status == 1) {
      $chk_user_q = $connect->query("SELECT * FROM authme WHERE username = '".$chk['username']."' LIMIT 1");
      if($chk_user_q->num_rows == 1)
      {
        $sql_search = 'SELECT * FROM truemoney WHERE amount = "'.$amount.'"';
        $query_search = $connect->query($sql_search);
        if($query_search->num_rows != 0) {
          $fetch_search = $query_search->fetch_assoc();
          $update_amount = $fetch_search['points'];
        } else {
          $update_amount = 0;
        }
        
        $rp_update = $amount;

        $chk_user = $chk_user_q->fetch_assoc();
        $connect->query("UPDATE authme SET points = points+'".$update_amount."', rp = rp+'".$rp_update."', topup = topup+'".$amount."', topup_m = topup_m+'".$amount."', topup_all = topup_all+'".$amount."' WHERE id = '".$chk_user['id']."'");
        $activities_action = "เติมเงินด้วยทรูมันนี่";
        $time_date = date("Y-m-d H:i");
        $sql_insert_log = 'INSERT INTO topup_logs (uid,username,action,date,ref,topup_amount,topup_got) VALUES("'.$chk_user['uid'].'","'.$chk_user['username'].'","'.$activities_action.'","'.$time_date.'","'.$transaction_id.'","'.$amount.'","'.$update_amount.'")';
        $query_insert_log = $connect->query($sql_insert_log);

        $linemessage = $_SESSION['username']." ได้เติมเงินด้วย (truemoney) จำนวน ".$amount." บาท. ในเวลา ".date("H:i:s")." ของวันที่ ".date("d-m-Y");
        notify_message($linemessage,$token);
		
        exit('SUCCEED|USERNAME='.$chk['username']);
      } else {
        exit('ERROR|USER_DOESNT_EXIST');
      }
    } else {
      exit('ERROR|INVALID_PASSWORD');
    }
  } else {
    exit('ERROR|CARD_DOESNT_EXIST');
  }


?>
