
<!-- Start Modal -->
<div id="add_role-modal" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Add Role</h6>

      <div class="progress collection">
        <div id="add_role-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ url('role') }}">
            @csrf
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12">
              <input id="module" name="name" type="text" class="validate"  required />
              <label for="heading">Role</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="addRoleBtn" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addRoleBtn").addEventListener("click", function() {
      var preloader = document.getElementById("add_role-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->