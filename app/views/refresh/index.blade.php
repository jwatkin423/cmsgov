@extends('layouts.main')

@section('body')
  <div class="row">
    <div class="col-sm-8">
      <table class="table table-bordered">
        <tr>
          <th>Save count:</th>
          <td>{{ $save_count }}</td>
          <th>Update count:</th>
          <td>{{ $update_count }}</td>
          <th>Total count:</th>
          <td>{{ $total_count }}</td>
        </tr>
      </table>
    </div>
  </div>
@stop()