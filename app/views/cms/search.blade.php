@extends('layouts.main')

@section('body')

  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
          @include('cms.searchform')
    </div>
  </div>

  <hr class="soften">

  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      @include('cms.export')
    </div>
  </div>

  @include('cms.results')


@stop

