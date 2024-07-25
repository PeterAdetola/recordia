
<!-- Start Modal -->
<div id="delete_permission-modal{{ $permission->id }}" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Delete Permission</h6>

      <div class="progress collection">
        <div id="delete_permission-modal{{ $permission->id }}-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ url('permission/'.$permission->id) }}">
            @csrf
            @method('DELETE')
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field">
  <select name="module_id" class="select2 browser-default" disabled>
    @php  
    $modules = getModules();
    @endphp
  @if (count($modules) > 0)
                  <option value="{{ $permission->module_id }}">{{ $permission->module->name }}</option>
  @foreach($modules as $module) 
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
  @endforeach
  @else
                    <option value="">No entry</option>
  @endif
  </select>
</div>
        <div class="input-field col s12">
              <input id="module" name="name" type="text" value="{{ $permission->name }}" class="validate"  disabled />
              <label for="heading">Permission</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="deletePermissionBtn{{ $permission->id }}" type="submit" class="btn-large right">Delete</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("deletePermissionBtn{{ $permission->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("delete_permission-modal{{ $permission->id }}-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->