
<!-- Start Modal -->
<div id="delete_role-modal{{ $role->id }}" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Delete Role</h6>

      <div class="progress collection">
        <div id="delete_role-modal{{ $role->id }}-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ url('role/'.$role->id) }}">
            @csrf
            @method('DELETE')
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12">
              <input id="name" name="name" type="text" value="{{ $role->name }}" class="validate"  disabled />
              <label for="name">Role</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="deleteRoleBtn{{ $role->id }}" type="submit" class="btn-large right">Delete</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("deleteRoleBtn{{ $role->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("delete_role-modal{{ $role->id }}-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->