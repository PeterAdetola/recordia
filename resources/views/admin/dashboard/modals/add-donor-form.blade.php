

<!-- Start Modal -->
<div id="add-donor-modal" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Add Donor</h6>
      
      <div class="progress collection">
        <div id="donor-preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

      <form method="POST" action="{{ route('save.donor') }}">
        <!-- <form method="POST" action="{{ route('save.event') }}"> -->
        @csrf
      <div class="row">
        <div class="input-field col m6 s12">
          <input name="title" id="title" :value="old('title')" type="text" required/>
          <label for="title">Title</label>
            @error('name')
            <small class="errorTxt3  red-text">{{ $message }}*</small>
            @enderror 
        </div> 
        <div class="input-field col m6 s12">
          <input name="name" id="name" :value="old('name')" type="text" required>
          <label for="name">Full name</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>
      </div>
      <div class="row">
        <div class="input-field col m6 s12">
          <input name="username" id="username" :value="old('username')" type="text" required/>
          <label for="username">Username</label>
            @error('username')
            <small class="errorTxt3  red-text">{{ $message }}*</small>
            @enderror 
        </div> 
        <div class="input-field col m6 s12">
          <input name="phone" id="phone" :value="old('phone')" type="text" required>
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>
      </div>
    

    <div class="modal-footer">
      <div class="row">
          <div class="col s4 left">
           <div class="switch mt-5">
              <label>
                <input id="status" name="status" type="checkbox" checked />
                <span class="lever"></span>
                <span style="font-size:1.1em;"><b style="font-size:1.1em;">Active</b></span>
              </label>
            </div>
          </div>
    <div class="col s8">
        <button  id="submitDonorBtn" type="submit" class="modal-action waves-effect waves-green btn-large">Add Donor</button>
        <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
      </div>
    </div>
</form>
</div>
</div>
</div>
<!-- /End Modal -->