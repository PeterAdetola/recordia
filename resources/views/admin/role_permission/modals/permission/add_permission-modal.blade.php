
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
        <div class="input-field">
  <select name="module_id" class="select2 browser-default">
    @php  
    $modules = getModules();
    @endphp
  @if (count($modules) > 0)
                  <option value="">Choose Category</option>
  @foreach($modules as $module) 
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
  @endforeach
  @else
                    <option value="">No entry</option>
  @endif
  </select>
</div>
        <div class="input-field col s12">
              <input id="module" name="name" type="text" class="validate"  required />
              <label for="heading">Permission</label>
        </div>
      </div>

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