

<!-- Start Modal -->
<div id="add-donation-modal" class="modal border-radius-10" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Add Donation</h6>
      <form id="donationForm" method="POST" action="">
        @csrf
      <input type="hidden" value="credit" name="transaction">
      <div class="row">
        <div class="input-field col m6 s12">
          <input name="name" id="fullname" :value="old('fullname')" type="text" required/>
          <label for="fullname">Name</label>
            @error('name')
            <small class="errorTxt3  red-text">{{ $message }}*</small>
            @enderror 
        </div> 
        <div class="input-field col m6 s12">
          <input name="phone" id="phone" :value="old('phone')" type="text">
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>
      </div>
    
      <div class="row">
        <div class="input-field col m6 s12">
          <input name="purpose" id="purpose" :value="old('purpose')" type="text" class="autocomplete" required>
          <label for="purpose">Purpose/Item</label>
        @error('purpose')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>
        <div class="input-field col m6 s12">
          <input name="amount" id="amount" :value="old('amount')" type="text" required>
          <label for="amount">Amount</label>
        @error('amount')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>
      </div>
      <div class="row">
                <fieldset class="collection">
                  <legend><h6 class="card-title">
                  &nbsp;&nbsp;Donation Mode&nbsp;&nbsp;
                </h6></legend>
                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_status" value="1" id="cash" type="radio"/>
                      <span>Cash</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_status" value="2" id="pos" type="radio"/>
                      <span>POS</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_status" value="3" id="transfer" type="radio"/>
                      <span>Transfer</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_status" value="4" id="pledge" type="radio"/>
                      <span>Pledge</span>
                    </label>
                  </p>
                </div>
        
      </div>
      <div class="progress collection">
        <div id="preloader2" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

    <div class="modal-footer">
      <a href="#!" class="modal-action waves-effect waves-green btn-large">Add Donation</a>
      <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>
</div>
<!-- /End Modal -->