
      <div id="events">
        <div class="card-panel">
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Manage Events</h6>
            <div class="caption mb-0">
              <div class="collection" style="padding:1em">

           {{-- @if (count($existing_years))
              @foreach($existing_years as $year) --}}

                <a href="#modal1" class="chip mb-2 gradient-45deg-light-blue-indigo modal-trigger">
                      <span class="red-text" style="font-weight: 800">Thanksgiving</span>
                </a>

                <a href="#modal1" class="chip mb-2 gradient-45deg-light-blue-indigo modal-trigger">
                      <span class="red-text" style="font-weight: 800">Ordination</span>
                </a>

                <a href="#modal1" class="chip mb-2 grey lighten-2 modal-trigger"
                style="border-top:1px solid #bdbdbd; border-right:1px solid #bdbdbd">
                      <span class="grey-text">Marriage</span>
                </a>

                <!-- <a href="#modal1" class="chip mb-2 grey lighten-2 modal-trigger">
                      <span class="red-text" style="font-weight: 800">Veronica Okafor</span>
                </a> -->

                <a href="#add-recorder" class="btn-floating mb-2 waves-effect waves-light white-text gradient-45deg-brown-brown modal-trigger">
                      <i class="material-icons">add</i>
                </a>


<!-- Modal Structure -->

                {{-- @endforeach --}}
              {{--@else --}}
                <!-- <div class="chip mb-2 grey lighten-2">
                    <span class="grey-text">No available year</span>                      
                </div> -->
              {{--@endif --}}
             </div>
<!-- Modal Structure -->

    <div id="add-recorder" class="modal border-radius-10" style="padding:1em;">
          <div class="modal-content">
            <h6 class="card-title">Add a new event</h6>

      <div class="progress collection">
        <div id="preloader4" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
      
            <form>
              <div class="row">
                <div class="col s12">
                  <div class="input-field">
                    <input id="EventName" name="name" type="text" required />
                    <label for="EventName">Event Name</label>
                  </div>
                </div>
              </div>

        <div class="modal-footer">
            <div class="left mt-3 mb-2">
              <div class="switch">
                <label>
                  Deactivated
                  <input name="activated" value="1" type="checkbox" />
                  <span class="lever"></span>
                  Activated
                </label>
              </div>
            </div>
          <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Add Event</button>
          <a id="reload2" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
        </div>
            </form>


            </div>
        </div>
        </div>
      </div>