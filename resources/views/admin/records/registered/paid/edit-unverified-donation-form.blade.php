

<!-- Modal Structure -->

    <div id="{{ $unverifiedDonation->id }}" class="modal border-radius-10" style="padding:2em;">

<form id="verifyForm" method="POST" action="{{ route('registered.verify_a_donation') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $unverifiedDonation->id }}">
      <!-- <input type="hidden" name="verification" value="1"> -->
        <div class="modal-content">
          <h6 class="card-title">
            You are about to verify the payment of 
            {{ $unverifiedDonation['donor']['title'] }} {{ $unverifiedDonation['donor']['name'] }} 
          </h6>

        <p>Do you want to proceed ?</p>
        </div>
    <div class="progress collection">
      <div id="preloader{{$unverifiedDonation->id}}" class="indeterminate"  style="display:none; 
      border:2px #ebebeb solid"></div>
    </div>

        <div class="modal-footer">
      <button id="submitBtn{{$unverifiedDonation->id}}" type="submit" class="modal-action waves-effect waves-green btn-large" >Yes, verify payment</button>
          <a href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
      </form>

      <script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$unverifiedDonation->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$unverifiedDonation->id}}");
  preloader.style.display = "block";
});
</script>
    </div>