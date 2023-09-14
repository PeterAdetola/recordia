 @extends('admin.admin_master')
 @section('admin')
@php
$pageTitle = 'Unpaid Donations for the year '. getCurrentYear();

@endphp
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
            <div class="col xl4 s12">
              <span class="invoice-number mr-1">Print#</span>
              <span>000756</span>
            </div>
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
          <div class="row mt-3 invoice-logo-title">
            <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
              <img src="{{ asset('backend/assets/images/logo/recordia_bg_logow.png') }}" alt="logo" height="46" width="200">
            </div>
          </div>
          
          <div class="divider mb-3 mt-3"></div>
          <!-- invoice address and contact -->
          <div class="row invoice-info">
              <!-- <h4 class="indigo-text center"></h4>  -->
      <h6 class="card-title center">{{ $pageTitle }}</h6>           
          </div>
          <div class="divider mb-3 mt-3"></div>
          <!-- product details table-->
          <div class="invoice-product-details">
            <table class="striped responsive-table" >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Purpose</th>
                  <th>Date</th>
                  <th>Phone No.</th>
                  <th>Amount (&#8358;)</th>
                </tr>
              </thead>
              <tbody>


              @foreach($unpaidDonations as $unpaidDonation)

                <tr class="{{ ($unpaidDonation->transaction == 1 )? 'grey lighten-5' : '' }}">
                <td>
                  {{ $unpaidDonation->name }}
                </td>
                <td>{{ $unpaidDonation->purpose }}</td>
                <td>{{ formatDate($unpaidDonation->updated_at) }}</td>
                <td>{{ $unpaidDonation->phone }}</td>
                <td>{{ formatAmount($unpaidDonation->amount) }}</td>
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
                    <h6 class="invoice-subtotal-title" style="display:inline-block;">Total</h6>
                    <h6 class="invoice-subtotal-value">&#8358;{{sumAllInstantPledges()}}</h6>
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
            <a href="{{ route('get.instant.records') }}" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">
              <span class="text-nowrap">All Records</span>
            </a>
          </div>
        </div>
      </div>
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