<div class="row">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10">
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['today']; ?>);">Сегодня</a>
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['yesterday']; ?>);">Вчера</a>
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['current_week']; ?>);">Текущая неделя</a>
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['current_month']; ?>);">Текущий месяц</a>
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['last_week']; ?>);">Прошлая неделя</a>
  <a class="btn btn-primary" onclick="setdate(<?php echo $defineDay['last_month']; ?>);">Прошлый месяц</a>
</div>
<br><br>
<div class="col-md-4">&nbsp;</div>

  <div class="col-md-8">

    <form id="statistiq" class="form-horizontal" role="form" method="post">

      <div class="form-group">
        <!-- <div class="col-lg-8"> -->
          <div class="input-group left_32">

            <div class="datetimepicker input-append display-inline-block margin-right-20">
              От: <input data-format="dd-MM-yyyy" name="date_start" class="picker" type="text" value="<?php echo $statistiqData['date_start']; ?>">
              <span class="add-on">
                 &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                 </i>
              </span>
            </div>

            <div class="datetimepicker input-append display-inline-block margin-right-20">
              До: <input data-format="dd-MM-yyyy" name="date_end" class="picker" type="text" value="<?php echo $statistiqData['date_end']; ?>" >
              <span class="add-on">
                 &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                 </i>
              </span>
            </div>
            <div class="display-inline-block">
              <input type="submit" class="btn btn-default vertical-align-baseline" value="Применить" />
            </div>
            
          </div>
        <!-- </div> -->
      </div>

    </form>
  </div>
</div>
<br>