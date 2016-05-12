<div class="row">
  <div class="col-sm-10 col-sm-offset-1">
    <table class="table table-responsive">
      <thead>
      <tr>
        <td colspan="4">
          <h3>
            Dr. {{ Cms::physName($record['cms_phy_first_name'], $record['cms_phy_last_name'], $record['cms_phy_suffix_name']) }}</h3>
        </td>
      </tr>
      </thead>
      <tr>
        <th>Publication Year</th>
        <td>{{ $record['cms_year'] }}</td>
        <th>Payment Date</th>
        <td>{{ $record['cms_payment_date'] }}</td>
      </tr>
      <tr>
        <th colspan="2">Amount:</th>
        <td colspan="2">{{ $record['cms_amount'] }}</td>
      </tr>
      @if ($record['cms_hospital_name'] != null)
        <tr>
          <th colspan="2">Hospital Name</th>
          <td colspan="2">{{ $record['cms_hospital_name'] }}</td>
        </tr>
      @endif
      @if ($record['cms_phy_profile_id'] != null)
        <tr>
          <th colspan="2">Physician Profile</th>
          <td colspan="2">{{ $record['cms_phy_profile_id'] }}</td>
        </tr>
      @endif
      <tr>
        <th colspan="2">Physician Address</th>
        <td colspan="2">{{ $record['cms_phy_address'] }}</td>
      </tr>
      @if ($record['cms_phy_address_two'] != null)
        <tr>
          <th colspan="2">Physician Address Two</th>
          <td colspan="2">{{ $record['cms_phy_address_two'] }}</td>
        </tr>
      @endif
      <tr>
        <th colspan="2">Physician City</th>
        <td colspan="2">{{ $record['cms_phy_city'] }}</td>
      </tr>
      <tr>
        <th colspan="2">Physician State</th>
        <td colspan="2">{{ $record['cms_phy_state'] }}</td>
      </tr>
      <tr>
        <th colspan="2">Physician Zip code</th>
        <td colspan="2">{{ $record['cms_phy_zipcode'] }}</td>
      </tr>
      <tr>
        <th colspan="2">Physician Country</th>
        <td colspan="2">{{ $record['cms_phy_country'] }}</td>
      </tr>
    </table>
  </div>
</div>
