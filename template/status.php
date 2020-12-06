<?php
	require __DIR__ . '/../settings/_MinecraftQuery.php';
	require __DIR__ . '/../settings/_MinecraftQueryException.php';
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	$MCQuery = new MinecraftQuery();

	$sql_check_account = 'SELECT COUNT(*) AS c FROM authme';
	$query_check_account = $connect->query($sql_check_account);
	if($query_check_account->num_rows > 0) {
		$account_result = $query_check_account->fetch_assoc();
		$account = $account_result["c"] + 0;
	} else {
		$account = 0;
	}
?>
<div class="container" style="margin-top:0.1vh;">
	<div class="row">
		<div class="col-sm-12" style="margin-bottom: 10px;">
			<div class="row mt-4 mb-4">
				<?php
				try {
					$MCQuery->Connect($config['ip_server'], $config['query_port']);
					$status_server = $MCQuery->GetInfo();
					$getplayer = $MCQuery->GetPlayers();
					$player_online = $getplayer['0'];
					$count_online = $status_server['Players'];
					?>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-server text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>สถานะเซิฟเวอร์<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;Online</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-signal text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>ผู้เล่นออนไลน์<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;<?php echo number_format($count_online); ?> คน</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-users text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>ไอดีทั้งหมด<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;<?php echo number_format($account); ?> บัญชี</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<?php
				} catch(MinecraftQueryException $e) {
					?>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-server text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>สถานะเซิฟเวอร์<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;Offline</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-signal text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>ผู้เล่นออนไลน์<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;0 คน</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-body" style="background-color:#232323; border-left:5px solid #ff94fd;">
							<div class="d-flex align-items-center">
								<i class="fas fa-users text-white fa-2x" aria-hidden=""></i>
								<h4 class="ml-3" style="color:#fff;">
									<small>ไอดีทั้งหมด<br>
										<div class="mt-2" style="color:#ff94fd;">&nbsp;<?php echo number_format($account); ?> บัญชี</div>
									</small>
								</h4>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>