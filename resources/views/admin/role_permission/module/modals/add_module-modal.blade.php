
<!-- Start Modal -->
<div id="add_module-modal" class="modal" style="padding:0.1em;">
    <div class="modal-content">
      <h6 class="card-title ml-2" style="display:inline-block;">Add Module</h6>

      <div class="progress collection">
        <div id="add_module-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
      
      

    <form method="POST" action="{{ route('save.module') }}">
            @csrf
      <div class="row">
        <div class="input-field col s12">
              <input id="module" name="name" type="text" class="validate"  required />
              <label for="heading">Module</label>
        </div>
      </div>

      <div class="divider mb-2"></div>
      <div class="row">
        <button  id="addModuleBtn" type="submit" class="btn-large right">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById("addModuleBtn").addEventListener("click", function() {
      var preloader = document.getElementById("add_module-preloader");
      preloader.style.display = "block";
    });  
</script>
<!-- /End Modal -->