
<style>
       .switch-holder {
    display: flex;
    padding: 10px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    border:solid 2px #bdbdbd;
    /*box-shadow: -8px -8px 15px rgba(255,255,255,.7),
                10px 10px 10px rgba(0,0,0, .3),
                inset 8px 8px 15px rgba(255,255,255,.7),
                inset 10px 10px 10px rgba(0,0,0, .3);*/
    justify-content: space-between;
    align-items: center;
}

.switch-label {
    width: 150px;
}

.switch-label i {
    margin-right: 5px;
}

.switch-toggle {
    height: 40px;
}

.switch-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.switch-toggle input[type="checkbox"] + label {
    position: relative;
    display: inline-block;
    width: 140px;
    height: 40px;
    border-radius: 20px;
    margin: 0;
    cursor: pointer;
    border:solid 2px #bdbdbd;
    padding-bottom: 10px;
    /*box-shadow: inset -8px -8px 15px rgba(255,255,255,.6),
                inset 10px 10px 10px rgba(0,0,0, .25);*/
    
}

.switch-toggle input[type="checkbox"] + label::before {
    position: absolute;
    content: 'YEAR';
    color: #fff;
    font-size: 13px;
    text-align: center;
    line-height: 25px;
    top: 6px;
    left: 8px;
    width: 60px;
    height: 25px;
    border-radius: 20px;
    background-color: #bdbdbd;
   /* box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px rgba(0,0,0, .25);
    transition: .3s ease-in-out;*/
}

.switch-toggle input[type="checkbox"]:checked + label::before {
    left: 50%;
    content: 'EVENT';
    color: #fff;
    background-color: #7e57c2;
    /*box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px #00b33c;*/
}
    </style>

<!-- Start Modal -->
<div id="config_overview-modal" class="modal form-body" style="padding:1em;">
    <div class="modal-content">
      <div class="row">
        <h6 class="card-title left">Config Data for Year/Event</h6>
        <a href="javascript:void(0)" class="right modal-close"><i class="material-icons grey-text">close</i></a>
      </div>
      
      <div class="progress collection">
        <div id="displayDonation-preloader" class="indeterminate" style="display:none; 
        border:2px #9E9E9E solid"></div>
      </div>

      <form method="POST" action="{{ route('updateDonationDisplaySetting') }}">
        <!-- <form method="POST" action="{{ route('save.event') }}"> -->
        @csrf
    <div class="row">
    <div class="left">

       <div class="switch-holder">
            <div class="switch-label">
                <i class="material-icons" style="font-size: 2.5em; margin-top: 10px; color: #bdbdbd;">event</i>
            </div>
            <div class="switch-toggle">
                <!-- <input type="checkbox" id="event"> -->
                <input type="checkbox" id="event" name="display_by_event" value="1" {{ config('displayDonation.display_donations_by_event') ? 'checked' : '' }}>
                <label for="event"></label>
            </div>
        </div>
    </div>

        <button  id="submitBtn" type="submit" class="right modal-action waves-effect waves-green btn-large">Save
        </button>

    </div>

    <!-- <div class="modal-footer"> -->
      <!-- <div class="row">
    <div class="col s8">
      </div>
    </div> -->
</form>
</div>
</div>
<!-- </div> -->
<!-- /End Modal -->