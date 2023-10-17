
      <div id="activate_year">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>

    
       @if(Session::has('yearMessageTitle'))

               <div class="card-alert card pink lighten-5" >
                <div class="card-content pink-text darken-1">
                  <span class="card-title pink-text darken-1"><i class="material-icons">notifications</i>&nbsp;{{ Session::get('yearMessageTitle') }}</span>
                  <p>{{ Session::get('yearMessage') }}</p>
                </div>
                <div class="card-action pink lighten-4">
                  <a href="#" data-dismiss="alert" aria-label="Close" class="close pink-text" aria-hidden="true">Ok</a>
                </div>
              </div>

       @endif 
      <h6 class="card-title">Set the current year</h6>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

            @if (count($existing_years))
              @foreach($existing_years as $year)
            <form  method="POST" action="{{ route('activate.year', $year->id) }}">
                  @csrf
            <input type="hidden" name="tab" value="activate_year">
                <a href="{{$year->id}}" class="{{ ($year->status == '1')? 'gradient-45deg-light-blue-indigo gradient-shadow white-text' : 'chip mb-2 grey lighten-2' }} chip mb-2" style="{{ ($year->status == '1')? 'border-bottom:1px solid white; border-left:1px solid white' : 'border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd' }}">

                    <label>
                      <input class="actYear" name="status" type="radio"  value="{{ $year->id }}" required {{ ($year->status == '1')? 'checked' : '' }}/>
                      <span class="{{ ($year->status == '1')? 'white-text' : 'grey-text' }}">Year {{ $year->year }}</span>
                    </label>
                </a>
                @endforeach
                
              @else
                <div class="chip mb-2 grey lighten-2"
                style="border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd">
                    <span class="grey-text">No available year</span>                     
                </div>
              @endif

                <a href="#create-year" class="btn-floating mb-2 waves-effect waves-light grey lighten-5 modal-trigger">
                      <i class="material-icons red-text">add</i>
                </a>

             </div>
             <button id="actYearBtn" class="btn-large modal-trigger" href="#activate-year" disabled >Activate Year</button>
            </div>
        </div>
        </div>
      </div>

<!-- Modal Structure -->
@include('admin.configs.modals.activate-year-form')
</form>
@include('admin.configs.modals.create-year-form')

  <script type="text/javascript">
    var radioButtons = document.querySelectorAll('.actYear');
    var submitButton = document.getElementById('actYearBtn');

    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
          submitButton.removeAttribute('disabled');
        } else {
          submitButton.setAttribute('disabled', 'disabled');
        }
      });
    });

  // Preloader Scripts
document.getElementById("submitBtn").addEventListener("click", function() {
  var preloader = document.getElementById("preloader");
  preloader.style.display = "block";
});

document.getElementById("submitBtn1").addEventListener("click", function() {
  var preloader = document.getElementById("preloader1");
  preloader.style.display = "block";
});
  </script>
