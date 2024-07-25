
<!-- Start Modal -->
<div id="edit_module-modal{{ $module->id }}" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Edit Module</h6>

      <div class="progress collection">
        <div id="edit_module-modal{{ $module->id }}-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <form method="POST" action="{{ route('update.module') }}">
            @csrf
      <input type="hidden" name="id" value="{{ $module->id }}" />
      <div class="row" style="padding-left: 2em; padding-right: 2em;">
        <div class="input-field col s12">
              <input id="module" name="name" type="text" value="{{ $module->name }}" class="validate"  required />
              <label for="heading">Module</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="addModuleBtn{{ $module->id }}" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addModuleBtn{{ $module->id }}").addEventListener("click", function() {
      var preloader = document.getElementById("edit_module-modal{{ $module->id }}-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->