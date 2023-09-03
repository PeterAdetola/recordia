<!-- Table Starts Here -->

  <section id="unverified" class="users-list-wrapper section">
   <div class="users-list-table">
    <div class="card pt-1">
      <div class="card-content">
      <h4 class="card-title">Unverified Donations</h4>
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
                  <th colspan="3"><a class="btn box-shadow-none border-round mb-1 btn waves-effect waves-light mr-1">
                    <i class="material-icons">check</i>
                  </a> </th>
                  <!-- <th></th> -->
                  <!-- <th></th> -->
                </tr>
              </tfoot>
          </table>
        </div>
        <!-- datatable ends -->
