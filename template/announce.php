<div class="card mb-3" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-bullhorn"></i>&nbsp;ประกาศและข่าวสาร</span>
	</div>
	<div class="card-body">
		<table class="table mb-0 text-white" style="width: 100%;">
	    <thead>
			<tr>
				<th scope="col" class="text-center">#</th>
				<th scope="col" class="text-center">ประกาศ</th>
				<th scope="col" class="text-right">วันที่-เวลา</th>
	      	</tr>
	    </thead>
			<tbody>
				<?php
					$query_announce = $connect->query('SELECT * FROM announce ORDER BY id DESC LIMIT 5');
					if($query_announce->num_rows > 0)
					{
						$i = 1;
						while($announce = $query_announce->fetch_assoc())
						{
						?>
						<tr>
							<td class="text-center">
								<label class="badge" style="color: #fff; box-shadow: 3px 5px 20px #ff94fd!important; background-color: #ff94fd;">ประกาศ</label>
							</td>
							<td class="text-center">
								<?php echo $announce['html']; ?>
							</td>
							<td class="text-right">
								<?php echo $announce['date_create']; ?>
							</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
						<tr>
							<td class="text-center" colspan="3">
							ยังไม่มีประกาศ
							</td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>