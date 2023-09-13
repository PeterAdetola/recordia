/*================================================================================
	Custom scripts for the dashboard
================================================================================*/
 

/**
 *  Prevent pledge donation without phone number
 */

const form = document.getElementById('donationForm');
const pledgeBtn = document.querySelector('input[name="payment_mode"][value="4"]'); 
const radios = document.querySelectorAll('input[name="payment_mode"]'); 
const phoneNumber = document.querySelector('#phone');
const submitButton = document.querySelector('button[type="submit"]');
const message = document.querySelector('#message');

// Function to show/hide message
function toggleMessage(show) {
  if(show) {
    message.style.display = 'block';
  } else {
    message.style.display = 'none'; 
  }
}

function validateForm() {

  let isValid = true;

  // Check if specific radio is checked and phone empty
  if(pledgeBtn.checked && !phoneNumber.value) {
    isValid = false;
  }

  // Check if any other radio is checked  
  radios.forEach(radio => {
    if(radio !== pledgeBtn && radio.checked) {
      isValid = true;
    }
  });

  // Toggle submit based on validity
  if(isValid) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true; 
  }

  // Toggle message
  toggleMessage(!isValid);

}

radios.forEach(radio => {

  radio.addEventListener('change', validateForm);

});

phoneNumber.addEventListener('input', validateForm);

// Add event listener to radio change
pledgeBtn.addEventListener('change', function() {

  // Check if radio is checked and phone is empty
  if(this.checked && !phoneNumber.value) {

    // Disable submit button
    submitButton.disabled = true;
    toggleMessage(true);

  } else {

    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);
  }

});

// Add event listener to phone number input
phoneNumber.addEventListener('input', function() {

  // Check radio is checked and phone has value  
  if(pledgeBtn.checked && this.value) {

    // Re-enable submit button
    submitButton.disabled = false;
    toggleMessage(false);

  } else if(pledgeBtn.checked && !this.value) {

    // Disable submit button  
    submitButton.disabled = true;
    toggleMessage(true);
  }

});



/**
 *  Initialize datatable
 */

    $('#multi-select').DataTable({
    responsive: true,
    "paging": false,
    "ordering": false,
    "info": false,
    "columnDefs": [{
      "visible": false,
      "targets": 1
    }],
  });



/**
 *  Multiselect checkboxes
 */

  var table = document.getElementById('multi-select');
  var headerCheckbox = table.querySelector('thead input[type="checkbox"]');
  var checkboxes = table.querySelectorAll('tbody input[type="checkbox"]');

  headerCheckbox.addEventListener('change', function() {
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = headerCheckbox.checked;
    });
  });



/**
 *  Validate checkbox submit
 */

const checkboxes2 = document.querySelectorAll('table input[type="checkbox"]');
// const submitBtn = document.getElementById('submitBtn');
const submitBtn2 = document.getElementById('submitBtn2');

checkboxes2.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const checkedCheckboxes = document.querySelectorAll('table input[type="checkbox"]:checked');
        submitBtn.disabled = checkedCheckboxes.length === 0;
        submitBtn2.disabled = checkedCheckboxes.length === 0;
    });
});



/**
 *  Determine amount to verify
 */

$(document).ready(function() {
  $('#submitBtn2').click(function(e) {
    
    // Count the total number of checkboxes in the table
    var totalCheckboxes = $('input.data-checkbox').length;

    // Count the checked checkboxes
    var checkedCheckboxes = $('input.data-checkbox:checked').length;

     // Determine the state based on the counts
    var state;
    if (checkedCheckboxes === 1) {
      state = "a donor";
    } else if (checkedCheckboxes === totalCheckboxes) {
      state = "all donors";
    } else {
      var count = $('input.data-checkbox:checked').length;
      state = count+' donors';
    }
    
    // Display the count
    $('#checkbox-count').text(state);

  });
});