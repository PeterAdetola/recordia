
      <div id="create_year">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Create a new financial year</h6>
            <div class="caption mb-0">
               <p class="collection" style="padding:2em">
                 {{ __('
                You are about to create a new year for the upcoming financial records. The newly created year will become the current year for upcoming financial records and these records will depend on it, proceed with caution.') }}
             </p>
             <!-- <div class="divider"></div> -->
             <a class="btn-large modal-trigger"  href="#create-year">Create Year</a>
            </div>
        </div>
        </div>
      </div>
<!-- Modal Structure -->

<div id="create-year" class="modal border-radius-10" style="padding:2em;">
  <form  method="POST" action="{{ route('save.year') }}">
                  @csrf
    <input type="hidden" value="0" name="status">
    <div class="modal-content">
      <h6 class="card-title">You are about to create a new financial year</h6>

    <input id="year" type="text" name="year" placeholder="2023" required autofocus />
    <input id="title" type="text" name="title" placeholder="(Optional) Thanksgiving of ...."  />
    </div>

      <div class="progress collection">
        <div id="preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <div class="modal-footer">
      <button type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-grey btn-large">Create Year</button>
      <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>
