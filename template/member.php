<div class="card mb-3" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fa fa-user"></i>&nbsp;ระบบสมาชิก</span>
	</div>
	<div class="card-body">
		<div class="card-content mx-4 text-white">
			<div style="display: block;">
				<center>
					<div class="text-white">ยินดีต้อนรับ: <?php echo $player['realname'] ?></div>
					<br>
					<img src="https://minotar.net/armor/bust/<?php echo $_SESSION['username']; ?>/100.png">
					<!-- <img src="https://cravatar.eu/helmavatar/<?php echo $_SESSION['username']; ?>/150.png"> -->
					<br>
					<br>
				</center>
			</div>
		</div>
		<table class="table text-white">
			<tbody>
				<tr>
					<th scope="row">พ้อยต์:</th>
					<td><?php echo number_format($player['points']); ?> <i class="fas fa-coins"></i></td>
				</tr>
				<tr>
					<th scope="row">ยอดสะสม:</th>
					<td><?php echo number_format($player['rp']); ?> <i class="fas fa-money-bill-alt"></i></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<div style="display: block;">
			<a style="margin-top: 3px;" href="?page=changepassword" class="btn btn-info w-100"><i class="fa fa-fw fa-book"></i>&nbsp;เปลี่ยนรหัสผ่าน</a>
			<a style="margin-top: 3px;" href="?page=logout" class="btn btn-danger w-100"><i class="fa fa-fw fa-sign-out-alt"></i>&nbsp;ออกจากระบบ</a>
		</div>
	</div>
</div>