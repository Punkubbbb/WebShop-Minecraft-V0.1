<?php
    $page = $_GET['page'];
    include_once 'template/navbar.php';
?>
<section id="headers">
    <div class="headers-container">
        <div class="container">
            <img class="logo animated infinite pulse img-fluid" src="<?php echo $config['site']; ?>/assets/images/logo.png">
            <br>
            <p style="font-size: 40px; color: #fff;">ยินดีต้อนรับเข้าสู่เซิพเวอร์ "<?php echo $config['name_server']; ?>"</p>
            <p style="font-size: 20px; color: #fff;">เซิพเวอร์ ไอพี: <?php echo $config['ip_show']; ?> เวอร์ชั่น: <?php echo $config['version_server'] ?></p>
        </div>
    </div>
</section>
<?php include_once 'template/status.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 order-md-1">
            <?php
            if(isset($_SESSION['uid']) || isset($_SESSION['username'])) {
                include_once 'template/member.php';
                if($page == 'logout') {
                    include_once 'template/logout.php';
                }
            }
            include_once 'template/top.php';
			include_once 'template/last_topup.php';
            include_once 'template/discord.php';
            ?>
        </div>
        <div class="col-lg-8 order-md-2">
            <?php
            if($page == 'home') {
                include_once 'template/slide.php';
                include_once 'template/announce.php';
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        include_once 'template/topupm_tmn.php';
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        include_once 'template/topupm_wallet.php';
                        ?>
                    </div>
                </div>
                <?php
                include_once 'template/product.php';
            } else if($page == 'shop') {
                include_once 'template/product.php';
            } else if($page == 'buy') {
                include_once 'template/checkout.php';
            } else if($page == 'reward') {
                include_once 'template/rp_product.php';
            } else if($page == 'rp') {
                include_once 'template/rp_checkout.php';
            } else if($page == 'redeem') {
                include_once 'template/redeem.php';
            } else if($page == 'topup') {
                include_once 'template/topup.php';
            } else if($page == 'ibanking') {
                include_once 'template/ibanking.php';
            } else if($page == 'promptpay') {
                include_once 'template/promptpay.php';
            } else if($page == 'truewallet') {
                include_once 'template/truewallet.php';
            } else if($page == 'truemoney') {
                include_once 'template/truemoney.php';
            } else if($page == 'bank') {
                include_once 'template/bank.php';
            } else if($page == 'logout') {
                include_once 'template/logout.php';
            } else if($page == 'gift') {
                include_once 'template/gift.php';
            } else if($page == 'history') {
                include_once 'template/history.php';
            } else if($page == 'history_buy') {
                include_once 'template/history_buy.php';
            } else if($page == 'history_topup') {
                include_once 'template/history_topup.php';
            } else if($page == 'backend' && isset($_SESSION['uid']) && $player['status'] == 99) {
                include_once 'template/backend/admin.php';
            } else if($page == 'register') {
                if(isset($_SESSION['uid']) || isset($_SESSION['username'])) {
                    include 'template/product.php';
                } else {
                    include_once 'template/register.php';
                }
            } else if($page == 'login') {
                if(isset($_SESSION['uid']) || isset($_SESSION['username'])) {
                    include_once 'template/product.php';
                } else {
                    include_once 'template/alertLogin.php';
                }
            } else {
                include_once 'template/slide.php';
                include_once 'template/announce.php';
                // ?>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <?php
                        include_once 'template/topupm_tmn.php';
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        include_once 'template/topupm_wallet.php';
                        ?>
                    </div>
                </div> -->
                <?php
                include_once 'template/product.php';
            }
            ?>
        </div>
    </div>
</div>
<?php include_once 'template/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>