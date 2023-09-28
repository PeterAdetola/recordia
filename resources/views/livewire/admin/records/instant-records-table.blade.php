<div>
              <table wire:ignore id="data-table-row-grouping" class="display">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Transaction</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Edit</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($instantRecords as $instantRecord)  
                  <tr wire:key="{{ $instantRecord->id }}" style="{{ ($instantRecord->transaction == 0)? 'color:maroon':'' }}">
                    <td>{{ $instantRecord->name }}</td>
                    <td  style="width: 10em;">{{ $instantRecord->purpose }}</td>
                    <td>{{ formatAmount($instantRecord->amount) }}</td>

                    @if($instantRecord->transaction == 1)
                    <td><span class="green-text">Cr</span></td>
                    @else
                    <td><span class="red-text">Dr</span></td>
                    @endif

                    @if($instantRecord->payment_status == 1)
                    <td><span class="chip green-text">Paid</span></td>
                    @elseif($instantRecord->transaction == 0)
                    <td><span class="chip red-text">Paid</span></td>
                    @else
                    <td><span class="chip red-text">Unpaid</span></td>
                    @endif

                    @if($instantRecord->verification == 1)
                      <td><i class="material-icons green-text">check_box</i></td>
                    @else
                      <td><i class="material-icons grey-text">indeterminate_check_box</i></td>
                    @endif

                    <td>{{ $instantRecord->phone }}</td>
                    <td>{{ formatDate($instantRecord->updated_at) }}</td>
                    <td><a class="modal-trigger" href="#{{ $instantRecord->id }}" ><i class="material-icons red-text small-ico-bg">edit</i></a></td>
                  </tr>

        <!-- Table Modal here -->

    @include('admin.records.modals.edit-transaction-form') 

        <!-- /Donation info ends -->
                @endforeach
                </tbody>

                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Transaction</th>
                    <th>Payment Status</th>
                    <th>Verification</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Edit</th>
                  </tr>
                </tfoot>
              </table>

</div>

@push('scripts')
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>
  @endsection
  <script type="text/javascript">
         @if(Session::has('message'))

        setTimeout(function () {
          var toastHTML = "<i class='material-icons' style='color:#616161'>radio_button_checked</i>&nbsp;{{ Session::get('message') }}";
          M.toast({html: toastHTML})
        }, 500);

       @endif 
  </script>
@endpush