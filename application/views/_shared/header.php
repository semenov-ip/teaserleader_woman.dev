<!DOCTYPE html>
<html>
<head>
  <title>Ladyads</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <?php
  if ($header['css']) {
    foreach( $header['css'] as $css ){ echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />'; }
  }
  
  if ($header['js']) {
    foreach( $header['js'] as $js ){ echo '<script type="text/javascript" src="'.$js.'"></script>'; }
  } ?>
</head>