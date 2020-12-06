<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fa fa-history"></i>&nbsp;ประวัติการเติม</span>
	</div>
	<table id="example" class="table" style="width:100%">
		<thead>
			<tr>
				<th class="text-white">#</th>
				<th class="text-center text-white">เลขอ้างอิน</th>
				<th class="text-center text-white">ช่องทาง</th>
				<th class="text-center text-white">เวลา</th>
				<th class="text-center text-white">ยอดเติม</th>
				<th class="text-center text-white">ยอดที่ได้รับ</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql_list_topup = 'SELECT * FROM topup_logs WHERE id AND uid = "'.$_SESSION['uid'].'" ORDER BY id ASC';
				$query_list_topup = $connect->query($sql_list_topup);
				$i = 0;
				if($query_list_topup->num_rows != 0) {
					while($list_topup = $query_list_topup->fetch_assoc()) {
						$i++;
						echo '
							<tr>
								<td class="text-left text-white"><label class="badge" style="color: #fff; box-shadow: 3px 5px 20px #ff94fd!important; background-color: #ff94fd;">ระบบ</label></td>
								<td class="text-center text-white">'.$list_topup['ref'].'</td>
								<td class="text-center text-white">'.$list_topup['action'].'</td>
								<td class="text-center text-white">'.$list_topup['date'].'</td>
								<td class="text-center text-white">'.$list_topup['topup_amount'].'</td>
								<td class="text-center text-white">'.$list_topup['topup_got'].'</td>
							</tr>
						';
					}
				} else { ?>
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
</div>