/*================================================================================
	Custom scripts per pages
================================================================================*/

/*
Custom script for Instant payment page
 *
 */


      // Verification Script
      const pledgeButton = document.getElementById("pledge");
      const paidButton = document.getElementById("paid");
      const checkbox = document.getElementById("verified");
      // const checkbox1 = document.querySelector('input[type="checkbox"]');
      const checkboxText = checkbox.nextElementSibling;

      pledgeButton.addEventListener("click", function(){
        checkbox.checked = false;
        checkbox.disabled = true;
      })

      paidButton.addEventListener("change", function(){
        checkbox.disabled = false;

      // checkboxText.addEventListener("change", function(){
      //     if(checkbox1.checked){
      //       checkboxText.style.color = 'red';
      //     } else {
      //       checkboxText.style.color = 'green';          
      //     }
      //   });

      });


      // Preloader Script
      function ShowPreloader() {
        document.getElementById('preloader').style.display = "block";
        document.getElementById('preloader2').style.display = "block";
      }


      // Form validation to prevent record of donors without phone number
      const donationForm = document.getElementById("donationForm");
      const pledgeButtons = document.getElementsByName("pledge");
      const phoneNo = document.getElementById("phone");

      myForm.addEventListener("submit", (event) => {
      // Prevent the form from submitting by default
      event.preventDefault();

      // let radioChecked = false;

      // Check if at least one radio button is checked
      // for (let i = 0; i < myRadioButtons.length; i++) {
      //   if (myRadioButtons[i].checked) {
      //     radioChecked = true;
      //     break;
      //   }
      // }

       // Check if the required field is filled based on the selected radio button value
        // if (radioChecked) {
          const selectedValue = document.querySelector('input[name="pledge"]:checked').value;
          if (selectedValue === "pledge" && phoneNo.value === "") {
            alert("The phone number is required when pledge is selected.");
            return;
          }
        // } 
        // else {
        //   alert("Please select a radio button.");
        //   return;
        // }

        // Submit the form if all validations pass
        myForm.submit();
      });
