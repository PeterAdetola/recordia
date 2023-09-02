 @extends('admin.admin_master')
 @section('admin')
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Hi, John Doe</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="#!">Here is the financial overview/activities for the year 2023</a>
                  </li>
                </ol>
              </div>

            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
    <div class="section">
      <!-- Add Financial Overview Here -->
    @include('admin.dashboard.financial-overview')
    </div>

<div class="divider"></div>

    <div class="row">
      <a class="modal-trigger" href="#add-donation-modal">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons green-text small-ico-bg mb-5">add_circle</i>
            <p class="green-text  mt-3">Add Donation</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-donation-form')

      <a href="#!">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons blue-text small-ico-bg mb-5">person_add</i>
            <p class="blue-text  mt-3">Register Donor</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->

      <a class="modal-trigger" href="#add-expense-modal">
      <div class="col s12 m6 l4 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <i class="material-icons red-text small-ico-bg mb-5">add_circle</i>
            <p class="red-text  mt-3">Add Expense</p>
          </div>
        </div>
      </div>
    </a>

    <!-- Add Modal Here -->
    @include('admin.dashboard.modals.add-expense-form')

      
    </div>

    <!-- Table Starts Here -->

  <section id="unverified" class="users-list-wrapper section">
   <div class="users-list-table">
    <div class="card pt-1">
      <div class="card-content">
      <h4 class="card-title center chip">Unverified Donations</h4>
      <div class="divider"></div>
        <!-- datatable start -->
        <div class="responsive-table mt-5">
          <table id="users-list-datatable" class="table" style="white-space: nowrap;">
            <thead>
              <tr>
                <th></th>
                <th>Record ID</th>
                <th>Fullname</th>
                <th>Amount (&#8358;)</th>
                <th>Purpose</th>
                <th>Mode</th>
                <th>Date</th>
                <th>Phone No.</th>
                <th>Verify</th>
                <th>Transaction</th>
              </tr>
            </thead>
            <tbody>

<!-- Codes -->

              <tr>
                <td></td>
                <td>PAC0001032023</td>
                <td>
                  Dr. John Alfred
                </td>
                <td>5,000,000.00</td>
                <td>Charity Foundation</td>
                <td>
                  <span class="chip lighten-5 green green-text">
                    Transfer
                  </span>
                </td>
                <td>02/11/2023</td>
                <td><a href="page-users-view.html">08059616260</a>
                </td>
                <td><a href="#!" class="sidenav-trigger"  data-target="#!"><i class="material-icons green-text small-ico-bg">check_box_outline_blank</i></a>
                </td><td>
              <i class="material-icons green-text">arrow_drop_up</i>                  
                </td>
              </tr>


  <div class="slide-out-right-sidenav sidenav rightside-navigation" id="PAC0001032023">

    <div class="col s12">
      <div id="placeholder" class="">
        <div class="card-content">
        <form  method="POST" id="update" action="">
                  @csrf
            <input type="hidden" name="id" value="">
            <input type="hidden" name="transaction" value="">
            <div class="row">
      <h4 style="padding-bottom: 2px" class="card-title center chip"></h4>
      <div class="divider"></div>
            </div>
      <div class="collection">
            <div class="collection-item">
              Phone Number:<b>08059616260</b>
            </div>
            <div class="collection-item">
              Amount paid: <b>5,000,000.00</b>
            </div>
            <div class="collection-item">
              For: <b>Charity</b>
            </div>

        </div>
            <div class="row">
                <div class="collection" style="padding: 1em;">
                    <p>
                      <label>
                        <input name="verified" type="checkbox" value="1"  />
                        <span>Check to Verify</span>
                      </label>
                    </p>
                </div>
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn-large waves-effect waves-light right" type="submit">Verify Payment
                    <i class="material-icons right">check</i>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>        
</div>

            </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Unverified Donation Total</th>
                  <th colspan="5">&#8358; 6,000,000.00 
                    <span class="light" style="opacity:0.5"> | Unverified donations</span>
                  </th> 
                  <!-- <th></th> -->
                  <!-- <th></th> -->
                  <!-- <th></th> -->
                  <!-- <th></th> -->
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>


          </div>
          <!-- <div class="content-overlay"></div> -->
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
  @endsection