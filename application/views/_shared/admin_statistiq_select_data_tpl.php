<form class="form-horizontal" role="form" method="post">
  <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8">
        <div class="form-group">
          <div class="col-lg-12">
            <div class="input-group">

              <div class="datetimepicker input-append display-inline-block margin-right-10">
                От: <input data-format="dd-MM-yyyy" name="date_start" class="picker" type="text" value="<?php echo $statistiqData['date_start']; ?>" />
                <span class="add-on">
                   &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                   </i>
                </span>
              </div>

              <div class="datetimepicker input-append display-inline-block margin-right-10">
                До: <input data-format="dd-MM-yyyy" name="date_end" class="picker" type="text" value="<?php echo $statistiqData['date_end']; ?>" />
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

    </div>
  </div>
</form>