

    <div id="add-recorder" class="modal border-radius-10" style="padding:1em;">
          <div class="modal-content">
            <h6 class="card-title">Add a new event</h6>

      <div class="progress collection">
        <div id="preloaderEvent1" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
      
            <form method="POST" action="{{ route('save.event') }}">
        @csrf
            <input type="hidden" name="tab" value="events">
              <div class="row">
                <div class="col s12">
                  <div class="input-field">
                    <input class="EventName" name="name" type="text" required />
                    <label for="EventName">Event Name</label>
                  </div>
                </div>
              </div>

        <div class="modal-footer row">
            <div class="mt-3 mb-2 col s12 m6" style="margin-left:-3em">
              <div class="switch">
                <label>
                  Deactivated
                  <input name="status" value="1" type="checkbox" />
                  <span class="lever"></span>
                  Activated
                </label>
              </div>
            </div>
            <div class="col s12 m6 mt-2">
          <button id="submitEventBtn1" type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large">Add Event</button>
          <a id="reload2" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
        </div>
        </div>
            </form>


            </div>
        </div>