<div class="row">
  <div class="col-sm-10 col-sm-offset-1">
    <table class="table table-responsive table-bordered" id="results-list">
      <thead>
      <tr>
        <th>Physician</th>
        <th>Hospital</th>
        <th>Amount</th>
      </tr>
      </thead>
      <tbody>
      @if (!empty($records))

        @foreach($records as $record)
          <tr>
            <td>{{ Cms::physName($record['cms_phy_first_name'], $record['cms_phy_last_name'], $record['cms_phy_suffix_name']) }}</td>
            <td>{{ $record['cms_hospital_name'] }}</td>
            <td>{{ $record['cms_amount'] }}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
</div>