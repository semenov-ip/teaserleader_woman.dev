<!-- Page title -->
<div class="page-title">
  <h2><i class="icon-desktop color"></i><?php echo $titleH4 ?></h2>
  <hr />
</div>
 
<!-- Page title -->
<div class="row">
  <div class="col-md-12">

    <div class="awidget">
       <div class="awidget-head">
       </div>
       <div class="awidget-body">

       <!-- Profile form -->

          <div class="form profile">
            <!-- Edit profile form (not working)-->
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php if($error){ echo '<div class="alert '.$error['class'].'">'.$error['text'].'</div>'; } ?>
              <div class="form-group">
                <label class="control-label col-lg-3">Изображение</label>
                <div class="col-lg-6">
                  <img src="<?php echo $teaserDataObj->image; ?>" />
                  <input type="file" name="image" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Ссылка</label>
                <div class="col-lg-6">
                  <input type="text" name="url" class="form-control" value="<?php echo $teaserDataObj->url ?>" placeholder="Ссылка">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Текст</label>
                <div class="col-lg-6">
                  <textarea class="form-control" rows="3" name="text" ><?php echo $teaserDataObj->text ?></textarea>
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="form-group">
                 <!-- Buttons -->
                  <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                    <a href="/teaser/campaigns/" type="reset" class="btn btn-default">Отменить</a>
                 </div>
              </div>
            </form>
          </div>
             
       </div>
    </div>
                        
  </div>
</div>