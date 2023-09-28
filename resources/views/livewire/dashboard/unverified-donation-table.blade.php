

<div class="row">
    <div class="col s12">
      <div id="button-trigger2" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Unverified Donations</h4>
          <div class="row">
            <div class="col s12">


          <form id="verifyDonation1" method="POST" action="{{ route('verify.donation') }}">
          @csrf
              <table id="multi-select" class="display" style="height: 50px;">
                <thead>
                  <tr>
                     @role('admin')
                     @if (count($unverifiedDonations))
                    <th>
                      <label>
                        <input onchange="toggleCheckboxes(this)" id="headerCheckbox" type="checkbox" class="select-all"/>
                        <span></span>
                      </label>
                    </th>
                    @else
                    <th>
                      <label>
                        <input id="headerCheckbox" type="checkbox" class="select-all" disabled />
                        <span></span>
                      </label>
                    </th>
                    @endif

                      @endrole
                    <th>Record ID</th>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Date</th>
                     @role('admin')
                    <th>Recorder</th>
                      @endrole
                    <th>Amount (&#8358;)</th>
                  </tr>
                </thead>
                <tbody>

        @role('admin')
         
          @foreach ($unverifiedDonations as $unverifiedDonation)

                  <tr>
                    <td>
                      <label>
                        <input type="checkbox" name="verification[]" value="{{ $unverifiedDonation->id }}" class="data-checkbox" />
                        <span></span>
                      </label>
                    </td>
                    <td>INS00010323</td>
                    <td>{{ $unverifiedDonation->name }}</td>
                    <td>{{ $unverifiedDonation->purpose }}</td>
                    <td>{{ formatDate($unverifiedDonation->updated_at) }}</td>
                    <td>Recorder Name</td>
                    <td>{{ number_format($unverifiedDonation->amount, 2, '.', ',') }}</td>
                  </tr>
          @endforeach

        @endrole

        @role('recorder')         
          @foreach ($recordersUnverifiedDonations as $unverifiedDonation)

                  <tr>
                    <td>INS00010323</td>
                    <td>{{ $unverifiedDonation->name }}</td>
                    <td>{{ $unverifiedDonation->purpose }}</td>
                    <td>{{ $unverifiedDonation->updated_at }}</td>
                    <td>{{ number_format($unverifiedDonation->amount, 2, '.', ',') }}</td>
                  </tr>
          @endforeach
        @endrole
        

        
              </table>
              <div class="row">
              @role('admin')
                <button id="submitBtn2" href="#verify-donation-modal" disabled class="btn mt-1 ml-1 modal-trigger">Verify<i class="material-icons left">check_circle</i> </button>
                <span class="mt-2 mr-4 right">Total&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: 800;">&#8358;&nbsp;&nbsp;{{ sumUnverifiedDonations() }}</span></span>
              @endrole

              @role('recorder')
                <span class="mt-2 mr-4 right">Total&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: 800;">&#8358;&nbsp;&nbsp;{{ sumUnverifiedDonationsForRecorder() }}</span></span>
              @endrole
              </div>
<!-- Modal Structure -->

    <div id="verify-donation-modal" class="modal border-radius-10" style="padding:2em;">
        <div class="modal-content">
          <h6 class="card-title">You are about to verify <span id="checkbox-count">0</span></h6>

        <p>Do you want to proceed with the verification?</p>
        </div>

      <div class="progress collection">
        <div id="preloader3" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

        <div class="modal-footer">
          <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Yes, Verify</button>
          <a id="reload2" href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
    </div>

          </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
