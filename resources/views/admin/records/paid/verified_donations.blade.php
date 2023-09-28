@extends('admin.admin_master')
 @section('admin')
  @section('vendor_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/data-tables/css/select.dataTables.min.css') }}">
  @endsection
  @section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/pages/data-tables.css') }}">
    @include('admin.records.modal_style')

  @endsection

@php
$pageTitle = 'Verified Donations';
@endphp


    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $pageTitle }} for the year {{getCurrentYear()}}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a  href="{{ route('dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">{{ $pageTitle }}
                  </li>
                </ol>
              </div>
              <div class="col s2 m6 l6"><a class=" mb-2 btn-floating btn-large waves-effect waves-light breadcrumbs-btn right" href="{{  route('instant.prev_verified.donations')}}" ><i class="material-icons hide-on-med-and-up">print</i><i class="material-icons right">print</i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <div class="section section-data-tables">
              
              <!-- Content Here -->

  <!-- DataTables Row grouping -->
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Verified Donations</h4>
          <div class="row">
            <div class="col s12">
              <p>The data in this table contains the records of confirmed donations, not for registered donors.</p>
            </div>
            <div class="col s12">
              <table id="data-table-row-grouping" class="display">
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
                    <th>edit</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($verifiedDonations as $verifiedDonation)  
                  <tr>
                    <td>{{ $verifiedDonation->name }}</td>
                    <td  style="width: 10em;">{{ $verifiedDonation->purpose }}</td>
                    <td>{{ formatAmount($verifiedDonation->amount) }}</td>

                    @if($verifiedDonation->transaction == 1)
                    <td><span class="green-text">Cr</span></td>
                    @else
                    <td><span class="red-text">Dr</span></td>
                    @endif

                    @if($verifiedDonation->payment_status == 1)
                    <td><span class="chip green-text">Paid</span></td>
                    @elseif($verifiedDonation->payment_status == 0 && $verifiedDonation->transaction == 0)
                    <td><span class="chip red-text">Paid</span></td>
                    @else
                    <td><span class="chip red-text">Unpaid</span></td>
                    @endif

                    @if($verifiedDonation->verification == 1)
                      <td><i class="material-icons green-text">check_box</i></td>
                    @else
                      <td><i class="material-icons grey-text">indeterminate_check_box</i></td>
                    @endif

                    <td>{{ $verifiedDonation->phone }}</td>
                    <td>{{ formatDate($verifiedDonation->updated_at) }}</td>
                    <td>
                      <a class="modal-trigger" href="#{{ $verifiedDonation->id }}" ><i class="material-icons red-text small-ico-bg">edit</i></a>
                    </td>
                  </tr>


<!-- Modal Structure -->

    
        <!-- Table Modal here -->

    @include('admin.records.paid.edit-verified-donation-form') 

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
                    <th>Redeem</th>
                  </tr>
                </tfoot>
              </table>
              <div class="divider"></div>
              <div class="row">
                <div class="mt-2 mr-4 center">Total&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight: 800;">&#8358;&nbsp;&nbsp;{{ sumVerifiedDonations() }}</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

              <!-- Content ends Here -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
  @section('vendor_scripts')
    <script src="{{ asset('backend/assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
  @endsection
@section('scripts')
  <!-- <script src="{{ asset('backend/assets/js/plugins.js') }}"></script> -->
  <script src="{{ asset('backend/assets/js/scripts/data-tables.js') }}"></script>


@endsection