<?php
$sql_last = 'SELECT * FROM topup_logs WHERE (action = "เติมเงินด้วยทรูมันนี่" ||action = "เติมเงินด้วยทรูมันนี่" ||action = "เติมเงินด้วยธนาคาร" || action = "เติมเงินด้วยทรูวอเลต" || action = "เติมเงินด้วยทรูวอเลต" || action = "เติมเงินด้วยพร้อมเพย์") ORDER BY id DESC LIMIT 5';
$query_last = $connect->query($sql_last);
?>
<div class="card mb-3" style="background-color:#2d2d2d;">
  <div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-history graico"></i>&nbsp;เติมเงินล่าสุด</span>
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
        if($query_last->num_rows > 0) {
          while($last_topup = $query_last->fetch_assoc()) {
            ?>
            <tr>
              <td>
                <!-- <img src="https://minotar.net/avatar/<?php echo $last_topup['username']; ?>/28" class="mr-3" width="28"><?php echo $last_topup['username']; ?> -->
                <img src="https://minotar.net/helm/<?php echo $last_topup['username']; ?>/28.png" class="mr-3" width="28"><?php echo $last_topup['username']; ?>
              </td>
              <td>
                <?php echo number_format($last_topup['topup_amount'],2); ?> <i class="fas fa-coins text-white"></i>
              </td>
            </tr>
            <?php
            }
          } else {
            ?>
            <tr>
              <td>
                <!-- <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ไม่มีคนเติมเงินล่าสุด -->
                <img src="https://minotar.net/helm/steve/28.png" class="mr-3" width="28">ไม่มีคนเติมเงินล่าสุด
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