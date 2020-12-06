<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-book-reader"></i>&nbsp;ระบบแอดมิน</span>
	</div>
	<div class="card-body">
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
	    {
	        include_once 'template/alertLogin.php';
	    }
	    else
	    {
	    	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == NULL || $_SESSION['admin'] == "" || $_SESSION['admin'] != $config['backend_password'])
			{
				include_once 'template/backend/login.php';
			}
			else
			{
				?>
				
					<div class="row">
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=manageuser" class="btn btn-success btn-block">
								จัดการผู้เล่น
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=manageusertopup" class="btn btn-success btn-block">
								เพิ่มพ้อยท์ผู้เล่น
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=manageproduct" class="btn btn-success btn-block">
								จัดการสินค้า
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=manageproduct&action=add" class="btn btn-success btn-block">
								เพิ่มสินค้า
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=managereward" class="btn btn-success btn-block">
								จิดการแลกของ
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=managereward&action=add" class="btn btn-success btn-block">
								เพิ่มแลกของ
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=managecategory" class="btn btn-success btn-block">
								จัดการหมวดหมู่
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=bungeecord" class="btn btn-success btn-block">
								Bungeecord
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=upload" class="btn btn-success btn-block">
								อัพโหลดรูปภาพ
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=slide" class="btn btn-success btn-block">
								สไลค์
							</a>
						</div>
						<div class="col-md-3 mb-2">
							<a href="?page=backend&menu=manageannounce" class="btn btn-success btn-block">
								ประกาศ
							</a>
						</div>
						<div class="col-md-12 mb-2">
							<a href="?page=backend&menu=settings" class="btn btn-success btn-block">
								จัดการอัตราการเติมเงินทรูมันนี้และรายได้
							</a>
						</div>
						<div class="col-md-12 mb-2">
							<span class="is-divider" data-content="#ADMIN: <?php echo $player['realname']; ?>" style="margin: 1.5rem 0;"></span>
						</div>
					</div>
				<?php
				if(isset($_GET['menu']) && $_GET['menu'] != NULL && $_GET['menu'] != "")
				{
					$menu = $_GET['menu'];
					if($menu == 'manageuser')
					{
						include_once 'template/backend/manageuser.php';
					}
					elseif($menu == 'historytopup')
					{
						include_once 'template/backend/list_topup.php';
					}
					elseif($menu == 'manageproduct')
					{
						include_once 'template/backend/product.php';
					}
					elseif($menu == 'managecategory')
					{
						include_once 'template/backend/managecategory.php';
					}
					elseif($menu == 'settings')
					{
						include_once 'template/backend/settings.php';
					}
					elseif($menu == 'managereward')
					{
						include_once 'template/backend/managereward.php';
					}
					elseif($menu == 'bungeecord')
					{
						include_once 'template/backend/bungeecord.php';
					}
					elseif($menu == 'redeem')
					{
						include_once 'template/backend/redeem.php';
					}
					elseif($menu == 'upload')
					{
						include_once 'template/backend/upload.php';
					}
					elseif($menu == 'listaction')
					{
						include_once 'template/backend/listaction.php';
					}
					elseif($menu == 'manageannounce')
					{
						include_once 'template/backend/manageannounce.php';
					}
					elseif($menu == 'manageusertopup')
					{
						include_once 'template/backend/manageusertopup.php';
					}
					elseif($menu == 'slide')
					{
						include_once 'template/backend/slide.php';
					}
					else
					{
						echo "<h5 class='mb-2 text-center'>ไม่พบเมนูนี้</h5>";
					}
				}
				else
				{
					echo "<h5 class='mb-2 text-center'>เลือกเมนูเพื่อใช้งาน</h5>";
				}
			}
	    }
	?>
	</div>
</div>