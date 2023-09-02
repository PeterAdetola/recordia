
      <div id="general">
        <div class="card-panel">
          <div class="display-flex">
            <div class="media">
              <img src="../../../app-assets/images/avatar/avatar-12.png" class="border-radius-4" alt="profile image"
                height="64" width="64">
            </div>
            <div class="media-body">
              <div class="general-action-btn">
                <button id="select-files" class="btn indigo mr-2">
                  <span>Upload new photo</span>
                </button>
                <button class="btn btn-light-pink">Reset</button>
              </div>
              <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
              <div class="upfilewrapper">
                <input id="upfile" type="file" />
              </div>
            </div>
          </div>
          <div class="divider mb-1 mt-1"></div>
          <form class="formValidate" method="get">
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <label for="uname">Username</label>
                  <input type="text" id="uname" name="uname" value="hermione007" data-error=".errorTxt1">
                  <small class="errorTxt1"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="name">Name</label>
                  <input id="name" name="name" type="text" value="Hermione Granger" data-error=".errorTxt2">
                  <small class="errorTxt2"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="email">E-mail</label>
                  <input id="email" type="email" name="email" value="granger007@hogward.com" data-error=".errorTxt3">
                  <small class="errorTxt3"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="card-alert card orange lighten-5">
                  <div class="card-content orange-text">
                    <p>Your email is not confirmed. Please check your inbox.</p>
                    <a href="javascript: void(0);">Resend confirmation</a>
                  </div>
                  <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="company" type="text">
                  <label for="company">Company Name</label>
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2">
                  Save changes
                </button>
                <button type="button" class="btn btn-light-pink waves-effect waves-light mb-1">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>