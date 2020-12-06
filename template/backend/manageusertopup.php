<?php
	if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
	{
		$user_id = $_GET['id'];
		$sql_user = 'SELECT * FROM authme WHERE id = "'.$user_id.'"';
		$query_user = $connect->query($sql_user);

		if($query_user->num_rows != 0)
		{
			$user_f = $query_user->fetch_assoc();

			if(isset($_POST['btn_edit_user']))
			{
				if($_POST['points'] != NULL && $_POST['points'] != "" && $_POST['topup'] != NULL && $_POST['topup'] != "")
				{
					$sql_edit = 'UPDATE authme SET points = points+"'.$_POST['points'].'", topup = topup+"'.$_POST['topup'].'", rp = rp+"'.$_POST['topup'].'" WHERE id = "'.$user_f['id'].'"';
					$query_edit = $connect->query($sql_edit);

					$activities_action = $_POST['topupwith'];
					$time_date = date("Y-m-d H:i");
					$admin = "เติมโดย ".$_SESSION['username'];
					$sql_insert_log = 'INSERT INTO topup_logs (uid,username,action,date,ref,topup_amount,topup_got) VALUES("'.$user_f['id'].'","'.$user_f['username'].'","'.$activities_action.'","'.$time_date.'","'.$admin.'","'.$_POST['topup'].'","'.$_POST['points'].'")';
					$query_insert_log = $connect->query($sql_insert_log);

					$linemessage = "แอดมิน ".$_SESSION['username']." ได้ ".$activities_action." ให้กับ ".$user_f['realname']." เป็นจำนวน ".$_POST['topup']." พ้อยต์ที่ได้รับคือ ".$_POST['points']." ในเวลา ".date("H:i:s")." ของวันที่ ".date("d-m-Y");
					notify_message($linemessage,$token);

					if($query_edit)
					{
						$msg = 'แก้ไข #'.$user_f['id'].' เรียบร้อยแล้ว';
						$alert = 'success';
						$msg_alert = 'สำเร็จ!';
						//* ประกาศ
						echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$user_f['id'].' เรียบร้อยแล้ว</strong></div>';

						//* REFRESH
						echo "<meta http-equiv='refresh' content='5 ;'>";
					}
					else
					{
						$msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$user_f['id'];
						$alert = 'error';
						$msg_alert = 'เกิดข้อผิดพลาด!';
						//* ประกาศ
						echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$user_f['id'].'</strong></div>';

						//* REFRESH
						echo "<meta http-equiv='refresh' content='5 ;'>";
					}
				}
				else
				{
					$msg = 'กรุณากรอกให้ครบทุกช่อง';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>กรุณากรอกให้ครบทุกช่อง</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
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
				<h4 class="mb-3 text-center">จัดการสมาชิก <div class='text-muted'>#<?php echo $user_f['id']; ?></div></h4>
				<form name="edit_user" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
				            <label for="username">UserName</label>
				            <input type="text" class="form-control" id="username" name="username" readonly="" value="<?php echo $user_f['username']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="realname">RealName</label>
				            <input type="text" class="form-control" id="realname" name="realname" readonly="" value="<?php echo $user_f['realname']; ?>">
				        </div>
				        <div class="col-md-8 mb-3">
				            <label for="email">Email</label>
				            <input type="email" class="form-control" id="email" name="email" readonly="" value="<?php echo $user_f['email']; ?>">
				        </div>
				        <div class="col-md-4 mb-3">
				            <label for="ip">IP Address</label>
				            <input type="text" class="form-control" id="ip" name="ip" readonly="" value="<?php echo $user_f['ip']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="points">พ้อยต์ที่ได้</label>
				            <input type="text" class="form-control" id="points" name="points" value="0">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="topup">ยอดเติมเงิน</label>
				            <input type="text" class="form-control" id="topup" name="topup" value="0">
				        </div>
						<div class="col-md-12 mb-3">
							<label for="topupwith">เติมเงินด้วย</label>
							<select name="topupwith" class="form-control">
								<option value="เติมเงินด้วยทรูวอเลต">เติมเงินด้วยทรูวอเลต</option>
								<option value="เติมเงินด้วยทรูมันนี่">เติมเงินด้วยทรูมันนี่</option>
								<option value="เติมเงินด้วยธนาคาร">เติมเงินด้วยธนาคาร</option>
								<option value="เติมเงินด้วยพร้อมเพย์">เติมเงินด้วยพร้อมเพย์</option>
							</select>
						</div>
				        <div class="col-md-6 my-4">
				        	<button type="submit" name="btn_edit_user" class="btn btn-success btn-block">
				        		แก้ไข #<?php echo $user_f['id']; ?>
				        	</button>
				        </div>
				    </div>
				</form>
			<?php
		}
		else
		{
			echo "<h5 class='mb-2 text-center'>ไม่พบผู้เล่น ID: ".$user_id."</h5>";
			echo "<div class='text-center'><a href='?page=backend&menu=manageuser'>กดเพื่อกลับ</a></div>";
		}
	}
	else
	{
		?>
			<form name="search_user" method="POST">
				<div class="col-5 col-md-5 col-sm-5 offset-7 pull-right text-right mb-2">
					<div class="input-group">
					    <input type="text" class="form-control" id="input_search" name="input_search" placeholder="Username หรือ ID">
					    <div class="input-group-append">
			            	<button type="submit" name="btn_search_user" class="btn btn-success">ค้นหา</button>
			          	</div>
					</div>
				</div>
			</form>
			<table class="table">
				<thead>
					<tr>
						<th class="text-white">#</th>
						<th class="text-center text-white">ชื่อตัวละคร</th>
						<th class="text-center text-white">พ้อยท์</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_user_w = 'SELECT * FROM authme';
						if(isset($_POST['btn_search_user']))
						{
							$sql_user_w .= " WHERE (username LIKE '%".$_POST["input_search"]."%' ) || id LIKE '%".$_POST["input_search"]."%'";
						}
						else
						{
							$sql_user_w .= ' WHERE id = 0';
						}
						$query_user_w = $connect->query($sql_user_w);
						$i = 0;

						if($query_user_w->num_rows != 0)
						{
							while($user_w = $query_user_w->fetch_assoc())
							{
								$i++;
								echo '
									<tr>
										<td class="text-left text-white">'.$user_w['id'].'</td>
										<td class="text-center text-white"><a href="?page=backend&menu=manageusertopup&id='.$user_w['id'].'">'.$user_w['realname'].'</a></td>
										<td class="text-center text-white">'.$user_w['points'].'</td>
									</tr>
								';
							}
						}
						else
						{
							?>
								<tr>
									<td class="text-center text-white" colspan="6">
										ไม่พบข้อมูล
									</td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		<?php
	}
?>