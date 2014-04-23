<div class="row">
  <div class="col-md-4">&nbsp;</div>
  <div class="col-md-8 link_stat margin-l">
    <a class="" onclick="setdate(<?php echo $defineDay['today']; ?>);">Сегодня</a>
    <a class="" onclick="setdate(<?php echo $defineDay['yesterday']; ?>);">Вчера</a>
    <a class="" onclick="setdate(<?php echo $defineDay['current_week']; ?>);">Текущая неделя</a>
    <a class="" onclick="setdate(<?php echo $defineDay['current_month']; ?>);">Текущий месяц</a>
    <a class="" onclick="setdate(<?php echo $defineDay['last_week']; ?>);">Прошлая неделя</a>
    <a class="" onclick="setdate(<?php echo $defineDay['last_month']; ?>);">Прошлый месяц</a>
  </div>
</div>
<br />
<form id="statistiq" class="form-horizontal" role="form" method="post">
  <div class="row">
    <div class="col-md-4">

      <div class="col-lg-12">

        <div class="input-group">

          <input type="text" name="search" class="form-control" placeholder="ID, URL, mail">

          <span class="input-group-btn">

            <input type="submit" name="select" class="btn btn-default" value="Выбрать" />
          </span>

        </div>

      </div>

    </div>
    <div class="col-md-8">
        <div class="form-group">
          <div class="col-lg-12">
            <div class="input-group">

              <div class="datetimepicker input-append display-inline-block width-41-pr">
                От: <input data-format="dd-MM-yyyy" name="date_start" class="picker width-70-pr" type="text" value="<?php echo $statistiqData['date_start']; ?>" />
                <span class="add-on">
                   &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                   </i>
                </span>
              </div>

              <div class="datetimepicker input-append display-inline-block width-41-pr">
                До: <input data-format="dd-MM-yyyy" name="date_end" class="picker width-70-pr" type="text" value="<?php echo $statistiqData['date_end']; ?>" />
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

  <input type="hidden" name="sorter_column" value="<?php echo $statistiqData['sorter_column']; ?>" />

  <input type="hidden" name="sorter_by" value="<?php echo $statistiqData['sorter_by']; ?>" />
</form>