<div style="min-height:0px;border-top:3px solid #ff94fd;position: relative; background-color:#383838;" class="mt-5">
          <div class="container" style="padding-top:20px;padding-bottom:20px;">
            <div class="row">
              <div class="col-7">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-light">IP :</span>
                  </div>
                  <input type="text" class="form-control form-control-lg" onclick="this.select()" readonly="" style="text-align:center;" value="<?php echo $config['ip_show']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text bg-dark text-light">เวอร์ชัน <?php echo $config['version_server']; ?></span>
                  </div>
                </div>
                <div style="color:#F3F3F3; margin-bottom:10px;">
                  <?php echo $config['detail_server']; ?>
                </div>

              </div>
              <div class="col-5">
                <iframe src="https://www.facebook.com/plugins/page.php?href=<?php echo urlencode($config['page_facebook']); ?>&amp;tabs&amp;width=440&amp;height=400&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId=1402610513369583" height="215" style="border:none;overflow:hidden;width:100%;" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
              </div>
            </div>
          </div>
</div>
<div class="bg-dark" style="background-color:#2f3133!important">
  <div class="contx" style="padding:8px;color:#FFF; text-align:center;">
    <small style="font-size:14px;">Design &amp; System By <a href="https://www.facebook.com/nobphakhu.nachipoon" style="color:#FFF;text-decoration:underline;"><strong>NuengKuB</strong></a></small>
    <small style="font-size:14px;">Modify By <a href="https://www.facebook.com/FukkTheDuck" style="color:#FFF;text-decoration:underline;"><strong>FukkTheDuck © </strong></a></small>
  </div>
</div>