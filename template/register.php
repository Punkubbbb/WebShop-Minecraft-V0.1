<?php
	function createSalt($length)
	{
		srand(date("s")); 
		$chars = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
		$ret_str = ""; 
		$num = strlen($chars); 
		for($i=0;$i<$length;$i++)
		{ 
			$ret_str.= $chars[rand()%$num];
		} 
		return $ret_str;
	}

	function hashpw($orgPassword)
	{
		$salt = createSalt(16);
		$hashedPassword = "\$SHA\$".$salt."\$".hash('sha256',hash('sha256',$orgPassword).$salt);
		return $hashedPassword;
	}
?>
<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-user-plus"></i>&nbsp;สมัครสมาชิก</span>
	</div>
	<div class="card-body">
		<?php
			if(isset($_POST['register_submit']))
			{
				$grecaptcha = $_POST['g-recaptcha-response'];
				$url_recaptcha = 'https://www.google.com/recaptcha/api/siteverify?secret='.$recaptcha_config['secret_key'].'&response='.$grecaptcha.'&ipremote='.$_SERVER['REMOTE_ADDR'];
				if(empty($grecaptcha)){
					$msg = 'กรุณาติ๊ก Captcha เพื่อยืนยันตัวตน';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
				}
				else
				{
					$responseURL = json_decode(file_get_contents($url_recaptcha),TRUE);
					$result_recaptcha = $responseURL['success'];
					
					if($result_recaptcha == '1')
					{
						$msg = 'คุณเป็นบอท !';
						$alert = 'error';
						$msg_alert = 'เกิดข้อผิดพลาด';
					}
					else
					{
						$reg_username = strtolower($connect->real_escape_string($_POST['username']));
						$reg_realname = $connect->real_escape_string($_POST['username']);
						$reg_password = $connect->real_escape_string($_POST['password']);
						$reg_con_password = $connect->real_escape_string($_POST['con_password']);
						$reg_email = $connect->real_escape_string($_POST['email']);

						if(empty($_POST['username'])) 
						{
							$msg = 'พบข้อผิดพลาด Username';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						elseif(strlen($_POST['username']) < 4)
						{
							$msg = 'Username ต้องมี 4 ตัวขึ้นไป';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						
						elseif(empty($_POST['password'])) 
						{ 
							$msg = 'พบข้อผิดพลาด กรุณาตรวจสอบ Password';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						elseif(empty($_POST['email'])) 
						{
							$msg = 'กรุณากรอก Email';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
						{
							$msg = 'กรุณากรอก Email ให้ถูกต้อง';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						elseif($reg_password != $reg_con_password)
						{
							$msg = 'กรุณากรอกรหัสผ่านให้ตรงกัน';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						else
						{
							$check_ip = $connect->query("SELECT * FROM authme WHERE IP = '".$_SERVER['REMOTE_ADDR']."'");
							$numrow_ip = $check_ip->num_rows;
							if($numrow_ip > $config['max_reg'])
							{
								$msg = 'คุณสมัครสมาชิกเกินจำนวนที่ระบบตั้งไว้แล้ว';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
							}
							else
							{
								$check = $connect->query("SELECT * FROM authme WHERE username = '".$reg_username."'");
								$numrow = $check->num_rows;
								if($numrow > 0)
								{
									$msg = 'มี Username นี้อยู่แล้วในระบบ';
									$alert = 'error';
									$msg_alert = 'เกิดข้อผิดพลาด!';
								}
								else
								{
									$insert = $connect->query("INSERT INTO authme (username,realname,password,ip,email) VALUES('".$reg_username."','".$reg_realname."','".hashpw($reg_password)."','".$_SERVER['REMOTE_ADDR']."','".$reg_email."')");
									if($insert)
									{
										$msg = 'สมัครสมาชิกเรียบร้อยแล้ว';
										$alert = 'success';
										$msg_alert = 'สำเร็จ!';
									}
									else
									{
										$msg = 'พบข้อผิดพลาด';
										$alert = 'error';
										$msg_alert = 'เกิดข้อผิดพลาด!';
									}
								}
							}
						}
					}
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
		<form name="register" method="POST">
			<div class="row">
				<div class="col-md-12 mb-2">
					<label for="username">ชื่อตัวละครในเกม</label>
					<input type="text" class="form-control" name="username" placeholder="ชื่อตัวละครในเกม">
				</div>
				<div class="col-md-6 mb-2">
					<label for="password">รหัสผ่าน</label>
					<input name="password" class="form-control" type="password" placeholder="รหัสผ่านในเกม"/>
				</div>
				<div class="col-md-6 mb-2">
					<label for="con_password">ยืนยันรหัสผ่าน</label>
					<input name="con_password" class="form-control" type="password" placeholder="ยืนยันรหัสผ่านอีกครั้ง"/>
				</div>
				<div class="col-md-12 mb-2">
					<label for="email">อีเมลล์</label>
					<input name="email" class="form-control" type="email" placeholder="อีเมลล์ ตัวอย่าง admin@gmail.com"/>
				</div>
				<div class="col-md-12 mb-2">
					<center>
						<div class="g-recaptcha" data-sitekey="6LcaUpUUAAAAAE1Dz6gsfjLs8o8hoZqY0Sbkr-LK"></div>
						</center>
				</div>
			</div>
			<hr/>
			<?php
				if(isset($_POST['register_submit']))
				{
					?>
						<button class="btn btn-success btn-block" type="button" disabled>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
						</button>
					<?php
				}
				else
				{
					?>
						<input name="register_submit" class="btn btn-primary btn-block" type="submit" value="สมัครสมาชิก"/>
					<?php
				}
			?>
		</form>
	</div>
</div>