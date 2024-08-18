
<!-- Start Modal -->
<div id="edit_permission-modal{{ $permission->id }}" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Edit Permission</h6>

      <div class="progress collection">
        <div id="edit_permission-modal{{ $permission->id }}-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
  <form method="POST" action="{{ url('permission/'.$permission->id) }}">
            @csrf
            @method('PUT')
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12 m6">
  <select name="name1" class="select2 browser-default">
    @php
      $data = explode(' ',$permission->name);
      $action = $data[0];
    @endphp
                  <option value="{{ $action }}">{{ $action }}</option>
                    <option value="create">create</option>
                    <option value="view">view</option>
                    <option value="edit">edit</option>
                    <option value="delete">delete</option>
  </select>
</div>
        <div class="input-field col s12 m6">
  <select name="module_id" class="select2 browser-default">
    @php  
    $modules = getModules();
    @endphp
  @if (count($modules) > 0)
                  <option value="{{ $permission->module_id }}">{{ $permission->module->name }}</option>
  @foreach($modules as $module) 
                    <option value="{{ $module->id }}-{{ $module->name }}">{{ $module->name }}</option>
  @endforeach
  @else
                    <option value="">No entry</option>
  @endif
  </select>
</div>
      </div><br/><br/><br/>

      <div class="divider mb-2"></div>
      <div class="row">
            <a  id="deletePermissionBtn{{ $permission->id }}" href="{{ url('permission/'.$permission->id.'/delete') }}" class="left ml-3 mt-1"><i class="material-icons vertical-align-middle small-ico-bg red-text">delete</i></a> 
        <button  id="addPermissionBtn{{ $permission->id }}" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addPermissionBtn{{ $permission->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("edit_permission-modal{{ $permission->id }}-preloader");
      preloader.style.display = "block";
    });  
    document.getElementById("deletePermissionBtn{{ $permission->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("edit_permission-modal{{ $permission->id }}-preloader");
      preloader.style.display = "block";
    }); 
</script>
<!-- /End Modal -->