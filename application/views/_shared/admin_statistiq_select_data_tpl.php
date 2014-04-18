<div class="row margin-top-14">
  <div class="col-md-12">
    <form class="form-horizontal" role="form" method="post">
  
    
      <div class="form-group">
        <div class="col-lg-12">
          <div class="input-group">

            <div class="datetimepicker input-append display-inline-block margin-right-10 width_31">
              От: <input data-format="dd-MM-yyyy" name="date_start" class="picker width_70" type="text" value="<?php echo $statistiqData['date_start']; ?>" />
              <span class="add-on">
                 &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                 </i>
              </span>
            </div>

            <div class="datetimepicker input-append display-inline-block margin-right-10 width_32">
              До: <input data-format="dd-MM-yyyy" name="date_end" class="picker width_70" type="text" value="<?php echo $statistiqData['date_end']; ?>" />
              <span class="add-on">
                 &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                 </i>
              </span>
            </div>
            <div class="display-inline-block">
              <input type="submit" name="date" class="btn btn-default vertical-align-baseline" value="Применить" />
            </div>

          </div>
        </div>
      </div>

    </form>
  </div>
</div>