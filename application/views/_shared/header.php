<!DOCTYPE html>
<html>
<head>
  <title>Ladyads</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php
  if ($header['css']) {
    foreach( $header['css'] as $css ){ echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />'; }
  }
  ?>
</head>