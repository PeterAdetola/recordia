
        <!-- Transaction info -->
<div id="{{ $expense->id }}" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Edit Expense </h6>

      <div class="progress collection">
        <div id="preloader{{$expense->id}}" class="indeterminate"  style="display:none;
        border:2px #ebebeb solid"></div>
      </div>
      
      <form id="donationForm" method="POST" action="{{ route('update.transaction') }}">
        @csrf
      <input type="hidden" name="id" value="{{ $expense->id }}">
      <input type="hidden" name="transaction" value="{{ ($expense->transaction == 1)? 1 : 0 }}">

      <div class="row">

        <div class="input-field col m6 s12">
          <input name="name" id="fullname" value="{{ $expense->name }}" type="text" required/>
          <label for="fullname">Name</label>
        </div> 

        <div class="input-field col m6 s12">
          <input name="phone" id="phone" value="{{ $expense->phone }}" type="text" placeholder= "{{($expense->phone == '')? 'Not Available':''}}">
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>

      </div>
      <div class="row">

        <div class="input-field col m6 s12">
          <input name="amount" id="amount" value="{{ $expense->amount }}" type="text" required>
                  <label for="amount">Amount 

          @if ($expense->transaction == 1 && $expense->payment_status == 1)
                paid in (&#8358;)
          @elseif ($expense->transaction == 1 && $expense->payment_status == 0)
                pledged in (&#8358;)
          @elseif ($expense->transaction == 0 && $expense->payment_status == 0)
                given in (&#8358;)
          @endif
                    
                  </label>
        </div>

        <div class="input-field col m6 s12">
          <input name="purpose" id="purpose" value="{{ $expense->purpose }}" type="text" class="autocomplete" required>
          <label for="purpose">for</label>
        </div>


              <div class="row">
                @if($expense->transaction == 1)
                  <div class="col s12 m6" style="padding:1em">
                   <div class="switch mt-5">
                      <label>
                        <input id="payment" name="payment_status" value="1" type="checkbox" {{ ($expense->payment_status == 1)? 'checked' : '' }} >
                        <span class="lever"></span>
                        <span style="font-size:1.1em;"><b style="font-size:1.1em;">{{ ($expense->payment_status == 1)? 'Paid' : 'Pledged (check when paid)' }}</b></span>
                      </label>
                    </div>
                      <div class="ml-7 mt-4">
                        @php
                        if($expense->payment_status == 0) { 
                          $expense->verification = 0;
                        }
                        @endphp
                        <label>
                          <input id="verification" name="verification" type="checkbox" class="filled-in" value="1" {{ ($expense->verification == 1)? 'checked' : '' }} />
                          <span>{{ ($expense->verification == 1)? 'Verified' : 'Not Verified' }}</span>
                        </label>
                      </div>
                  </div>
                  @endif

                  <div class="input-field mt-8 col s12 m6">
                    <button id="submitBtn{{$expense->id}}" class="btn-large waves-effect waves-light {{ ($expense->transaction == 1)? 'right' : 'center' }}" type="submit"  onclick="ShowPreloader{{$expense->id}}()">Update
                      <i class="material-icons right">send</i>
                    </button>
                  </div>

      </div>

      </form>
  </div>
</div>

<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$expense->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$expense->id}}");
  preloader.style.display = "block";
});
</script>