@php
  $allRecords = getAllRecords();
@endphp
  <!-- DataTables Row grouping -->
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Recent Records</h4>
          <div class="row">
            <div class="col s12">
              <p>The data in this table contains the records of donations, pledges and expenses recorded so far, for instant and registered donors.</p>
            </div>
            <div class="col s12">
              <!-- <table id="data-table-row-grouping" class="display"> -->
                <div class="divider mt-1"></div>
              <table id="multi-select" class="display">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Recorder</th>
                    <th>Payment Mode</th>
                    <th>Date</th>
                  </tr>
                </thead>

                <tbody>

                @foreach ($allRecords as $allRecord)

                  <tr>

                    <td>{{ $allRecord->name }}</td>

                    <td>{{ ($allRecord->phone == '')? 'Not Available' : $allRecord->phone }}</td>

                    <td>{{ $allRecord->purpose }}</td>

                    <td>{{ formatAmount($allRecord->amount) }}</td>                   
                  


                    @if($allRecord->payment_status == 1)
                    <td><span class="chip green-text">paid</span></td>
                    @elseif($allRecord->payment_status == 2)
                    <td><span class="chip red white-text">expense</span></td>
                    @else
                    <td><span class="chip red-text">unpaid</span></td>
                    @endif

                    @if($allRecord->verification == 1)
                      <td><i class="material-icons green-text">check_box</i></td>
                    @else
                      <td><i class="material-icons grey-text">indeterminate_check_box</i></td>
                    @endif
                    
                    <td>{{ $allRecord['recorder']['name'] }}</td>

                  
                    @if($allRecord->payment_mode == 1)
                    <td><span class="chip green lighten-4 grey-text">cash</span></td>
                    @elseif($allRecord->payment_mode == 2)
                    <td><span class="chip indigo lighten-4 grey-text">pos</span></td>
                    @elseif($allRecord->payment_mode == 3)
                    <td><span class="chip orange lighten-4 grey-text">transfer</span></td>
                    @elseif($allRecord->payment_mode == 4)
                    <td><span class="chip deep-orange white-text">pledge</span></td>
                    @else
                    <td><span class="chip red-text">expense</span></td>
                    @endif

                    <td>{{ formatDate($allRecord->updated_at) }}</td>

                  </tr>

        <!-- Table Modal here -->

    {{-- @include('admin.records.instant.modals.edit-ins-transaction-form') --}}

        <!-- /Donation info ends -->
                @endforeach
                </tbody>

                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Recorder</th>
                    <th>Payment Mode</th>
                    <th>Date</th>
                  </tr>
                </tfoot>
              </table>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>