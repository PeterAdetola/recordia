
@php
$existing_years = App\Models\YearRecord::orderBy('year', 'desc')->get();
@endphp
      <div id="edit_year">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Edit year details</h6>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

            @if (count($existing_years))
              @foreach($existing_years as $year)

                <a href="#{{$year->id}}" class="chip mb-2 grey lighten-2 modal-trigger">
                      <span class="red-text" style="font-weight: 800">Year {{ $year->year }}</span>
                </a>


<!-- Modal Structure -->

    <div id="{{$year->id}}" class="modal border-radius-10" style="padding:2em;">

      <form  method="POST" action="{{ route('update.year') }}">
              @csrf
            <input type="hidden" name="id" value="{{ $year->id }}">
        <div class="modal-content">
        <h6 class="card-title">Edit year details</h6>

        <div class="progress collection">
          <div id="preloader3" class="indeterminate" style="display:none; 
          border:2px #ebebeb solid"></div>
        </div>
        
          <input id="year" type="text" name="year" value="{{ $year->year }}" />
          <input id="title" type="text" name="title" value="{{ $year->title }}" placeholder="(Optional) Thanksgiving of ...."  />
        </div>

        <div class="modal-footer">
          <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Update</button>
          <a id="reload" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
        </div>
      </form>

    </div>
                @endforeach
              @else
                <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available year</span>                      
                </div>
              @endif
             </div>

            </div>
        </div>
        </div>
      </div>
