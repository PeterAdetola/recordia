@php
$sumOfAllExpenses = sumOfAllExpenses();
@endphp
      <div class="card">
          <div class="card-content">
                
            <div class="row" id="gradient-Analytics">
              <div class="col s12 m6 card-width">
                <div class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-5">
                  <div class="col s7 m7">
                    <i class="material-icons background-round mt-5 mb-5">layers</i>
                    <p class="no-margin">Total Donations</p>
                  </div>
                  <div class="col s5 m5 right-align mt-5">
                    <h5 class="mb-0 white-text" style="margin-left: -2.5em">&#8358;&nbsp;
                        {{ getTotalPaidDonation() }}
                    {{--@role('admin'){{ getTotalPaidDonation() }}@endrole--}}
                    {{--@role('recorder'){{ sumAllInstantDonationsFR() }}@endrole--}}
                  </h5>
                    <p>Cash & Transfer</p>
                  </div>
                </div>
              </div>
            {{--@role('admin')--}}
              <div class="col s12 m6 card-width">
                <div class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-5">
                  <div class="col s7 m7">
                    <i class="material-icons background-round mt-5 mb-5">done_all</i>          
                    <p>Available Fund</p>
                  </div>
                  <div class="col s5 m5 right-align mt-5">
                    <h5 class="mb-0 white-text" style="margin-left: -2.5em">&#8358;&nbsp;
                    {{ sumAvailableFund() }}
                    </h5>
                    <p class="no-margin">Verified & Available</p>
                  </div>
                </div>
              </div>
            {{--@endrole--}}
              <div class="col s12 m6 card-width">
                <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
                  <div class="col s7 m7">
                    <i class="material-icons background-round mt-5 mb-5">layers_clear</i>
                    <p>Pledges</p>
                  </div>
                  <div class="col s5 m5 right-align mt-5">
                    <h5 class="mb-0 white-text" style="margin-left: -2.5em">&#8358;&nbsp;
                        {{ sumAllPledges() }}
                      {{--@role('admin'){{ sumAllPledges() }}@endrole--}}
                      {{--@role('recorder'){{ sumAllInstantPledgesFR() }}@endrole--}}
                    </h5>
                    <p class="no-margin">Unpaid Donations</p>
                  </div>
                </div>
              </div>
            {{--@role('admin')--}}
              <div class="col s12 m6 card-width">
                <div class="card row gradient-45deg-purple-deep-orange gradient-shadow white-text padding-4 mt-5">
                  <div class="col s7 m7">
                    <i class="material-icons background-round mt-5 mb-5">insert_chart</i>
                    <p>Expected Total</p>
                  </div>
                  <div class="col s5 m5 right-align mt-5">
                    <h5 class="mb-0 white-text" style="margin-left: -2.5em">&#8358;&nbsp;
                        {{ sumAllDonationsWithPledges() }}
                    {{--@role('admin'){{ sumAllDonationsWithPledges() }}@endrole--}}
                    {{--@role('recorder'){{ sumAllInstantDonationsWithPledgesFR() }}@endrole--}}
                  </h5>
                    <p class="no-margin">Paid & Unpaid</p>
                  </div>
                </div>
              </div>
            {{--@endrole--}}
            </div>
            </div>
    </div>