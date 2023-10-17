
      <div id="activate_event">
        <div class="card-panel">
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>

    
       @if(Session::has('eventMessageTitle'))

               <div class="card-alert card pink lighten-5" >
                <div class="card-content pink-text darken-1">
                  <span class="card-title pink-text darken-1"><i class="material-icons">notifications</i>&nbsp;{{ Session::get('eventMessageTitle') }}</span>
                  <p>{{ Session::get('eventMessage') }}</p>
                </div>
                <div class="card-action pink lighten-4">
                  <a href="#" data-dismiss="alert" aria-label="Close" class="close pink-text" aria-hidden="true">Ok</a>
                </div>
              </div>

       @endif 
       
      <h6 class="card-title">Manage Events</h6>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

           @if (count($events))
              @foreach($events as $event)
    <form id="activateEventForm"  method="POST" action="{{ route('activate.event', $event->id) }}">
                  @csrf
              <input type="hidden" name="tab" value="activate_event">
                <a href="{{$event->id}}" class="{{ ($event->status == '1')? 'gradient-45deg-light-blue-indigo gradient-shadow white-text' : 'chip mb-2 grey lighten-2' }} chip mb-2"
                style="{{ ($event->status == '1')? 'border-bottom:1px solid white; border-left:1px solid white' : 'border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd' }}" >

              <label>
                <input class="actEvent" name="status" type="radio"  value="{{ $event->id }}" required {{ ($event->status == '1')? 'checked' : '' }}/>
                <span class="{{ ($event->status == '1')? 'white-text' : 'grey-text' }}">{{ $event->name }}</span>
              </label>
                </a>
              @endforeach

              @else
                <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available event</span>                 
                </div>
              @endif

                <a href="#add-recorder" class="btn-floating mb-2 waves-effect waves-light grey lighten-5 modal-trigger">
                      <i class="material-icons red-text">add</i>
                </a>
             </div>

             </div>
             <a id="actEventBtn" href="#activate-event" class="modal-trigger btn-large" >Activate Event</a>
            </div>
        </div>
      </div>


    <!-- Modal structure to activate event -->
@include('admin.configs.modals.activate-event-modal')
    </form>
    <!-- Modal Structure to add event -->
@include('admin.configs.modals.add-event-form')

 <script type="text/javascript">
    var radioButtons = document.querySelectorAll('.actEvent');
    var submitButton = document.getElementById('actEventBtn');

    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
          submitButton.removeAttribute('disabled');
        } else {
          submitButton.setAttribute('disabled', 'disabled');
        }
      });
    });

// Get the form and button elements
// const form = document.getElementById('activateEventForm');
// const button = document.getElementById('actEventBtn');

// // Add event listener to form 
// form.addEventListener('change', function() {

//   // Get all radio buttons in the form
//   const radios = form.querySelectorAll('input[type="radio"]');
  
//   // Check if any radio is checked
//   let checked = false;
//   for(let i = 0; i < radios.length; i++) {
//     if(radios[i].checked) {
//       checked = true;
//       break;
//     }
//   }

//   // Enable or disable button based on radio checked state
//   if(checked) {
//     button.disabled = false;
//   } else {
//     button.disabled = true; 
//   }

// });



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
