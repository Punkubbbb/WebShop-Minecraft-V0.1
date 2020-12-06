<style>
	.custom-file-upload {
	    display: inline-block;
	    padding: 6px 12px;
	    cursor: pointer;
	}
</style>
<?php
	function deletetosaniyom($string) {
		$arrString = explode(',', $string);
		foreach ($arrString as $v) {
			$newString .=  $v;
		}
		return $newString;
	}

	$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
	$query_wallet = $connect->query($sql_wallet);
	$wallet = $query_wallet->fetch_assoc();
	$wallet_key = $wallet['reference_token'];
	$wallet_messagez = $wallet['message'];

	if (isset($wallet_key)) {
		if (empty( $wallet_key ) || $wallet_key  == '') {
			$wallet_phone = "กรุณาติดต่อแอดมิน #UPDATE";
		} else {
			$wallet_key = base64_decode($wallet_key);
			$wallet_key = json_decode($wallet_key, true);
			if(isset($wallet_key['data']['mobile_number'])) {
				$wallet_phone = $wallet_key['data']['mobile_number'];
				$wallet_email = $wallet_key['credentials']['username'];
				$wallet_password = $wallet_key['credentials']['password'];
				$wallet_ref = $wallet_key['reference_token'];
				$wallet_device = $wallet_key['device_id'];
				$wallet_mobile = $wallet_key['mobile_tracking'];
				$wallet_name = $wallet['name'];
				$wallet_message = $wallet['message'];
			} else {
				$wallet_phone = "086-4712687 | E2"; // รูปแบบ Key ไม่ถูกต้อง กรุณาลองใหม่
			}
		}
	} else {
		$wallet_phone = "086-4712687 | E1"; // กรุณาใส่ Key เพื่อใช้งาน Wallet #Wallet
	}

    if(isset($_POST['add_img']))
    {
    	$ranStr = substr(str_shuffle("0123456789ABCDECGHIJKLNMOPQRSTUVWXYZ"),0,6);
        $target_dir = "assets/images/topup/truewallet/";
        $target_file = $target_dir . $ranStr.".png";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["images"]["tmp_name"]);
        if($check !== false)
        {
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $target_file))
            {
                $uploadOk = 1;
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                {
                	$link = "https"; 
                }
                else
                {
                	$link = "http"; 
                }

                $link .= "://"; 
                $link .= $_SERVER['HTTP_HOST']; 
                $link .= $_SERVER['REQUEST_URI']; 
                $link = str_replace("?page=truewallet",$target_dir,$link);
                $link .= $ranStr.".png";

                
                $sql_add_img = "INSERT INTO upload_topup (file_name,file_url) VALUES ('".$ranStr."','".$link."')";
				$query_add_img = $connect->query($sql_add_img);

                if($query_add_img)
                {
					$ftam_u = $_POST['amount_wallet'];
					if($ftam_u >= $topup[1] && $ftam_u <= $topup[2]) {
						$mutiple_amount = $ftam_u * $multiple_u[1];
					} elseif($ftam_u >= $topup[3] && $ftam_u <= $topup[4]) {
						$mutiple_amount = $ftam_u * $multiple_u[2];
					} elseif($ftam_u >= $topup[5] && $ftam_u <= $topup[6]) {
						$mutiple_amount = $ftam_u * $multiple_u[3];
					} elseif($ftam_u >= $topup[7] && $ftam_u <= $topup[8]) {
						$mutiple_amount = $ftam_u * $multiple_u[4];
					} elseif($ftam_u >= $topup[9] && $ftam_u <= $topup[10]) {
						$mutiple_amount = $ftam_u * $multiple_u[5];
					} elseif($ftam_u >= $topup[11] && $ftam_u <= $topup[12]) {
						$mutiple_amount = $ftam_u * $multiple_u[6];
					} else {
						$mutiple_amount = $ftam_u;
					}

					$activities_action = "เติมเงินด้วยทรูวอเลต";
					$time_date = date("Y-m-d H:i");
					$sql_wait = "INSERT INTO waiting_topup (uid,username,topup_amount,topup_got,date,status,action) VALUES ('".$_SESSION['uid']."','".$_SESSION['username']."','".$_POST['amount_wallet']."','".$mutiple_amount."','".$time_date."','0','".$activities_action."')";
					$query_wait = $connect->query($sql_wait);
					if($query_wait) {
						$linemessage = $_SESSION['username']." ได้เติมเงินด้วย (TRUEWALLET) ".$_POST['amount_wallet']." พ้อยต์ที่ต้องได้คือ ".$mutiple_amount." ในเวลา ".date("H:i:s")." ของวันที่ ".date("d-m-Y")." กรุณาตรวจเช็คยอดเงิน รูปภาพ ".$link;
						notify_message($linemessage,$token);
	
						$msg = 'ส่งหลักฐานเรียบร้อยแล้วกรุณารอ 5-10 นาที หากนานเกินแจ้งทางเพจเลย!';
						$alert = 'success';
						$msg_alert = 'สำเร็จ!';
					} else {
						$msg = 'เกิดข้อผิดพลาด กรุณาแจ้งแอดมิน!';
						$alert = 'error';
						$msg_alert = 'เกิดข้อผิดพลาด!';
					}
                }
                else
                {
                	$msg = 'เกิดข้อผิดพลาด ไม่สามารถอัพโหลดรูปได้!';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
                }
            }
            else
            {
                $msg = 'เกิดข้อผิดพลาด ไม่สามารถเพิ่มรูปได้!';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
            }
        }
        else
        {
            $msg = 'เกิดข้อผิดพลาด ไฟล์นี้ไม่ใช่รูปภาพ!';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
        }
        ?>
			<script>
				swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
					button: "Reload",
				})
				.then((value) => {
					window.location.href = window.location.href;
				});
			</script>
		<?php
    }
