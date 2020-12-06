<?php
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$sql_buy = 'SELECT * FROM rp_shop WHERE id = "'.$_GET['id'].'"';
	}
	else
	{
		$sql_buy = 'SELECT * FROM rp_shop WHERE id = "0"';
	}

	$query_buy = $connect->query($sql_buy);
?>
<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-money-bill-alt"></i>&nbsp;แลกของรางวัล</span>
	</div>
	<div class="card-body">
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
			include_once 'template/alertLogin.php';
		}
		else
		{
			?>
				<div class="row">
					<?php
						if($query_buy->num_rows <= 0)
						{
							$msg = 'ไม่พบสินค้านี้';
							$alert = 'error';
							$msg_alert = 'เกิดข้อผิดพลาด!';
						}
						else
						{
							$buy = $query_buy->fetch_assoc();
							$sql_category = 'SELECT * FROM category WHERE id = "'.$buy['category'].'"';
							$query_category = $connect->query($sql_category);
							$category_f = $query_category->fetch_assoc();

							// START BUY
							if(isset($_POST['btn_buy']))
							{
								?>
									<div class="col-md-12 mb-3">
										<?php
											if($player['points'] < $buy['price'])
											{
												$msg = 'พ้อยท์คุณไม่เพียงพอ กรุณาเติมเงินค่ะ !';
												$alert = 'error';
												$msg_alert = 'เกิดข้อผิดพลาด!';
											}
											else
											{
												$sql_rcon_server = 'SELECT * FROM bungeecord WHERE id = "'.$buy['server_id'].'"';
												$query_rcon_server = $connect->query($sql_rcon_server);

												if($query_rcon_server->num_rows > 0)
												{
													$rcon_server = $query_rcon_server->fetch_assoc();
													$rcon_ip = $rcon_server['ip_server'];
													$rcon_port = $rcon_server['port'];
													$rcon_password = $rcon_server['password'];

													require_once('settings/_rcon.php');
													$rcon = new Rcon($rcon_ip, $rcon_port, $rcon_password, '3');

													if($rcon->connect())
													{
														$sql_rem_points = 'UPDATE authme SET rp = rp-"'.$buy['price'].'" WHERE id = "'.$_SESSION['uid'].'"';
														$query_rem_points = $connect->query($sql_rem_points);
	
														if($query_rem_points)
														{
															$activities_action = "แลกแต้มสะสม (".$buy['name'].")";
															$time_date = date("Y-m-d H:i");
															$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,topup_amount,transaction,server_id) VALUES ("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$buy['price'].'","'.$buy['id'].'","'.$rcon_server['name_server'].'")';
															$connect->query($sql_insert_log);
	
															$command = str_replace("[player]", $player['realname'], $buy['command']);
															$exp = explode('[and]',$command);
	
															foreach($exp as &$val)
															{
																$rcon->sendCommand($val); // ส่งคำสั่ง
															}
	
															$msg = 'ซื้อ '.$buy['name'].' สำเร็จ !';
															$alert = 'success';
															$msg_alert = 'สำเร็จ!';
														}
														else
														{
															$msg = 'เกิดข้อผิดพลาด #ไม่สามารถอัพเดทพ้อยท์ล่าสุดได้ !';
															$alert = 'error';
															$msg_alert = 'เกิดข้อผิดพลาด!';
														}
													} else {
														$msg = 'เกิดข้อผิดพลาด #Rcon Connect Error !';
														$alert = 'error';
														$msg_alert = 'เกิดข้อผิดพลาด!';
													}
												} else {
													$msg = 'ไม่พบ Server กรุณาแจ้งแอดมิน !';
													$alert = 'error';
													$msg_alert = 'เกิดข้อผิดพลาด!';
												}
											}
										?>
									</div>

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
							else
							{
								if(!isset($_POST['btn_gift']))
								{
									if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
									{
										?>
											<div class="col-md-12 mb-1">
												<div class="alert alert-info">
													<i class="fas fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนแลกรางวัล !
												</div>
											</div>
										<?php
									}
									else
									{
										?>
											<div class="col-md-12 mb-1">
												<div class="alert alert-info">
													<i class="fas fa-exclamation-triangle"></i> กรุณาออนไลน์ในเกมก่อนแลกรางวัล !
												</div>
											</div>
										<?php
									}
								}
							}
							// END BUY
							?>
							<div class="col-md-4">
								<img src="<?php echo $buy['pic']; ?>" class="w-100" style="border-radius: 4px 4px 4px 4px;">
							</div>
							<div class="col p-4 d-flex flex-column position-static">
					          	<strong class="d-inline-block mb-0 text-success">
					          		<?php echo $category_f['name']; ?>
					          	</strong>
					          	<h3 class="mb-0">
					          		<?php echo $buy['name']; ?> <small>ราคา <?php echo number_format($buy['price'],2); ?> <i class="fas fa-money-bill-alt"></i></small>
					          	</h3>
					          	<div class="mb-1 text-muted">
					          		#รหัสของรางวัล: <?php echo $buy['id']; ?>
					          	</div>
					          	<form name="buy" method="POST">
					          		<input type="hidden" value="<?php echo $buy['id']; ?>"/>
						          	<button type="submit" name="btn_buy" class="btn btn-primary btn-block mt-3">
						          		<i class="fas fa-rp_shopping-basket"></i> แลกซื้อ <?php echo $buy['name']; ?>
						          	</button>
					          	</form>
					        </div>
							<?php
						}
					?>
				</div>
			<?php
		}
	?>
	</div>
</div>