
<!-- Modal Structure -->

<div id="create-year" class="modal border-radius-10" style="padding:2em;">
  <form  method="POST" action="{{ route('save.year') }}">
    @csrf
    <input type="hidden" name="tab" value="activate_year">
    <input type="hidden" value="0" name="status">
    <div class="modal-content">
      <h6 class="card-title">You are about to create a new financial year</h6>

      <div class="progress collection">
        <div id="preloader" class="indeterminate" style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <input id="year" type="text" name="year" placeholder="2023" required autofocus />
    <input id="title" type="text" name="title" placeholder="(Optional) Thanksgiving of ...."  />
    </div>

    <div class="modal-footer">
      <button id="submitBtn" type="submit" class="modal-action waves-effect waves-grey btn-large">Create Year</button>
      <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>