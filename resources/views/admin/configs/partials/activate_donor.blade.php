
      <div id="activate_event">
        <div class="card-panel">
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
    
       @if(Session::has('donorMessageTitle'))

               <div class="card-alert card pink lighten-5" >
                <div class="card-content pink-text darken-1">
                  <span class="card-title pink-text darken-1"><i class="material-icons">notifications</i>&nbsp;{{ Session::get('donorMessageTitle') }}</span>
                  <p>{{ Session::get('donorMessage') }}</p>
                </div>
                <div class="card-action pink lighten-4">
                  <a href="#" data-dismiss="alert" aria-label="Close" class="close pink-text" aria-hidden="true">Ok</a>
                </div>
              </div>

       @endif 
       
      <h6 class="card-title">Manage Donors</h6>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

           @if (count($donors))
              @foreach($donors as $donor)
    <form id="activateDonorForm"  method="POST" action="{{ route('activate.donor', $donor->id) }}">
                  @csrf
              <input type="hidden" name="tab" value="activate_donor">
                <a href="{{$donor->id}}" class="{{ ($donor->status == '1')? 'gradient-45deg-light-blue-indigo white-text' : 'chip mb-2 grey lighten-2' }} chip mb-2"
                style="{{ ($donor->status == '1')? 'border-bottom:1px solid white; border-left:1px solid white' : 'border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd' }}" >

              <label>
                <input class="filled-in" name="status" type="checkbox" value="{{ $donor->id }}"  {{ ($donor->status == '1')? 'checked' : '' }}/>
                <span class="{{ ($donor->status == '1')? 'white-text' : 'grey-text' }}">{{ $donor->name }}</span>
              </label>
                </a>
              @endforeach

              @else
                <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available donor</span>                 
                </div>
              @endif

                <a href="#add-recorder" class="btn-floating mb-2 waves-effect waves-light grey lighten-5 modal-trigger">
                      <i class="material-icons red-text">add</i>
                </a>
                <div class="divider"></div>

                <!-- <div class="mt-3 mb-2 col s12">
                  <div class="switch">
                    <label>                      
                      <input name="status" value="No Event" type="checkbox" />
                      <span class="lever"></span>
                      No Event
                    </label>
                  </div>
                </div> -->

             </div>

             </div>
             <a id="actDonorBtn" href="#activate-event" class="modal-trigger btn-large" >Activate Donors</a>
            </div>
        </div>
      </div>


    <!-- Modal structure to activate event -->
@include('admin.configs.modals.activate-event-modal')
    </form>
    <!-- Modal Structure to add event -->
@include('admin.configs.modals.add-event-form')

 <script type="text/javascript">
// Get references to the radios 
const clearRadio = document.querySelector('input[name="no_event"]');
const otherRadios = document.querySelectorAll('input[name="status"]');

// Add change event listener to clear radio
clearRadio.addEventListener('change', function() {

  // If clear radio is checked
  if(this.checked) {

    // Loop through other radios
    otherRadios.forEach(radio => {

      // Uncheck each one
      radio.checked = false;

    });

  }

});

// Add change event listener to other radios
otherRadios.forEach(radio => {

  radio.addEventListener('change', function() {

    // If an other radio is checked
    if(this.checked) {

      // Uncheck clear radio
      clearRadio.checked = false;

    }

  });

});

      // Preloader Script
document.getElementById("submitEventBtn").addEventListener("click", function() {
  var preloader = document.getElementById("preloaderEvent");
  preloader.style.display = "block";
});
      // Preloader Script
document.getElementById("submitEventBtn1").addEventListener("click", function() {
  var preloader = document.getElementById("preloaderEvent1");
  preloader.style.display = "block";
});

  </script>
