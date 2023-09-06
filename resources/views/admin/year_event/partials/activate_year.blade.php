
@php
$existing_years = App\Models\YearRecord::orderBy('year', 'desc')->get();
@endphp
      <div id="activate_year">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Set the current year</h6>
            <div class="caption mb-0">
              <p>
                 {{ __('
                You are about to select a year from existing years to check for financial record of the particular year and event, subsequent activities will be recorded to the selected year, proceed with caution') }}
              </p>
              <div class="collection" style="padding:1em">

            @if (count($existing_years))
              @foreach($existing_years as $year)
            <form  method="POST" action="{{ route('activate.year', $year->id) }}">
                  @csrf
                <!-- <div class="chip mb-2 gradient-45deg-purple-light-blue gradient-shadow white-text">
                    <label>
                      <input class="with-gap" name="group3" type="radio" checked />
                      <span class="white-text">Year 2023</span>
                    </label>
                </div> -->
                <a href="{{$year->id}}" class="{{ ($year->status == '1')? 'gradient-45deg-purple-light-blue gradient-shadow white-text' : 'chip mb-2 grey lighten-2' }} chip mb-2">
                      <!-- <input name="id" type="hidden" /> -->
                    <label>
                      <input class="with-gap" name="status" type="radio"  value="{{ $year->id }}" required {{ ($year->status == '1')? 'checked' : '' }}/>
                      <span class="{{ ($year->status == '1')? 'white-text' : 'grey-text' }}">Year {{ $year->year }}</span>
                    </label>
                </a>
                @endforeach
              @else
                <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available year</span>                      
                </div>
              @endif
                <!-- <div class="chip mb-2 grey lighten-2">
                    <label>
                      <input class="with-gap" name="group3" type="radio" />
                      <span class="grey-text">Year 2021</span>
                    </label>
                </div> -->
             </div>
             <!-- <div class="divider"></div> -->
             <button id="activate" class="btn-large modal-trigger"  href="#activate-year" disabled >Activate Year</button>
            </div>
        </div>
        </div>
      </div>
<!-- Modal Structure -->

    <div id="activate-year" class="modal border-radius-10" style="padding:2em;">
        <div class="modal-content">
          <h5 class="card-title">You are about to activate the selected financial year</h5>

        <p>Do you want to proceed with the activation?</p>
        </div>

      <div class="progress collection">
        <div id="preloader2" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

        <div class="modal-footer">
          <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Yes, Activate Year</button>
          <a id="reload" href="javascript:void(0)" class="btn-large btn-flat modal-close">No, Cancel</a>
        </div>
    </div>
</form>

  <script type="text/javascript">
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    var submitButton = document.getElementById('activate');

    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        if (radioButton.checked) {
          submitButton.removeAttribute('disabled');
        } else {
          submitButton.setAttribute('disabled', 'disabled');
        }
      });
    });

    function reload() {
      window.location.reload();
    }

    document.querySelector('#reload').onclick = reload;

  </script>
