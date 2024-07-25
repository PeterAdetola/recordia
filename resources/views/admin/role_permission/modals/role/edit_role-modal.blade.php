
<!-- Start Modal -->
<div id="edit_role-modal{{ $role->id }}" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Edit Role</h6>

      <div class="progress collection">
        <div id="edit_role-modal{{ $role->id }}-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ url('role/'.$role->id) }}">
            @csrf
            @method('PUT')
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12">
              <input id="module" name="name" type="text" value="{{ $role->name }}" class="validate"  required />
              <label for="heading">Role</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="addRoleBtn{{ $role->id }}" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addRoleBtn{{ $role->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("edit_role-modal{{ $role->id }}-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->