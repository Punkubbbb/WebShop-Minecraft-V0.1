<?php
  if(isset($_GET['page']) && $_GET['page'] == 'shop')
  {
    $header_echo = "สินค้า";
  }
  else
  {
    $header_echo = "สินค้าใหม่";
  }
?>
<div class="card mb-3 text-white" style="background-color:#2d2d2d;">
	<div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
		<span class="text-white" style="display: block;"><i class="fas fa-shopping-cart"></i>&nbsp;<?php echo $header_echo; ?></span>
	</div>
	<div class="card-body">
    <?php
    $sql_bungeecord = 'SELECT * FROM bungeecord';
    $query_bungeecord = $connect->query($sql_bungeecord);
    if(!isset($_GET['server']) && !is_numeric($_GET['server'])) {
    ?>
      <div class="container mb-3">
        <div class="row mb-3">
          <?php
          while($server_bungeecord = $query_bungeecord->fetch_assoc()) {
            if(isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] != NULL) {
              echo '<div class="col-12" style="min-height: 140px;margin-bottom: 10px;">';
              echo '<div class="card" style="background: rgba(255, 255, 255, 0);border: 1px solid #ffffff;color: #000000;">';
              echo '<div class="card-body">';
              echo '<div class="d-flex">';
              echo '<div><img src="'.$server_bungeecord['images'].'" style="width: 150px;"></div>';
              echo '<div style="padding: 10px;text-align: center;width: 100%;">';
              echo '<a style="font-size: 20px;" class="text-white">'.$server_bungeecord['name_server'].'</a>';
              echo '</br>';
              echo '</br>';
              echo '<a href="?page=shop&category='.$_GET['category'].'&server='.$server_bungeecord['id'].'" class="btn btn-warning btn-block">เลือกเซิฟเวอร์</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            } else {
              echo '<div class="col-12" style="min-height: 140px;margin-bottom: 10px;">';
              echo '<div class="card" style="background: rgba(255, 255, 255, 0);border: 1px solid #ffffff;color: #000000;">';
              echo '<div class="card-body">';
              echo '<div class="d-flex">';
              echo '<div><img src="'.$server_bungeecord['images'].'" style="width: 150px;"></div>';
              echo '<div style="padding: 10px;text-align: center;width: 100%;">';
              echo '<a style="font-size: 20px;" class="text-white">'.$server_bungeecord['name_server'].'</a>';
              echo '</br>';
              echo '</br>';
              echo '<a href="?page=shop&server='.$server_bungeecord['id'].'" class="btn btn-warning btn-block">เลือกเซิฟเวอร์</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
    <?php
    } else {
      ?>
        <div class="container my-3">
          <div class="row my-3">
            <?php
            $sql_category = 'SELECT * FROM category WHERE server = "'.$_GET['server'].'"';
            $query_category = $connect->query($sql_category);
            if($query_category->num_rows <= 0) {
              ?>
              <div class="col-12 text-center aos-init" data-aos="fade-up">
                <a class="btn btn-danger btn-block">ไม่พบหมวดหมู่ร้านค้า</a>
              </div>
              <?php
            } else {
              ?>
                <?php
                while($category = $query_category->fetch_assoc()) {
                  ?>
                  <div class="col-4 text-center" data-aos="fade-up">
                    <a href="?page=shop&amp;category=<?php echo $category['id']; ?>&server=<?php echo $_GET['server']; ?>" class="btn btn-danger btn-block"><?php echo $category['name']; ?></a>
                  </div>
                  <br><br>
                  <?php
                }
                ?>
              <?php
            }
            ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <?php
            if(isset($_GET['page']) && $_GET['page'] != 'shop')
            {
              $sql_product = 'SELECT * FROM shop ORDER BY id DESC';
            }
            else
            {
              $sql_product = 'SELECT * FROM shop';
            }

            if(isset($_GET['server']) && is_numeric($_GET['server']))
            {
              $sql_product .= ' WHERE server_id = "'.$_GET['server'].'"';
            }

            if(isset($_GET['category']) && is_numeric($_GET['category']))
            {
              if(isset($_GET['server']) && is_numeric($_GET['server']))
              {
                $sql_product .= ' AND category = "'.$_GET['category'].'"';
              }
              else
              {
                $sql_product .= ' WHERE category = "'.$_GET['category'].'"';
              }
            }

            if(isset($_GET['page']) && $_GET['page'] != 'shop')
            {
              $sql_product .= ' LIMIT 6';
            }
            elseif(!isset($_GET['page']))
            {
              $sql_product .= ' LIMIT 6';
            }

            $query_product = $connect->query($sql_product);

            if($query_product->num_rows <= 0)
            {
              echo "<h5 class='col-md-12 text-center'>ไม่พบสินค้า</h5>";
            }
            else
            {
              while($product = $query_product->fetch_assoc())
              {
                ?>
                  <div class="col-6 col-sm-4 mb-2">
                    <div class="item" style="margin-bottom: 20px;">
                      <div class="item-image">
                        <a class="item-image-price"><?php echo number_format($product['price'], 2); ?> <i class="fas fa-coins"></i></a>
                        <center><img src="<?php echo $product['pic']; ?>" class="w-100"></center>
                        <a class="item-image-bottom text-center"><?php echo $product['name']; ?></a>
                      </div>
                      <div class="item-info">
                        <div class="item-text">
                          <h5 class="mb-0 text-white"><?php echo $product['name']; ?></h5>
                          <p class="mb-2 text-white"><?php echo number_format($product['price'], 2); ?> <i class="fas fa-coins"></i></p>
                          <a href="?page=buy&id=<?php echo $product['id']; ?>" class="btn btn-warning w-100 mb-1 border-0">ซื้อสินค้า</a>
                          <a href="?page=buy&id=<?php echo $product['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-gift"></i> ส่งของขวัญ</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
              }
            }
          ?>
        </div>
      <?php
    }
    ?>
	</div>
</div>