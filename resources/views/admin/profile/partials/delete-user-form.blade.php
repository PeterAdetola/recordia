
      <div id="connections">
        <div class="card-panel">
          
        <div class="card-content">
          <div class="row mb-2 ml-3"><i class="material-icons left red-text small-ico-bg">info</i></div>
          <div class="divider mb-2"></div>
      <h6 class="card-title">Delete Account</h6>
            <div class="caption mb-0">
               <p class="collection" style="padding:2em">
                 {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
             </p>
             <!-- <div class="divider"></div> -->
             <a class="btn-large modal-trigger"  href="#delete-modal">Delete Account</a>
            </div>
        </div>
        </div>
      </div>
<!-- Modal Structure -->

<style type="text/css">
  .modal-overlay{display: none;}
</style>
<div id="delete-modal" class="modal border-radius-10" style="padding:2em;">
    <div class="modal-content">
      <h5 class="card-title">Are you sure you want to delete your account?</h5>
      <p class="">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
    <input id="password" type="password" name="password" placeholder="Password" required autofocus />
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action waves-effect waves-green btn-large">Delete</a>
      <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
  </div>
