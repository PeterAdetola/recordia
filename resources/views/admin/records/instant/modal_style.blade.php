
<style>
.loader {
  border: 2px solid #f3f3f3;
  border-radius: 50%;
  border-top: 2px solid #3498db;
  width: 20px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.btn-large--loading::after {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    border: 2px solid #ca5b82; /* long */
    border-top: 2px solid #f6e5f0; /* short */
    border-radius: 60%;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
/*    animation: button-loading-spinner 1s ease infinite;*/
}

.text {
/*    font: bold 20px 'Quicksand', san-serif;*/
/*    color: #ffffff;*/
/*    visibility: 0;*/
/*    display: none;*/
    transition: all 0.2s;
}
</style>