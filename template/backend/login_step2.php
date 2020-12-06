<?php
	if(isset($_POST['login_submit_backend']))
	{
		$password_backend = hash('sha256',$connect->real_escape_string($_POST['password_backend']));
		if($password_backend == $config['step2'])
		{
			$_SESSION['step2'] = $password_backend;

			$msg = 'เข้าสู่ระบบ STEP2 เรียบร้อยแล้ว !';
			$alert = 'success';
			$msg_alert = 'สำเร็จ!';
		}
		elseif($config['step2'] == NULL || $config['step2'] == "" || empty($config['step2']))
		{
			$_SESSION['step2'] = "EMPTY";

			$msg = 'เข้าสู่ระบบ STEP2 เรียบร้อยแล้ว !';
			$alert = 'success';
			$msg_alert = 'สำเร็จ!';
		}
		else
		{
			$msg = 'ERROR !';
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
<form name="login" method="POST">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text">
				<i class="fa fa-lock"></i>
			</span>
		</div>
		<input name="password_backend" class="form-control" type="password" placeholder="รหัสผ่านเข้าสู่ระบบหลังบ้าน #STEP2"/>
	</div>
	<hr/>
	<?php
		if(isset($_POST['login_submit_backend']))
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
				<input name="login_submit_backend" class="btn btn-success btn-block" type="submit" value="เข้าสู่ระบบ.."/>
			<?php
		}
	?>
</form>