<style>
	.custom-file-upload {
	    display: inline-block;
	    padding: 6px 12px;
	    cursor: pointer;
	}
</style>
<?php
    if(isset($_POST['add_img']))
    {
    	$ranStr = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmopqrstuvwxyz"),0,12);
        $target_dir = "assets/images/uploads/";
        $target_file = $target_dir . $ranStr.".png";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["images"]["tmp_name"]);
        if($check !== false)
        {
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $target_file))
            {
                $uploadOk = 1;
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                {
                	$link = "https"; 
                }
                else
                {
                	$link = "http"; 
                }

                $link .= "://"; 
                $link .= $_SERVER['HTTP_HOST']; 
                $link .= $_SERVER['REQUEST_URI']; 
                $link = str_replace("?page=backend&menu=upload",$target_dir,$link);
                $link .= $ranStr.".png";

                
                $sql_add_img = "INSERT INTO upload_img (file_name,file_url) VALUES ('".$ranStr."','".$link."')";
                $query_add_img = $connect->query($sql_add_img);

                if($query_add_img)
                {
                	$msg = 'อัพโหลดรูปเรียบร้อยแล้ว !<br/>URL: '.$link;
					$alert = 'success';
					$msg_alert = 'สำเร็จ!';
                }
                else
                {
                	$msg = 'เกิดข้อผิดพลาด ไม่สามารถอัพโหลดรูปได้!';
					$alert = 'error';
					$msg_alert = 'เกิดข้อผิดพลาด!';
                }
            }
            else
            {
                $msg = 'เกิดข้อผิดพลาด ไม่สามารถเพิ่มรูปได้!';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
            }
        }
        else
        {
            $msg = 'เกิดข้อผิดพลาด ไฟล์นี้ไม่ใช่รูปภาพ!';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
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
<h4 class="mb-3 text-center">จัดการรูปภาพ</h4>
<form method="POST" name="addimages" enctype="multipart/form-data">
	<div class="row">
	    <div class="form-group col-md-5">
	        <input type="file" class="custom-file-upload" size="30" name="images" class="mb-3">
	    </div>
	    <div class="col-md-7">
	        <input type="submit" name="add_img" class="btn btn-success btn-block" value="อัพโหลดรูปภาพ">
	    </div>
	</div>
</form>
<hr/>
<?php
	$sql_img = 'SELECT * FROM upload_img ORDER BY id DESC';
	$query_img = $connect->query($sql_img);
	$num_img = $query_img->num_rows;

	if($num_img > 0)
	{
		echo "<h5 class='mb-3 text-center'>มีรูปภาพทั้งหมด ".$num_img." ภาพ</h5>";
		echo '<div class="row">';
		while($img_f = $query_img->fetch_assoc())
		{
			?>
				<div class="col-md-4 mb-4">
					<a href="<?php echo $img_f['file_url']; ?>" target="_blank">
						<img src="<?php echo $img_f['file_url']; ?>" style="height: 200px;" class="img-thumbnail rounded mx-auto d-block" alt="<?php echo $img_f['file_url']; ?>" data-toggle="tooltip" title="<?php echo $img_f['file_name']; ?>">
					</a>
					<input type="text" class="form-control mt-1" value="<?php echo $img_f['file_url']; ?>" onclick="this.select()" readonly="" placeholder="URL" data-toggle="tooltip" title="<?php echo $img_f['file_url']; ?>">
				</div>
			<?php
		}
		echo '</div>';
	}
	else
	{
		echo "<h5 class='my-3 text-center'>ไม่มีรูปภาพในฐานข้อมูล</h5>";
	}
?>