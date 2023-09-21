
        <!-- Transaction info -->
<div id="{{ $instantRecord->id }}" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Edit Transaction</h6>
      <form id="donationForm" method="POST" action="{{ route('update.transaction') }}">
        @csrf
      <input type="hidden" name="id" value="{{ $instantRecord->id }}">
      <input type="hidden" name="transaction" value="{{ ($instantRecord->transaction == 1)? 1 : 0 }}">

      <div class="row">

        <div class="input-field col m6 s12">
          <input name="name" id="fullname" value="{{ $instantRecord->name }}" type="text" required/>
          <label for="fullname">Name</label>
        </div> 

        <div class="input-field col m6 s12">
          <input name="phone" id="phone" value="{{ $instantRecord->phone }}" type="text" placeholder= "{{($instantRecord->phone == '')? 'Not Available':''}}">
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>

      </div>
      <div class="row">

        <div class="input-field col m6 s12">
          <input name="amount" id="amount" value="{{ $instantRecord->amount }}" type="text" required>
                  <label for="amount">Amount 

          @if ($instantRecord->transaction == 1 && $instantRecord->payment_status == 1)
                paid in (&#8358;)
          @elseif ($instantRecord->transaction == 1 && $instantRecord->payment_status == 0)
                pledged in (&#8358;)
          @elseif ($instantRecord->transaction == 0 && $instantRecord->payment_status == 0)
                given in (&#8358;)
          @endif
                    
                  </label>
        </div>

        <div class="input-field col m6 s12">
          <input name="purpose" id="purpose" value="{{ $instantRecord->purpose }}" type="text" class="autocomplete" required>
          <label for="purpose">for</label>
        </div>


      <div class="progress collection">
        <div id="preloader{{$instantRecord->id}}" class="indeterminate"  style="display:none;
        border:2px #ebebeb solid"></div>
      </div>

              <div class="row">
                @if($instantRecord->transaction == 1)
                  <div class="col s12 m6" style="padding:1em">
                   <div class="switch mt-5">
                      <label>
                        <input id="payment" name="payment_status" value="1" type="checkbox" {{ ($instantRecord->payment_status == 1)? 'checked' : '' }} >
                        <span class="lever"></span>
                        <span style="font-size:1.1em;"><b style="font-size:1.1em;">{{ ($instantRecord->payment_status == 1)? 'Paid' : 'Pledged (check when paid)' }}</b></span>
                      </label>
                    </div>
                      <div class="ml-7 mt-4">
                        @php
                        if($instantRecord->payment_status == 0) { 
                          $instantRecord->verification = 0;
                        }
                        @endphp
                        <label>
                          <input id="verification" name="verification" type="checkbox" class="filled-in" value="1" {{ ($instantRecord->verification == 1)? 'checked' : '' }} {{ ($instantRecord->verification == 1)? 'disabled' : '' }} />
                          <span>{{ ($instantRecord->verification == 1)? 'Verified' : 'Not Verified' }}</span>
                        </label>
                      </div>
                  </div>
                  @endif

                  <div class="input-field mt-8 col s12 m6">
                    <button id="submitBtn{{$instantRecord->id}}" class="btn-large waves-effect waves-light {{ ($instantRecord->transaction == 1)? 'right' : 'center' }}" type="submit"  onclick="ShowPreloader{{$instantRecord->id}}()">Update
                      <i class="material-icons right">send</i>
                    </button>
                  </div>

      </div>

      </form>
  </div>
</div>

<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$instantRecord->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$instantRecord->id}}");
  preloader.style.display = "block";
});
</script>