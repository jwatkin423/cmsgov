<form class="form-inline" method="get" action="{{ URL::route('search') }}">

  <div class="col-sm-3">
    <div class="form-group{{ $errors->has('by_date') ? ' has-error' : '' }}">
      <label for="by_date">Date:</label>
      {{ Form::text('by_date', isset($cms->by_date) ? $cms->by_date : '', ['class' => 'form-control', 'id' => 'datepicker']) }}
      @if ($errors->has('by_date'))
        {{ $errors->first('by_date') }}
      @endif
    </div>
  </div>

  <div class="col-sm-3">
    <div class="form-group{{ $errors->has('month_year') ? ' has-error' : '' }}">
      <label for="month_year">Month and Year:</label>
      {{ Form::text('month_year', isset($cms->month_year) ? $cms->month_year : '', ['class' => 'form-control', 'id' => 'month-year']) }}
      @if ($errors->has('month_year'))
        {{ $errors->first('month_year') }}
      @endif
    </div>
  </div>

  <div class="col-sm-3">
    <div class="form-group{{ $errors->has('cms_amount') ? ' has-error' : '' }}">
      <label for="cms_amount">Amount:</label>
      {{ Form::text('cms_amount', isset($cms->cms_amount) ? $cms->cms_amount : '', ['class' => 'form-control']) }}
      @if ($errors->has('cms_amount'))
        {{ $errors->first('cms_amount') }}
      @endif
    </div>
  </div>

  <div class="col-sm-3">
    <div class="form-group{{ $errors->has('phy_name') ? ' has-error' : '' }}">
      <label for="phy_name">Physician last name:</label>
      {{ Form::text('phy_name', isset($cms->phy_name) ? $cms->phy_name : '', ['class' => 'form-control']) }}
      @if ($errors->has('phy_name'))
        {{ $errors->first('phy_name') }}
      @endif
    </div>
  </div>

  <div class="col-sm-3">
    <div class="form-group{{ $errors->has('limit') ? ' has-error' : '' }}">
      <label for="limit">Limit:</label>
      {{ Form::text('limit', isset($cms->limit) ? $cms->limit : '', ['class' => 'form-control']) }}
      @if ($errors->has('limit'))
        {{ $errors->first('limit') }}
      @endif
    </div>
  </div>

  <div class="col-sm-12" id="search-button">
    <div class="form-group pull-right">
      <button class="btn btn-block btn-primary"> Search</button>
    </div>
  </div>

</form>
<script type="application/javascript">

  $(function () {
    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });

    $('#month-year').datepicker({
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months"
    });
  });
</script>