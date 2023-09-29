

<!-- Start Modal -->
<div id="add-expense-modal" class="modal border-radius-10" style="padding:1em;">
    <div class="modal-content">
      <h6 class="card-title">Add Expense</h6>
      
      <div class="progress collection">
        <div id="preloader2" class="indeterminate"  style="display:none; 
        border:2px #ebebeb solid"></div>
      </div>

      <form id="expenseForm" method="POST" action="{{ route('save.expense') }}">
        @csrf
      <input type="hidden" value="{{ getCurrentUser() }}" name="recorder_id">
      <input type="hidden" value="{{ getCurrentYear() }}" name="year">
      <input type="hidden" value="0" name="transaction">
      <div class="row">
        <div class="input-field col m6 s12">
          <input name="name" id="fullname" :value="old('fullname')" type="text" required/>
          <label for="fullname">Name</label>
            @error('name')
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

    <div class="modal-footer">
      <button onclick="ShowPreloader()" type="submit" class="modal-action waves-effect waves-green btn-large">Add Expense</button>
      <a href="javascript:void(0)" class="btn-large btn-flat modal-close">Cancel</a>
    </div>
</form>
  </div>
</div>
<!-- /End Modal -->