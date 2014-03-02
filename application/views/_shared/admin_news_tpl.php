<!-- Page title -->
<div class="page-title">
  <h2><div class="icon_style icon_news"></div> Новости</h2>
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

            <?php if($newsDataObj){ foreach ($newsDataObj as $key => $currentNewsDataObj) { ?>
              <div class="panel panel-default">

                <div class="panel-heading">
                  <h2 class="panel-title"><?php echo $currentNewsDataObj->title; ?> 
                    <div class="float_right text-align-right"><?php echo $currentNewsDataObj->dataadd; ?></div>
                  </h2>
                </div>

                <div class="panel-body">
                  <?php echo $currentNewsDataObj->text; ?>
                </div>

              </div>
            <?php } } ?>

            <?php if(!$newsDataObj) { ?><div class="alert alert-warning">К сожалению на данный момент новостей нет.</div>
            <?php } ?>
          </div>

       </div>
    </div>

  </div>
</div>