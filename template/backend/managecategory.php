<?php
	if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
	{
		$sql_category = 'SELECT * FROM category WHERE id = "'.$_GET['id'].'"';
		$query_category = $connect->query($sql_category);
		if($query_category->num_rows != 0)
		{
			$category_f = $query_category->fetch_assoc();

			if(isset($_POST['btn_edit']))
			{
				$edit_name_category_u = $connect->real_escape_string($_POST['edit_name_category']);
				$sql_edit = 'UPDATE category SET name = "'.$edit_name_category_u.'" WHERE id = "'.$category_f['id'].'"';
				$query_edit = $connect->query($sql_edit);

				if($query_edit)
				{
					$msg = 'แก้ไขชื่อหมวดหมู่ '.$category_f['name'].' เป็น '.$edit_name_category_u.' เรียบร้อยแล้ว';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';

					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขชื่อหมวดหมู่ '.$category_f['name'].' เป็น '.$edit_name_category_u.' เรียบร้อยแล้ว</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					$msg = 'ไม่สามารถแก้ไขชื่อหมวดหมู่ '.$category_f['name'].' เป็น '.$edit_name_category_u.' ได้ในขณะนี้';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';

					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ไม่สามารถแก้ไขชื่อหมวดหมู่ '.$category_f['name'].' เป็น '.$edit_name_category_u.' ได้ในขณะนี้</strong></div>';

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

			if(isset($_POST['btn_delete']))
			{
				$sql_delete = 'DELETE FROM category WHERE id = "'.$category_f['id'].'"';
				$query_delete = $connect->query($sql_delete);

				if($query_delete)
				{
					$msg = 'ลบหมวดหมู่ ID: '.$category_f['id'].' เรียบร้อยแล้ว';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบหมวดหมู่ ID: '.$category_f['id'].' เรียบร้อยแล้ว</strong></div>';

					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					$msg = 'ไม่สามารถลบหมวดหมู่ ID: '.$category_f['id'].' ได้ในขณะนี้';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
					//* ประกาศ
					echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ไม่สามารถลบหมวดหมู่ ID: '.$category_f['id'].' ได้ในขณะนี้</strong></div>';

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
				<h4 class="mb-3 text-center">จัดการหมวดหมู่<div class='text-muted'>#<?php echo $category_f['id']; ?></div></h4>
				<form name="edit_user" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
				            <label for="edit_name_category">ชื่อหมวดหมู่</label>
				            <input type="text" class="form-control" id="edit_name_category" name="edit_name_category" value="<?php echo $category_f['name']; ?>">
				        </div>
				        <div class="col-md-3 mt-4 mb-3">
				            <button type="submit" class="btn btn-success btn-block" name="btn_edit">
				            	แก้ไข
				            </button>
				        </div>
				        <div class="col-md-3 mt-4 mb-3">
				            <button type="submit" class="btn btn-success btn-block" name="btn_delete">
				            	ลบ
				            </button>
				        </div>
				    </div>
				</form>
			<?php
		}
		else
		{
			echo "<h5 class='col-md-12 text-center'>ไม่พบหมวดหมู่นี้</h5>";
		}
	}
	else
	{
		if(isset($_POST['btn_add_category']))
		{
			if(!empty($_POST['name_category']))
			{
				$name_category = $connect->real_escape_string($_POST['name_category']);
				$sql_add = 'INSERT INTO category (name) VALUES ("'.$name_category.'")';
				$query_add = $connect->query($sql_add);

				if($query_add)
				{
					$msg = 'เพิ่มหมวดหมู่ '.$name_category.' เรียบร้อยแล้ว';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
				else
				{
					$msg = 'ไม่สามารถเพิ่มหมวดหมู่ '.$name_category.' ได้';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
					//* REFRESH
					echo "<meta http-equiv='refresh' content='5 ;'>";
				}
			}
			else
			{
				$msg = 'กรุณากรอกชื่อหมวดหมู่';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
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
		// if(isset($_POST['btn_add_category']))
		// {
		// 	if(!empty($_POST['name_category']))
		// 	{
		// 		if(!empty($_POST['category_bungeecord'])) {
		// 			$category_bungeecord_add = $_POST['category_bungeecord'];
		// 			$name_category = $connect->real_escape_string($_POST['name_category']);
		// 			$sql_add = 'INSERT INTO category (name,server_id) VALUES ("'.$name_category.'", "'.$category_bungeecord_add.'")';
		// 			$query_add = $connect->query($sql_add);

		// 			if($query_add)
		// 			{
		// 				$msg = 'เพิ่มหมวดหมู่ '.$name_category.' เรียบร้อยแล้ว';
		// 				$alert = 'success';
		// 				$msg_alert = 'สำเร็จ!';
		// 				//* REFRESH
		// 				echo "<meta http-equiv='refresh' content='5 ;'>";
		// 			}
		// 			else
		// 			{
		// 				$msg = 'ไม่สามารถเพิ่มหมวดหมู่ '.$name_category.' ได้';
		// 				$alert = 'error';
		// 				$msg_alert = 'เกิดข้อผิดพลาด!';
		// 				//* REFRESH
		// 				echo "<meta http-equiv='refresh' content='5 ;'>";
		// 			}

		// 		} else {
		// 			$msg = 'กรุณาเลือกเซิฟเวอร์';
		// 			$alert = 'error';
		// 			$msg_alert = 'เกิดข้อผิดพลาด!';
		// 			//* REFRESH
		// 			echo "<meta http-equiv='refresh' content='5 ;'>";
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$msg = 'กรุณากรอกชื่อหมวดหมู่';
		// 		$alert = 'error';
		// 		$msg_alert = 'เกิดข้อผิดพลาด!';
		// 		//* REFRESH
		// 		echo "<meta http-equiv='refresh' content='5 ;'>";
		// 	}
		// }
	?>
	<form name="add_category" method="POST">
		<div class="col-12 col-md-12 col-sm-12 mb-2">
			<div class="input-group">
			    <input type="text" class="form-control" id="name_category" name="name_category" placeholder="ชื่อหมวดหมู่">
                <!-- <select name="category_bungeecord" class="form-control" required="">
					<?php
					$sql_bungeecord = "SELECT * FROM bungeecord";
					$query_bungeecord = $connect->query($sql_bungeecord);
					if($query_bungeecord->num_rows != 0) {
						while($result_bungee = $query_bungeecord->fetch_assoc()) {
							?>
							<option value="<?php echo $result_bungee["id"];?>"><?php echo $result_bungee["id"]." - ".$result_bungee["name_server"];?></option>
							<?php
						}
					} else {
						?>
						<option value="0">ไม่มี Server กรุณาเพิ่ม Server ก่อน</option>
						<?php
					}
					?>
				</select> -->
			    <div class="input-group-append">
				    <button type="submit" name="btn_add_category" class="btn btn-success">เพิ่ม</button>
				</div>
			</div>
		</div>
	</form>
	<table class="table table-default table-striped table-condenseds">
		<thead>
			<tr>
				<th class="text-white">#</th>
				<th class="text-center text-white">ชื่อหมวดหมู่</th>
				<th class="text-center text-white">แก้ไข</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql_list_category = 'SELECT * FROM category ORDER BY id ASC';
				$query_list_category = $connect->query($sql_list_category);
				$i = 0;
				if($query_list_category->num_rows != 0)
				{
		while($list_category = $query_list_category->fetch_assoc())
		{
			$i++;
			echo '
				<tr>
					<td class="text-left text-white">'.$list_category['id'].'</td>
					<td class="text-center text-white">'.$list_category['name'].'</td>
					<td class="text-center text-white"><a href="?page=backend&menu=managecategory&id='.$list_category['id'].'" class="btn btn-success">แก้ไข #'.$list_category['id'].'</a></td>
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