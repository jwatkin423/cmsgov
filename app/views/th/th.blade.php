@extends('layouts.main')

@section('body')
  <div class="row">
    <div class="typehead-search">
      <div class="col-sm-8 col-centered has-success">
        <form id="form-user_v1" name="form-user_v1" action="{{ URL::route('singleDisplay') }}" method="get"
              data-url="{{ URL::route('typeahead-search') }}">
          <div class="typeahead__container">
            <div class="typeahead__field">

            <span class="typeahead__query">
                <input class="th-doctor" name="criteria" type="search" placeholder="Search" autocomplete="off">
            </span>
            <span class="typeahead__button">
                <button type="submit">
                  <i class="typeahead__search-icon"></i>
                </button>
            </span>

            </div>
          </div>
          <input type="hidden" name="id" id="th-id">
        </form>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
  </div><!-- /.row -->
@stop