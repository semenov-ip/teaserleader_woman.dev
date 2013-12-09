<!DOCTYPE html>
<html>
<head>
  <title>Richster</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <?php
    foreach( $header['css'] as $css ){
      echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />';
    }
    foreach( $header['js'] as $js ){
       echo '<script type="text/javascript" src="'.$js.'"></script>';
    }
  ?>
</head>