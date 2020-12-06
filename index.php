<?php
	require_once("settings/_config.php");
	require_once("settings/_time2reset_mtopup.php");

	if(isset($_SESSION['uid']) || isset($_SESSION['username']))
	{
		$sql_player = 'SELECT * FROM authme WHERE id = "'.$_SESSION['uid'].'"';
		$query_player = $connect->query($sql_player);

		if($query_player->num_rows <= 0)
		{
			session_destroy();

				//* REFRESH
			echo "<meta http-equiv='refresh' content='0 ;'>";
		}
		else
		{
			$player = $query_player->fetch_assoc();
		}
	}

	if($time2reset_mtopup <= time())
	{
		file_put_contents('application/_time2reset_mtopup.php','<?php $time2reset_mtopup = '.strtotime('first day of next month midnight').'; ?>');
		$connect->query("UPDATE authme SET topup_m = 0, topup_w = 0");

		//* REFRESH
	}
?>
<html>
<head>
	<?php include_once 'template/taghead.php'; ?>
</head>
<body style="background-color:#000000;">
	<?php include_once 'template/home.php'; ?>
	<!-- <button class="bestzige-online btn-lg animated fadeInup" disabled="disabled" style="background-color:#03a9f421; color:#FFF; border: 1px solid #03a9f4; border-radius:100px 100px;"><i class="fas fa-circle-notch fa-spin "></i><span style="font-size:18px;"> ออนไลน์ N/A คน</span></button> -->
	<?php
	$page = $_GET['page'];
	if($page == "home" || $page == "") {
		?>
		<div id="promotion-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content text-white" style="background-color: #505050;">
					<div class="modal-header">
						<h6 class="modal-title"><?php echo $config['promotion_title']; ?></h6>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true"><i class="fa fa-times"></i></span>
						</button>
					</div>
					<div class="modal-body p-0" style="background-color: #505050;">
						<img class="w-100" src="<?php echo $config['images_link_promotion']; ?>" alt="">
					</div>
					<div class="modal-footer py-2" style="background-color: #505050;">
						<button type="button" style="background-color: #ff94fd;" class="btn px-3" data-dismiss="modal">ปิด!</button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	<script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" type="text/javascript" class="js-httpscdnjsdelivrnetnpmwidgetbotcrate3">
		new Crate({
			shard: 'https://discordapp.com/widget?id=<?php echo $config['discord_id'] ?>&theme=dark" width="250" height="450" allowtransparency="true" frameborder="0"'
		})
	</script>
</body>
</html>