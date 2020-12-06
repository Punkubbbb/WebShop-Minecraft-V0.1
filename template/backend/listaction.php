<?php
	if(!isset($_SESSION['step2']))
	{
		include_once 'template/backend/login_step2.php';
	}
	else
	{
		?>
			<table id="example" class="table">
				<thead>
					<tr>
						<th class="text-center text-white">ชื่อตัวละคร</th>
						<th class="text-center text-white">ระบบ</th>
						<th class="text-center text-white">เวลา</th>
						<th class="text-center text-white">จำนวน</th>
						<th class="text-center text-white">อ้างอิง</th>
						<th class="text-center text-white">เซิฟ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql_list_topup = 'SELECT * FROM activities ORDER BY id ASC';
						$query_list_topup = $connect->query($sql_list_topup);
						$i = 0;
						if($query_list_topup->num_rows != 0)
						{
							while($list_topup = $query_list_topup->fetch_assoc())
							{
								$i++;
								echo '
									<tr>
										<td class="text-center text-white">'.$list_topup['username'].'</td>
										<td class="text-center text-white">'.$list_topup['action'].'</td>
										<td class="text-center text-white">'.$list_topup['date'].'</td>
										<td class="text-center text-white">'.$list_topup['topup_amount'].'</td>
										<td class="text-center text-white">'.$list_topup['transaction'].'</td>
										<td class="text-center text-white">'.$list_topup['server_id'].'</td>
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