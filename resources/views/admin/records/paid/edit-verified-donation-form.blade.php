
        <!-- Transaction info -->
<div id="{{ $verifiedDonation->id }}" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Edit Verified Donation recorded by {{ $verifiedDonation['recorder']['name'] }}</h6>

      <div class="progress collection">
        <div id="preloader{{$verifiedDonation->id}}" class="indeterminate"  style="display:none;
        border:2px #ebebeb solid"></div>
      </div>
      
      <form id="donationForm" method="POST" action="{{ route('update.transaction') }}">
        @csrf
      <input type="hidden" name="id" value="{{ $verifiedDonation->id }}">
      <input type="hidden" name="transaction" value="{{ ($verifiedDonation->transaction == 1)? 1 : 0 }}">

      <div class="row">

        <div class="input-field col m6 s12">
          <input name="name" id="fullname" value="{{ $verifiedDonation->name }}" type="text" required/>
          <label for="fullname">Name</label>
        </div> 

        <div class="input-field col m6 s12">
          <input name="phone" id="phone" value="{{ $verifiedDonation->phone }}" type="text" placeholder= "{{($verifiedDonation->phone == '')? 'Not Available':''}}">
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>

      </div>
      <div class="row">

        <div class="input-field col m6 s12">
          <input name="amount" id="amount" value="{{ $verifiedDonation->amount }}" type="text" required>
                  <label for="amount">Amount 

          @if ($verifiedDonation->transaction == 1 && $verifiedDonation->payment_status == 1)
                paid in (&#8358;)
          @elseif ($verifiedDonation->transaction == 1 && $verifiedDonation->payment_status == 0)
                pledged in (&#8358;)
          @elseif ($verifiedDonation->transaction == 0 && $verifiedDonation->payment_status == 0)
                given in (&#8358;)
          @endif
                    
                  </label>
        </div>

        <div class="input-field col m6 s12">
          <input name="purpose" id="purpose" value="{{ $verifiedDonation->purpose }}" type="text" class="autocomplete" required>
          <label for="purpose">for</label>
        </div>


              <div class="row">
                @if($verifiedDonation->transaction == 1)
                  <div class="col s12 m6" style="padding:1em">
                   <div class="switch mt-5">
                      <label>
                        <input id="payment" name="payment_status" value="1" type="checkbox" {{ ($verifiedDonation->payment_status == 1)? 'checked' : '' }} >
                        <span class="lever"></span>
                        <span style="font-size:1.1em;"><b style="font-size:1.1em;">{{ ($verifiedDonation->payment_status == 1)? 'Paid' : 'Pledged (check when paid)' }}</b></span>
                      </label>
                    </div>
                      <div class="ml-7 mt-4">
                        @php
                        if($verifiedDonation->payment_status == 0) { 
                          $verifiedDonation->verification = 0;
                        }
                        @endphp
                        <label>
                          <input id="verification" name="verification" type="checkbox" class="filled-in" value="1" {{ ($verifiedDonation->verification == 1)? 'checked' : '' }} />
                          <span>{{ ($verifiedDonation->verification == 1)? 'Verified' : 'Not Verified' }}</span>
                        </label>
                      </div>
                  </div>
                  @endif

                  <div class="input-field mt-8 col s12 m6">
                    <button id="submitBtn{{$verifiedDonation->id}}" class="btn-large waves-effect waves-light {{ ($verifiedDonation->transaction == 1)? 'right' : 'center' }}" type="submit"  onclick="ShowPreloader{{$verifiedDonation->id}}()">Update
                      <i class="material-icons right">send</i>
                    </button>
                  </div>

      </div>

      </form>
  </div>
</div>

<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$verifiedDonation->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$verifiedDonation->id}}");
  preloader.style.display = "block";
});
</script>