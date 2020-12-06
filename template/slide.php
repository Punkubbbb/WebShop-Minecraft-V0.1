<?php
$sql_slide = 'SELECT * FROM slide ORDER BY id DESC';
$query_slide = $connect->query($sql_slide);
if($query_slide->num_rows > 0) {
  ?>
  <div class="card mb-3" style="background-color:#2d2d2d;">
    <div class="card-header text-center p-1" style="border-bottom: 3px solid #ff94fd;">
      <span class="text-white" style="display: block;"><i class="fas fa-image"></i>&nbsp;รูปภาพและโปรโมชั่น</span>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $i_slide = 0;
        while($slide = $query_slide->fetch_assoc()) {
          ?>
          <div class="carousel-item <?php if($i_slide == 0){ echo "active"; } ?>">
            <img src="<?php echo $slide['url']; ?>" class="d-block w-100">
          </div>
          <?php
          $i_slide++;
        }
        ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <?php
}
?>