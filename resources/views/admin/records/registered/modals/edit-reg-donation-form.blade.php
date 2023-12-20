
        <!-- Transaction info -->
<div id="{{ $registeredRecord->id }}" class="modal" style="padding:1em;">
    <div class="modal-content">
      <div class="row">
        <h6 class="card-title left ml-2">Edit Record</h6>
        <!-- <span class="grey-text right mr-3 pt-1">Recorded by {{-- $registeredRecord['recorder']['name'] --}}</span> -->
        <div class="new badge grey-text right mr-2" 
        style="
        padding:0.2em 0.5em; 
        background-color: #ebebeb; 
        border: solid silver 1px;
        border-radius: 5px
        ">
        FOD
          {{ makeIdNumber($sn, 4) }}
          {{$registeredRecord->id}}{{$registeredRecord['donor']['id']}}{{$registeredRecord->event_id}}{{$registeredRecord['recorder']['id']}}
          {{ makeIdNumber(substr(getCurrentYear(), -2), 2) }}
        </div>
      </div>


      <div class="progress collection">
        <div id="preloader{{$registeredRecord->id}}" class="indeterminate"  style="display:none;
        border:2px #ebebeb solid"></div>
      </div>

      <div class="row ml-1 mb-2">{{ $registeredRecord['donor']['title']  }} {{ $registeredRecord['donor']['name']  }}'s donation during the {{ $registeredRecord['event']['name']  }}</div>
      <form id="donationForm" method="POST" action="{{ route('update.donation') }}">
        @csrf
      <input type="hidden" name="id" value="{{ $registeredRecord->id }}">

        <div class="row">
          <div class="input-field col m6 s12">
            <input name="amount" id="amount" value="{{ $registeredRecord->amount }}" type="text" required>
                    <label for="amount"> 
                      @if ($registeredRecord->payment_status == 1)
                            paid (&#8358;)
                      @elseif ($registeredRecord->payment_status == 0)
                            pledged (&#8358;)
                      @endif                      
                    </label>
          </div>

          <div class="input-field col m6 s12">
            <input name="purpose" id="purpose" value="{{ $registeredRecord->purpose }}" type="text" class="autocomplete" required>
            <label for="purpose">for</label>
          </div>
        </div>


        <div class="divider mb-3"></div>

              <div class="row">
                  <div class="col s12 m6">
                   <div class="switch">
                      <label>
                        <input id="payment" name="payment_status" value="1" type="checkbox" {{ ($registeredRecord->payment_status == 1)? 'checked' : '' }} >
                        <span class="lever"></span>
                        <span style="font-size:1.1em;"><b style="font-size:1.1em;">{{ ($registeredRecord->payment_status == 1)? 'Paid' : 'Pledged (check when paid)' }}</b></span>
                      </label>
                    </div>
                      <div class="ml-7 mt-4">
                        @php
                        if($registeredRecord->payment_status == 0) { 
                          $registeredRecord->verification = 0;
                        }
                        @endphp
                        <label>
                          <input id="verification" name="verification" type="checkbox" class="filled-in" value="1" {{ ($registeredRecord->verification == 1)? 'checked' : '' }} {{ ($registeredRecord->verification == 1)? 'disabled' : '' }} />
                          <span>{{ ($registeredRecord->verification == 1)? 'Verified' : 'Not verified yet' }}</span>
                        </label>
                      </div>
                  </div>

                  <div class="input-field col s12 m6" style="margin-top: 1px;">
                    <button id="submitBtn{{$registeredRecord->id}}" class="btn-large waves-effect waves-light right" type="submit"  onclick="ShowPreloader{{$registeredRecord->id}}()">Update
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>

      </form>
  </div>
</div>

<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$registeredRecord->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$registeredRecord->id}}");
  preloader.style.display = "block";
});
</script>