@php
$active_donors = getRegisteredDonors();
@endphp

<!-- Start Modal -->
<div id="add-donation-modal" class="modal" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title" style="display:inline-block;">Add Donation for {{ getCurrentEventName() }}</h6>&nbsp;&nbsp;<span class="chip right">Registered Donation</span>

      <div class="progress collection">
        <div id="preloader" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>
      
      <form id="regDonationForm" method="POST" action="{{ route('save.reg_donation') }}">
        @csrf

      <div class="row">
      <div class="input-field col s12 m6">
      <select name="donor_id">
        <option value="" disabled selected>Select Donor</option>
        @foreach($active_donors as $donor)
        <option value="{{ $donor->id }}">{{ $donor->username }}</option>
        @endforeach
      </select>
      <label>Select Donor</label>
    </div>    

        <div class="input-field col m6 s12">
          <input name="amount"  id="currency-demo" :value="old('amount')" type="text" required>
          <label  for="currency-demo">Amount</label>
        @error('amount')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>
    </div>
    
      <div class="row">

        <div class="input-field col s12 m6 l8">
          <input name="purpose" id="purpose" :value="old('purpose')" type="text" class="autocomplete" required>
          <label for="purpose">Purpose/Item</label>
        @error('purpose')
        <small class="errorTxt3  red-text">{{ $message }}*</small>
        @enderror 
        </div>

        <div class="input-field col s12 m6 l4">
          <input name="slip_no" id="slip_no" :value="old('slip_no')" type="text" class="autocomplete" required>
          <label for="slip_no">Slip number</label>
        @error('slip_no')
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
                      <input name="payment_mode" value="1" id="cash" type="radio"/>
                      <span>Cash</span>
                    </label>
                  </p>
                </div>

                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_mode" value="2" id="pos" type="radio"/>
                      <span>POS</span>
                    </label>
                  </p>
                </div>

                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_mode" value="3" id="transfer" type="radio"/>
                      <span>Transfer</span>
                    </label>
                  </p>
                </div>

                <div class="input-field col s12 m3">
                  <p>
                    <label>
                      <input name="payment_mode" value="4" id="pledge" type="radio"/>
                      <span>Pledge</span>
                    </label>
                  </p>
                </div>
        
      </div>
    <div class="modal-footer">
      <button id="submitBtn" type="submit" onclick="ShowPreloader()" class="modal-action waves-effect waves-green btn-large" >Add Donation</button>
      <a id="reload" href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>
</div>
<!-- /End Modal -->