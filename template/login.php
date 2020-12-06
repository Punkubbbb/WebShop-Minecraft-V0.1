<?php
	if(isset($_POST['login_submit'])) {
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';

		$username = $connect->real_escape_string($_POST['username']);
		$sql = 'SELECT * FROM authme WHERE username = "'.$username.'"';
		$a = $connect->query($sql);
		$a_num = $a->num_rows;
		if($a_num == 1) {
			$password_info = $a->fetch_assoc();
			$sha_info = explode("$",$password_info['password']);
			$salt = $sha_info[2];
			$sha256_password = hash('sha256', $_POST['password']);
			$sha256_password .= $sha_info[2];

			if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0) {
				$sql_user = 'SELECT * FROM authme WHERE username = "'.$username.'"';
				$query_user = $connect->query($sql_user);
				$fetch_user = $query_user->fetch_assoc();

				//* SET SESSION
				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['realname'];

				$msg = 'ยินดีต้อนรับคุณ: '.$_SESSION['realname'];
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
			} else {
				$msg = 'รหัสผ่านไม่ถูกต้อง';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
		} else {
			$msg = 'ไม่พบตัวละครนี้';
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
<div class="card mb-3" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fa fa-fw fa-sign-in-alt"></i>&nbsp;เข้าสู่ระบบ</span>
	</div>
	<form name="login" method="POST">
		<div class="card-body">
			<div class="card-content mx-4">
				<div style="display: block;">
					<div class="row my-3">
						<div class="col-2"><img src="assets/images/icon/login.svg" style="width: 37px; height: 37px;"></div>
						<div class="col">
							<b style="color:#ff94fd;">เข้าสู่ระบบ</b>
							<div class="text-white">กรุณาเข้าสู่ระบบก่อนทำรายการ</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="ชื่อตัวละครในเกม" name="username">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="รหัสผ่านในเกม" name="password">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div style="display: block;">
				<?php
				if(isset($_POST['login_submit'])) {
					?>
					<button class="btn btn-block btn-success" type="button" disabled>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;กำลังโหลด...
					</button>
					<?php
				} else {
					?>
					<button type="submit" name="login_submit" class="btn btn-block btn-success"><i class="fas fa-unlock-alt"></i>&nbsp;เข้าสู่ระบบ</button>
					<a style="margin-top: 3px;" href="?page=register" class="btn btn-primary w-100"><i class="fa fa-fw fa-book"></i> สมัครสมาชิก</a>
					<?php
				}
				?>
			</div>
		</div>
	</form>
</div>