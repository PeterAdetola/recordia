
        <!-- Transaction info -->
<div id="{{ $donorDonation->id }}" class="modal" style="padding:1em;">

<form id="redeemDonorPledge" method="POST" action="{{ route('redeem.donor.donation') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $donorDonation->id }}">
      <input type="hidden" name="payment_status" value="1">
    <div class="modal-content">
        
          <h6 class="card-title">
            You are about to confirm that the pledge of 
            {{ $donorDonation['donor']['title']  }} {{ $donorDonation['donor']['name']  }} for {{$donorDonation->purpose}} has been paid
          </h6>

        <p>Do you want to proceed ?</p>



      <div class="progress collection">
        <div id="preloader{{$donorDonation->id}}" class="indeterminate"  style="display:none;
        border:2px #ebebeb solid"></div>
      </div>

        <div class="modal-footer">
          <div class="row">
          <div class=" mt-4 left">
            @php
            if($donorDonation->payment_status == 0) { 
              $donorDonation->verification = 0;
            }
            @endphp
            <label>
              <input id="verification" name="verification" type="checkbox" class="filled-in" value="1" checked {{ ($donorDonation->verification == 1)? 'disabled' : '' }} />
              <span>{{ ($donorDonation->verification == 1)? '' : 'Verified' }}</span>
            </label>
          </div>
      <button id="submitBtn{{$donorDonation->id}}" type="submit" class="modal-action waves-effect waves-green btn-large" >Yes, Pledge is paid</button>
          <a href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
        </div>

      </form>
  </div>
</div>

<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$donorDonation->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$donorDonation->id}}");
  preloader.style.display = "block";
});
</script>