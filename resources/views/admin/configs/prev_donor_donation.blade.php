 @extends('admin.admin_master')
 @section('admin')

 <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
          <div class="container">
            <!-- app invoice View Page -->
<section class="invoice-view-wrapper section">
  <div class="row">
    <!-- invoice view page -->
    <div class="col xl9 m8 s12">
      <div class="card">
        <div class="card-content invoice-print-area">
          <!-- header section -->
          <div class="row invoice-date-number">
            <!-- <div class="col xl4 s12">
              <span class="invoice-number mr-1">Print#</span>
              <span>000756</span>
            </div> -->
            <div class="col xl8 s12">
              <div class="invoice-date display-flex align-items-center flex-wrap">
                <div class="mr-3">
                  <small>Print Date:</small>
                  <span id="current-time"></span>
                </div>
              </div>
            </div>
          </div>
          <!-- logo and title -->
          <div class="row mt-3 invoice-logo-title d-flex">
            <div class="col-md-6 col-12">
                <img class="ml-5" src="{{ asset('backend/assets/images/logo/recordia_bg_logo.png') }}" alt="logo" height="50" width="50">
            </div>
            <div class="col-md-6 col-12">
                </div>
          </div>
          
          <div class="divider mb-3 mt-3"></div>
          <!-- invoice address and contact -->
          <div class="row invoice-info">
              <!-- <h4 class="indigo-text center"></h4>  -->
      <h6 class="card-title center">All donations made by {{ $donor->title }} {{ $donor->name }} for the year {{ getCurrentYear() }}</h6>           
          </div>
          <div class="divider mb-3 mt-3"></div>
          <!-- product details table-->
          <div class="invoice-product-details">
            <table class="striped responsive-table" >
              <thead>
                <tr>
                    <th>Purpose</th>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Status</th>
                    <th>Verification</th>
                    <th>Amount(&#8358;)</th>
                </tr>
              </thead>
              <tbody>

              @foreach($donorDonations as $donorDonation)

                <tr>

                <td>{{ $donorDonation->purpose }}</td>

                <td>{{ formatDate($donorDonation->updated_at) }}</td>

                <td>{{ $donorDonation->event->name }}</td>

                    @if($donorDonation->payment_status == 1)
                      <td>paid</td>
                    @else
                      <td>unpaid</td>
                    @endif

                    @if($donorDonation->verification == 1)
                      <td>verified</td>
                    @else
                      <td>unverified</td>
                    @endif

                <td>{{ formatAmount($donorDonation->amount) }}</td>

                </tr>

              @endforeach

              </tbody>
            </table>
          </div>
          <!-- invoice subtotal -->
          <div class="divider mt-3 mb-3"></div>
          <div class="invoice-subtotal">
            <div class="row">
              <div class="col m5 s12">
              <span>Print from recordia app</span>
              </div>
              <div class="col xl4 m7 s12 offset-xl3">
                <ul>
                  <li class="display-flex justify-content-between">
                    <span class="invoice-subtotal-title mt-3">Paid</span>
                    <h6 class="invoice-subtotal-value">&#8358; {{$paidDonorDonations}}</h6>
                  </li>
                  <li class="display-flex justify-content-between">
                    <span class="invoice-subtotal-title mt-3">Outstanding</span>
                    <h6 class="invoice-subtotal-value">&#8358; {{$unpaidDonorDonations}}</h6>
                  </li>
                  <hr>
                  <li class="display-flex justify-content-between">
                    <span class="invoice-subtotal-title mt-3">Total Donation</span>
                    <h6 class="invoice-subtotal-value">&#8358; {{ $sumDonorDonations }}</h6>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- invoice action  -->
    <div class="col xl3 m4 s12">
      <div class="card invoice-action-wrapper">
        <div class="card-content">
          <div class="invoice-action-btn">
            <a href="#"
              class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
              <i class="material-icons mr-4">check</i>
              <span class="text-nowrap">Send List</span>
            </a>
          </div>
          <div class="invoice-action-btn">
            <a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
              <span>Print</span>
            </a>
          </div>
          <div class="invoice-action-btn">
            <a href="{{ route('donor.donation', $donor->id) }}" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">
              <span class="text-nowrap">All Records</span>
            </a>
          </div>


        </div>
      </div>

    <a href="{{ route('donor.donation', $donor->id) }}" class="right ml-2" style="display: flex; align-items: center; "><i class="small-ico-bg material-icons blue-text mb-0">arrow_back</i><span class="chip mr-0" style="margin-top: 5px;">Back to Donor's Donations</span></a>
    </div>
  </div>
</section>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
  <script>
    var now = new Date();

    // Format the date and time string
    var dateTimeString = now.toLocaleString();
    document.getElementById("current-time").innerHTML = dateTimeString;
  </script>

  @endsection