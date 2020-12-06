<?php
$sql_list = 'SELECT * FROM authme ORDER BY topup DESC LIMIT 5';
$query_list = $connect->query($sql_list);
?>
<div class="card mb-3" style="background-color:#2d2d2d;">
  <div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-coins"></i>&nbsp;เติมเงินสูงสุด</span>
	</div>
	<div class="card-body">
    <table width="100%" class="table text-white" style="margin: 0;">
      <thead>
        <tr>
          <th scope="col">ชื่อผู้เล่น</th>
          <th scope="col">จำนวน</th>
        </tr>
      </thead>    
      <tbody>
        <?php
        if($query_list->num_rows > 0) {
          while($list_topup = $query_list->fetch_assoc()) {
            ?>
            <tr>
              <td>
                <img src="https://minotar.net/helm/<?php echo $list_topup['realname']; ?>/28" class="mr-3" width="28"><?php echo $list_topup['realname']; ?>
                <!-- <img src="https://cravatar.eu/helmavatar/<?php echo $list_topup['username']; ?>/28.png" class="mr-3" width="28"><?php echo $list_topup['realname']; ?> -->
              </td>
              <td>
              <?php echo number_format($list_topup['topup'],2); ?> <i class="fas fa-coins text-white"></i>
              </td>
            </tr>
            <?php
            }
          } else {
            ?>
            <tr>
              <td>
                <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ไม่มีคนเติมเงินล่าสุด
                <!-- <img src="https://cravatar.eu/helmavatar/Steve/28.png" class="mr-3" width="28">ไม่มีอันดับคนเติมเงินเดือนนี้ -->
              </td>
              <td>
                <?php echo number_format("0",2); ?> <i class="fas fa-coins text-white"></i>
              </td>
            </tr>
            <?php
          }
          ?>
      </tbody>
    </table>
	</div>
</div>