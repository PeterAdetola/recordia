
      <!-- tabs  -->
      <div class="card-panel">
        <ul class="tabs">
          <li class="tab">
            <a href="#create_year" class="{{ ($tab == 'create_year')? 'active' : '' }}">
              <i class="material-icons">book</i>
              <span>Instruction</span>
            </a>
          </li>
          <li class="tab">
            <a href="#activate_event" class="{{ ($tab == 'activate_event')? 'active' : '' }}">
              <i class="material-icons">event_note</i>
              <span>Events</span>
            </a>
          </li>
          <li class="tab">
            <a href="#edit_event" class="{{ ($tab == 'edit_event')? 'active' : '' }}">
              <i class="material-icons">border_color</i>
              <span>Edit Event</span>
            </a>
          </li>
        </ul>
      </div>