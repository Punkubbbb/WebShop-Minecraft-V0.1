<?php
$link_page = "page";
?>
<nav class="navbar navbar-expand-lg navbar-dark c navbar-expand-sm sticky-top"">
	<div class="container">
		<a class="nav-link navbar-brand" href="?<?php echo $link_page; ?>=home"><i class="fa fa-home"></i>&nbsp;หน้าแรก</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse " id="navbarNavAltMarkup">
			<div class="navbar-nav ">
				<li class="nav-item ">
					<a class="nav-link" href="?<?php echo $link_page; ?>=shop"><i class="fa fa-shopping-cart"></i>&nbsp;ร้านค้า</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="?<?php echo $link_page; ?>=reward"><i class="fa fa-shopping-cart"></i>&nbsp;แลกของ</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="?<?php echo $link_page; ?>=topup"><i class="fa fa-money"></i>&nbsp;เติมเงิน</a>
				</li>
				<?php
				if(isset($_SESSION['uid'])) {
					?>
					<li class="nav-item ">
						<a class="nav-link" href="?<?php echo $link_page; ?>=gift"><i class="fas fa-gift"></i>&nbsp;รับของขวัญ</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="?<?php echo $link_page; ?>=history"><i class="fas fa-history"></i>&nbsp;ประวัติการต่างๆ</a>
					</li>
					<?php
					if($player['status'] == 99) {
						?>
						<li class="nav-item">
							<a class="nav-link" href="?<?php echo $link_page; ?>=backend"><i class="fas fa-book-reader"></i> ระบบหลังบ้าน</a>
						</li>
						<?php
					}
				} else {
					?>
					<li class="nav-item ">
						<a class="nav-link" href="?<?php echo $link_page; ?>=login"><i class="fa fa-user"></i>&nbsp;เข้าสู่ระบบ</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="?<?php echo $link_page; ?>=register"><i class="fa fa-user-plus"></i>&nbsp;สมัครสมาชิก</a>
					</li>
					<?php
				}
				?>
				<!-- <li class="nav-item dropdown">
		  			<a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		   				<i class="fa fa-database"></i>&nbsp;ดูข้อมูลในเกม
		  			</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		   				<a class="dropdown-item " href="?<?php echo $link_page; ?>=pokemon"><img src="assets/images/icon/mewto.png" height="30">&nbsp;ข้อมูลโปเกม่อน</a>
		   				<a class="dropdown-item " href="?<?php echo $link_page; ?>=boss"><img src="assets/images/icon/boss.png" height="30">&nbsp;ข้อมูลบอสโปเกม่อน</a>
						<a class="dropdown-item " href="?<?php echo $link_page; ?>=quest"><i class="fa fa-question-circle" style="font-size:26px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ข้อมูลเควส</a>
						<a class="dropdown-item " href="?<?php echo $link_page; ?>=rank"><i class="fa fa-globe" style="font-size:26px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ข้อมูลยศ</a>
						<a class="dropdown-item " href="?<?php echo $link_page; ?>=item"><i class="fa fa-list" style="font-size:25px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ข้อมูลไอเท็ม</a>
		 				<div class="dropdown-divider "></div>
			 			<a class="dropdown-item" href="<?php echo $config['site']; ?>"><i class="fa fa-map"></i>&nbsp;&nbsp;&nbsp;ดูแมพโลกโปเกม่อน (เร็วๆนี้)</a>
		  			</div>
		 		</li>   
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-check-circle "></i>&nbsp;วิธีเล่น & คู่มือ
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="?<?php echo $link_page; ?>=howtoplay"><i class="fa fa-gamepad "></i>&nbsp;วิธีการเล่น</a>                 
					</div>
				</li> -->
			</div>
			<!-- <div class="collapse navbar-collapse nav justify-content-end">
				<div class="navbar-nav">
					<ul class="navbar-nav mr-auto w3-card-6">
						<li class="nav-item ">
							<a class="btn btn-danger" href="?<?php echo $link_page; ?>=problem"><i class="fa fa-exclamation-triangle"></i>&nbsp;วิธีแก้เข้าไม่ได้ | แจ้งปัญหา </a>                       
						</li>
					</ul>
				</div>
			</div> -->
		</div>
	</div>
</nav>