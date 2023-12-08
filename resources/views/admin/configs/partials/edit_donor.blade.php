
      <div id="edit_event">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Edit donor details</h6>
      <p>Click on the event to edit</p>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

            @if (count($donors))
              @foreach($donors as $donor)

                <a href="#{{$donor->id}}" class="chip mb-2 grey lighten-2 modal-trigger" style="border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd">
                      <span class="red-text" style="font-weight: 800; ">{{ $donor->name }}</span>
                </a>


<!-- Modal Structure -->

    <div id="{{$donor->id}}" class="modal border-radius-10" style="padding:2em;">

      <form  method="POST" action="{{ route('update.event') }}">
              @csrf
            <input type="hidden" name="tab" value="edit_donor">
            <input type="hidden" name="id" value="{{ $donor->id }}">
        <div class="modal-content">
        <h6 class="card-title">Edit event details</h6>

        <div class="progress collection">
          <div id="editdonorPreloader{{$donor->id}}" class="indeterminate" style="display:none; 
          border:2px #ebebeb solid"></div>
        </div>
        
          <input id="donor" type="text" name="name" value="{{ $donor->name }}" />
        </div>

        <div class="modal-footer">
          <button id="submitEditdonorBtn{{$donor->id}}" type="submit" class="modal-action waves-effect waves-green btn-large">Update</button>
          <a id="reload" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
        </div>
      </form>

    </div>

  <script type="text/javascript">
    

      // Preloader Script
document.getElementById("submitEditdonortBtn{{$donor->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("editdonorPreloader{{$donor->id}}");
  preloader.style.display = "block";
});
  </script>
                @endforeach
              @else
                <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available event</span>                    
                </div>
              @endif
             </div>

            </div>
        </div>
        </div>
      </div>