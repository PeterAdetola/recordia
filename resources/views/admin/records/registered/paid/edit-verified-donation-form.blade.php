

<!-- Modal Structure -->

    <div id="{{ $verifiedDonation->id }}" class="modal border-radius-10" style="padding:2em;">

<form id="unverifyForm" method="POST" action="{{ route('registered.unverify_a_donation') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $verifiedDonation->id }}">
      <!-- <input type="hidden" name="payment_status" value="1"> -->
        <div class="modal-content">
          <h6 class="card-title">
            You are about to unverify the payment of 
            {{ $verifiedDonation['donor']['title'] }} {{ $verifiedDonation['donor']['name'] }}  
          </h6>

        <p>Do you want to proceed ?</p>
        </div>
    <div class="progress collection">
      <div id="preloader{{$verifiedDonation->id}}" class="indeterminate"  style="display:none; 
      border:2px #ebebeb solid"></div>
    </div>

        <div class="modal-footer">
      <button id="submitBtn{{$verifiedDonation->id}}" type="submit" class="modal-action waves-effect waves-green btn-large" >Yes, unverify payment</button>
          <a href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
      </form>

      <script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$verifiedDonation->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$verifiedDonation->id}}");
  preloader.style.display = "block";
});
</script>
    </div>