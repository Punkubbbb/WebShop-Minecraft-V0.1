<!-- TITLE -->
<title><?php echo $config['title']; ?></title>
<!-- META -->
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="th" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo $config['description'] ?>">
<meta name="keywords" content="<?php echo $config['keywords'] ?>">
<meta name="author" content="BESTZIGE">
<meta property="og:title" content="<?php echo $config['title'] ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $config['site']; ?>/" />
<meta property="og:image" content="<?php echo $config['site']; ?>/assets/images/ogimage.jpg" />
<meta property="og:description" content="<?php echo $config['description'] ?>" />
<!-- LINK CSS IMAGES -->
<link rel="icon" href="<?php echo $config['site']; ?>/assets/images/logo.png">
<link rel="shortcut icon" href="<?php echo $config['site']; ?>/assets/images/logo.png" type="image/x-icon"/>
<!-- LINK CSS -->
<link rel="stylesheet" href="<?php echo $config['site']; ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo $config['site']; ?>/assets/DataTables/datatables.min.css"/>
<link rel="stylesheet" href="<?php echo $config['site']; ?>/assets/css/bestzige.css">
<link rel="stylesheet" href="<?php echo $config['site']; ?>/assets/sweetalert2/sweetalert2.css">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<!-- SCRIPT JS -->
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/nmp.js"></script>
<script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/smooth.min.js"></script>
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $config['site'] ?>/assets/js/bootstrap.js"></script>
<script src="<?php echo $config['site']; ?>/assets/sweetalert2/sweetalert2.min.js"></script>
<script src="https://kit.fontawesome.com/cb03c81d11.js" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161194584-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-161194584-1');
</script>
<script>
  $(function(){
    $('#example').dataTable();
  });
</script>
<!-- STYLE CSS -->
<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Kanit');
    body {
      background-color: #f5f7fa;
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
    }
</style>
<!-- END HEAD -->
<?php
define('LINE_API',"https://notify-api.line.me/api/notify");

$token = $config['line_token'];; //ใส่Token ที่copy เอาไว้

function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}
?>