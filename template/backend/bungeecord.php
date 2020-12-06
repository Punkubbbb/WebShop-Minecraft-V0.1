<?php
	if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
	{
		$sql_bungeecord = 'SELECT * FROM bungeecord WHERE id = "'.$_GET['id'].'"';
		$query_bungeecord = $connect->query($sql_bungeecord);
		if($query_bungeecord->num_rows != 0)
		{
			$bungeecord_f = $query_bungeecord->fetch_assoc();

			if(isset($_POST['btn_edit']))
			{
				$edit_name_server_u = $connect->real_escape_string($_POST['edit_name_server']);
				$sql_edit = 'UPDATE bungeecord SET name_server = "'.$edit_name_server_u.'", ip_server = "'.$_POST['edit_ip_server'].'", port = "'.$_POST['edit_port_server'].'", password = "'.$_POST['edit_password_server'].'", images = "'.$_POST['edit_images_server'].'", status = "'.$_POST['edit_status_server'].'" WHERE id = "'.$bungeecord_f['id'].'"';
				$query_edit = $connect->query($sql_edit);

				if($query_edit)
				{
					$msg = 'แก้ไขเซิฟเวอร์ '.$edit_name_server_u.' เรียบร้อยแล้ว!';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
				}
				else
				{
					$msg = 'ไม่สามารถแก้ไขได้ในขณะนี้!';
					$alert = 'error';
					$msg_alert = 'ข้อผิดพลาด!';
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
				$sql_delete = 'DELETE FROM bungeecord WHERE id = "'.$bungeecord_f['id'].'"';
				$query_delete = $connect->query($sql_delete);

				if($query_delete)
				{
					$msg = 'ลบเซิฟเวอร์ '.$bungeecord_f['name'].' สำเร็จ';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
				}
				else
				{
					$msg = 'ไม่สามารถลบ '.$bungeecord_f['name'].' ได้ขณะนี้!';
					$alert = 'error';
					$msg_alert = 'ข้อผิดพลาด!';
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
				<h4 class="mb-3 text-center">จัดการ Server Bungeecord<div class='text-muted'>#<?php echo $bungeecord_f['id']; ?></div></h4>
				<form name="edit_bungeecord" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
				            <label for="edit_name_server">ชื่อ Server</label>
				            <input type="text" class="form-control" id="edit_name_server" name="edit_name_server" value="<?php echo $bungeecord_f['name_server']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_ip_server">IP SERVER</label>
				            <input type="text" class="form-control" id="edit_ip_server" name="edit_ip_server" value="<?php echo $bungeecord_f['ip_server']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_port_server">PORT Rcon</label>
				            <input type="text" class="form-control" id="edit_port_server" name="edit_port_server" value="<?php echo $bungeecord_f['port']; ?>">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_password_server">Password Rcon</label>
				            <input type="text" class="form-control" id="edit_password_server" name="edit_password_server" value="<?php echo $bungeecord_f['password']; ?>">
				        </div>
						<div class="col-md-6 mb-3">
				            <label for="edit_status_server">Images</label>
				            <input type="text" class="form-control" id="edit_images_server" name="edit_images_server" value="<?php echo $bungeecord_f['images']; ?>">
				    	</div>
				        <div class="col-md-6 mb-3">
				            <label for="edit_status_server">Status</label>
				            <input type="text" class="form-control" id="edit_status_server" name="edit_status_server" value="<?php echo $bungeecord_f['status']; ?>">
				        </div>
				        <div class="col-md-6 mt-4 mb-3">
				            <button type="submit" class="btn btn-success btn-block" name="btn_edit">
				            	แก้ไข
				            </button>
				        </div>
				        <div class="col-md-6 mt-4 mb-3">
				            <button type="submit" class="btn btn-success btn-block" name="btn_delete">
				            	ลบ
				            </button>
				        </div>
				        <div class="col-md-12 my-3 text-center">
				        	<strong>คำอธิบาย</strong>
				        	<br/>
				        	- Status หากเปิดให้ปรับเป็น 1 หากปิดให้ปรับเป็น 0
				        </div>
				    </div>
				</form>
			<?php
		}
		else
		{
			echo "<h5 class='col-md-12 text-center'>ไม่พบ Server นี้</h5>";
		}
	}
	elseif(isset($_GET['add']))
	{
		if(isset($_POST['btn_add_bungeecord']))
		{
			if(!empty($_POST['add_name_server']) && !empty($_POST['add_images_server']) && !empty($_POST['add_ip_server']) && !empty($_POST['add_status_server']) && !empty($_POST['add_port_server']) && !empty($_POST['add_password_server']))
			{
				$name_server_add = $connect->real_escape_string($_POST['add_name_server']);
				$sql_add = 'INSERT INTO bungeecord (name_server,ip_server,port,password,images,status) VALUES ("'.$name_server_add.'","'.$_POST['add_ip_server'].'","'.$_POST['add_port_server'].'","'.$_POST['add_password_server'].'","'.$_POST['add_images_server'].'","'.$_POST['add_status_server'].'")';
				$query_add = $connect->query($sql_add);

				if($query_add)
				{
					$msg = 'เพิ่มเซิฟเวอร์ '.$name_server_add.' สำเร็จ';
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
				}
				else
				{
					$msg = 'เพิ่มเซิฟเวอร์ '.$name_server_add.' ไม่สำเร็จ';
					$alert = 'error';
					$msg_alert = 'ข้อผิดพลาด!';
				}
			}
			else
			{
				$msg = 'กรุณากรอกข้อมูลให้ครบถ้วน';
				$alert = 'error';
				$msg_alert = 'ข้อผิดพลาด!';
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
			<form name="add_bungeecord" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
				        <label for="add_name_server">ชื่อ Server</label>
				        <input type="text" class="form-control" id="add_name_server" name="add_name_server">
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_ip_server">IP SERVER</label>
				        <input type="text" class="form-control" id="add_ip_server" name="add_ip_server" >
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_port_server">PORT Rcon</label>
				        <input type="text" class="form-control" id="add_port_server" name="add_port_server">
				    </div>
				    <div class="col-md-6 mb-3">
				        <label for="add_password_server">Password Rcon</label>
				        <input type="text" class="form-control" id="add_password_server" name="add_password_server">
				    </div>
					<div class="col-md-6 mb-3">
				        <label for="edit_status_server">Images</label>
				        <input type="text" class="form-control" id="add_images_server" name="add_images_server">
				    </div>
					<div class="col-md-6 mb-3">
				        <label for="edit_status_server">Status</label>
				        <input type="text" class="form-control" id="add_status_server" name="add_status_server">
				    </div>
				    <div class="col-md-12 mt-4 mb-3">
				        <button type="submit" class="btn btn-success btn-block" name="btn_add_bungeecord">
				        	เพิ่ม
				        </button>
				    </div>
					<div class="col-md-12 my-3 text-center">
				        <strong>คำอธิบาย</strong>
				        <br/>
				        - Status หากเปิดให้ปรับเป็น 1 หากปิดให้ปรับเป็น 0
				    </div>
				</div>
			</form>
		<?php
	}
	else
	{
	?>
	<div class="col-md-12 mb-3">
		<a href="?page=backend&menu=bungeecord&add" class="btn btn-success btn-block">
			เพิ่ม Server
		</a>
	</div>
	<table class="table table-default table-striped table-condenseds">
		<thead>
			<tr>
				<th class="text-white">#</th>
				<th class="text-center text-white">ชื่อ Server</th>
				<th class="text-center text-white">แก้ไข</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql_list_bungeecord = 'SELECT * FROM bungeecord ORDER BY id ASC';
				$query_list_bungeecord = $connect->query($sql_list_bungeecord);
				$i = 0;
				if($query_list_bungeecord->num_rows != 0)
				{
					while($list_bungeecord = $query_list_bungeecord->fetch_assoc())
					{
						$i++;
						echo '
							<tr>
								<td class="text-left text-white">'.$list_bungeecord['id'].'</td>
								<td class="text-center text-white">'.$list_bungeecord['name_server'].'</td>
								<td class="text-center text-white"><a href="?page=backend&menu=bungeecord&id='.$list_bungeecord['id'].'" class="btn btn-success">แก้ไข #'.$list_bungeecord['id'].'</a></td>
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