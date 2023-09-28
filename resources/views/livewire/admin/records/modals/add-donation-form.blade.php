<div>
<!-- Start Modal -->
<div id="add-donation-modal" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Add Donation</h6>
      <form id="donationForm"  wire:submit="saveDonation">
        @csrf
      <div class="row">

        <div class="input-field col m6 s12">
          <input wire:model="name" id="fullname" :value="old('fullname')" type="text" required/>
          <label for="fullname">Name</label>
            @error('name')
            <small class="errorTxt3  red-text">{{ $message }}*</small>
            @enderror 
        </div> 

        <div class="input-field col m6 s12">
          <input wire:model="phone" id="phoneNo" :value="old('phone')" type="text">
          <label for="phone">Phone Number</label>
          @error('phone')
          <small class="errorTxt3  red-text">{{ $message }}*</small>
          @enderror 
        </div>

      </div>
    
      <div class="row">

        <div class="input-field col m6 s12">
          <input wire:model="purpose" id="purpose" :value="old('purpose')" type="text" class="autocomplete" required>
          <label for="purpose">Purpose/Item</label>
        @error('purpose')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>

        <div class="input-field col m6 s12">
          <input wire:model="amount"  id="currency-demo" :value="old('amount')" type="text" required>
          <label  for="currency-demo">Amount</label>
        @error('amount')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>

      </div>
      <div id="message" class="chip center red-text" style="display:none;">Please provide phone number for pledge<i class="close material-icons">close</i></div>
      <div class="row">

            <fieldset class="collection">
              <legend><h6 class="card-title">
              &nbsp;&nbsp;Mode of Payment&nbsp;&nbsp;
            </h6></legend>

            <div class="input-field col s12 m3">
              <p>
                <label>
                  <input class="payment_mode" wire:model="payment_mode" value="1" id="cash" type="radio"/>
                  <span>Cash</span>
                </label>
              </p>
            </div>

            <div class="input-field col s12 m3">
              <p>
                <label>
                  <input class="payment_mode" wire:model="payment_mode" value="2" id="pos" type="radio"/>
                  <span>POS</span>
                </label>
              </p>
            </div>

            <div class="input-field col s12 m3">
              <p>
                <label>
                  <input class="payment_mode" wire:model="payment_mode" value="3" id="transfer" type="radio"/>
                  <span>Transfer</span>
                </label>
              </p>
            </div>

            <div class="input-field col s12 m3">
              <p>
                <label>
                  <input class="payment_mode" wire:model="payment_mode" value="4" id="pledge" type="radio"/>
                  <span>Pledge</span>
                </label>
              </p>
            </div>
          </fieldset>
        
      </div>

      <div class="progress collection">
        <div id="preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
    <div class="modal-footer">
      <button id="submitBtn" type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large" >Add Donation</button>
      <a id="reload" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>
</div>
<!-- /End Modal -->
</div>