?>
<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
  <div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-credit-card"></i>&nbsp;เติมเงิน</span>
	</div>
	<div class="card-body">
		<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username'])) {
			include_once 'template/alertLogin.php';
		} else {
			?>
			<div class="row">
				<div class="col-md-12 mb-1">
					<h5><div class="alert alert-danger text-center">
						<i class="fas fa-exclamation-triangle text-dark"></i>
						โอนเงินผ่าน Wallet ได้ที่
						<br/>
						เบอร์ <strong><?php echo $config['wallet_phone']; ?></strong>
						<br/>
						ชื่อบัญชี: <?php echo $config['wallet_name']; ?>
						<br/>
					</div></h5>
				</div>
				<div class="col-md-12">
					<h5 class="text-center"><img src="<?php echo $config['site']."/assets/images/truewallet.png"; ?>" alt="TrueWallet" style="width:30%"></h5>
					<table class="table text-white text-center">
						<thead>
							<tr>
								<td class="py-1">ราคาเติม</td>
								<td class="py-1">พ้อยที่ได้</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="py-1"><?php echo $topup[1]; ?> บาท</td>
								<td class="py-1"><?php echo "x".$multiple_u[1]; ?> <i class="fas fa-coins text-white"></i></td>
							</tr>
							<tr>
								<td class="py-1"><?php echo $topup[3]; ?> บาท</td>
								<td class="py-1"><?php echo "x".$multiple_u[2]; ?> <i class="fas fa-coins text-white"></i></td>
							</tr>
							<tr>
								<td class="py-1"><?php echo $topup[5]; ?> บาท</td>
								<td class="py-1"><?php echo "x".$multiple_u[3]; ?> <i class="fas fa-coins text-white"></i></td>
							</tr>
							<tr>
								<td class="py-1"><?php echo $topup[7]; ?> บาท</td>
								<td class="py-1"><?php echo "x".$multiple_u[4]; ?> <i class="fas fa-coins text-white"></i></td>
							</tr>
							<tr>
								<td class="py-1"><?php echo $topup[9]; ?> บาท</td>
								<td class="py-1"><?php echo "x".$multiple_u[5]; ?> <i class="fas fa-coins text-white"></i></td>
							</tr>
						</tbody>
					</table>
					<hr class="mb-3"/>
					<form method="POST" name="addimages" enctype="multipart/form-data">
						<div class="row">
							<div class="input-group col-md-12 mb-2">
								<input name="amount_wallet" type="text" onkeypress="return NumbersOnly(event);" class="form-control" placeholder="จำนวนเงินที่เติมมา (หากใส่จำนวนผิดพ้อยต์จะไม่เข้า)" required="" maxlength="14">
							</div>
							<div class="form-group col-md-5">
								<input type="file" class="custom-file-upload" size="30" name="images" class="mb-3">
							</div>
							<div class="col-md-7">
								<input type="submit" name="add_img" class="btn btn-success btn-block" value="ส่งหลักฐานการโอน">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>