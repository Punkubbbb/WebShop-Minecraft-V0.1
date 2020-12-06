<?php
$link_page = "page";
?>
<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
  <div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-history"></i>&nbsp;กรุณาเลือกประวัติ</span>
	</div>
	<div class="card-body">
		<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username'])) {
			include_once 'template/alertLogin.php';
		} else {
			?>
			<div class="row">
				<div class="col-12">
					<br>	
					<div class="text-center">
						<a class="btn btn-danger" href="?<?php echo $link_page; ?>=history_buy" role="button">ประวัติการซื้อ</a>
					</div>
					<hr>
				</div>
				<div class="col-12">
					<div class="text-center">
						<a class="btn btn-warning" href="?<?php echo $link_page; ?>=history_topup" role="button">ประวัติการเติมเงิน</a>
					<hr>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>