<!DOCTYPE html>
<html>
<head>
  <title>Ladyads</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link href="/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600italic,600' rel='stylesheet' type='text/css'>

  <script src="/js/admin/include_page/jquery.js"></script>
  <?php
    if ($header['css']) {
      foreach( $header['css'] as $css ){ echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />
  '; }
    }
  ?>
</head>