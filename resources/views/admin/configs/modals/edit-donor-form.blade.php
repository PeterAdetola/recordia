

<!-- Start Modal -->
<div id="{{ $donor->id }}" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Edit Donor</h6>
      
      <div class="progress collection">
        <div id="preloader{{$donor->id}}" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

        <form method="POST" action="{{ route('update.donor') }}">
              <!-- <form method="POST" action="{{ route('save.event') }}"> -->
              @csrf
              <input type="hidden" name="id" value="{{ $donor->id }}">
            <div class="row">
              <div class="input-field col m6 s12">
                <input name="title" id="title" value="{{ $donor->title }}" type="text" required/>
                <label for="title">Title</label>
              </div> 
              <div class="input-field col m6 s12">
                <input name="name" id="name" value="{{ $donor->name }}" type="text" required>
                <label for="name">Full name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s12">
                <input name="username" id="username" value="{{ $donor->username }}" type="text" required/>
                <label for="username">Username</label>
              </div> 
              <div class="input-field col m6 s12">
                <input name="phone" id="phone" value="{{ $donor->phone }}" type="text" required>
                <label for="phone">Phone Number</label>
              </div>
            </div>
          

          <div class="modal-footer">
            <div class="row">
                <div class="col s4 left">
                 <div class="switch mt-5">
                    <label>
                      <input id="status" name="status" type="checkbox" {{ ($donor->status == 1)? 'checked' : ''}} />
                      <span class="lever"></span>
                      <span style="font-size:1.1em;"><b style="font-size:1.1em;">Active</b></span>
                    </label>
                  </div>
                </div>
          <div class="col s8">
              
                    <button id="submitBtn{{$donor->id}}" class="btn-large waves-effect waves-light {{ ($donor->transaction == 1)? 'right' : 'center' }}" type="submit"  onclick="ShowPreloader{{$donor->id}}()">Update
                      <i class="material-icons right">send</i>
                    </button>
              <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
            </div>
          </div>
          </div>
        </form>

</div>
</div>
<script type="text/javascript"> 
      // Preloader Script
document.getElementById("submitBtn{{$donor->id}}").addEventListener("click", function() {
  var preloader = document.getElementById("preloader{{$donor->id}}");
  preloader.style.display = "block";
});
</script>
<!-- /End Modal -->