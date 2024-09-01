
<!-- START RIGHT SIDEBAR NAV -->

<aside id="right-sidebar-nav">
  <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
    <div class="row">
      <div class="slide-out-right-title">
        <div class="col s12 border-bottom-1 pb-0 pt-1">
          <div class="row">
            <div class="col s2 pr-0 center">
              <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
            </div>
            <div class="col s10 pl-0">
              <ul class="tabs">
                <li class="tab col s6 p-0">
                  <a href="#activity">
                    <span>Activity Log</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="slide-out-right-body row pl-3">
        <div id="activity" class="col s12">
          <div class="activity">
            <p class="mt-5 mb-0 ml-5 font-weight-900">EVENT LOGS</p>
            <ul class="widget-timeline mb-0">
              @php
              $activityDetails = logActivity();
              @endphp
              @if(count($activityDetails) > 0)
              @foreach ($activityDetails as $details)
<?php
             if ($details['paymentMode'] === 'by cash' || $details['paymentMode'] === 'by POS') {
                    $icon = 'timeline-icon-green';
                } elseif ($details['paymentMode'] === 'through bank transfer') {
                    $icon = 'timeline-icon-orange';
                } else {
                    $icon = 'timeline-icon-red';
                }
?>

                <li class="timeline-items active  {{$icon}}">
                <div class="timeline-content {{ $details['paymentStatus'] == 'donation'? 'green-text' : 'red-text'  }}">{{ $details['paymentStatus'] == 'donation'? 'Donation' : 'Pledge'  }}</div>
                <div class="timeline-time">{{ $details['actTime'] }}</div>
                <h6 class="timeline-title" style="margin-bottom: 0.5em">{{ ucfirst($details['paymentStatus']) }} record created by {{ $details['userName'] }}.</h6>
                <p class="timeline-text" style="line-height: 1.1em">{{ $details['userName'] }} recorded a {{ $details['amount'] }} donation made by {{ $details['donorName'] }} {{ $details['paymentMode'] }}.</p>
              </li>

              @endforeach
              @else

              <li class="timeline-items timeline-icon-green active">
                <div class="timeline-time">Now</div>
                <h6 class="timeline-title">No record</h6>
                <p class="timeline-text">No logged action for the moment</p>
                <div class="timeline-content orange-text">Log Empty</div>
              </li>
              @endif
            </ul><br><br><br>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</aside>
<!-- END RIGHT SIDEBAR NAV -->