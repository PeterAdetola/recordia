
<!-- Start Modal -->
<div id="add_permission-modal" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Add Permission</h6>

      <div class="progress collection">
        <div id="add_permission-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ url('permission') }}">
            @csrf
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12 m6">
  <select name="name" class="select2 browser-default">
                  <option value="">Choose Action</option>
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
                  <option value="">Select Module</option>
  @foreach($modules as $module) 
                    <option value="{{ $module->id }}-{{ $module->name }}">{{ $module->name }}</option>
  @endforeach
  @else
                    <option value="">No entry</option>
  @endif
  </select>
</div>
      </div><br/><br/><br/><br/>
      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="addPermissionBtn" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addPermissionBtn").addEventListener("click", function() {
      var preloader = document.getElementById("add_permission-preloader");
      preloader.style.display = "block";
    });  

</script>
<!-- /End Modal -->