<table class="table"    >
  <tbody>
    <tr>
      <th>Name</th>
      <td>
        <div class="container-fluid">
          <input type="text" class="form-control" placeholder="Add name">
        </div>
      </td>
    </tr>
    <tr>
      <th>Description</th>
      <td>
        <div class="container-fluid">
          <input type="text" class="form-control" placeholder="Add Description">
        </div>
      </td>
    </tr>
    </tbody>
</table>
<table class="table">
  <tbody>
    <tr>
      <th>Select date</th>
      <td>
        <input id="start_date" name="start_date" class="form-control" readonly placeholder="Enter Start date">
      </td>
      <td>
        <input id="end_date" name="end_date" class="form-control" readonly placeholder="Enter End date">
      </td>
    </tr>
    <tr>
      <th>Select time</th>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<script>
  // Initialize AirDatepicker for start date
  new AirDatepicker('#start_date', {
    autoClose: true,
    position({$datepicker, $target, $pointer}) {
      let coords = $target.getBoundingClientRect(),
          dpHeight = $datepicker.clientHeight,
          dpWidth = $datepicker.clientWidth;

      let top = coords.y + coords.height / 2 + window.scrollY - dpHeight / 2;
      let left = coords.x + coords.width / 2 - dpWidth / 2;

      $datepicker.style.left = `${left}px`;
      $datepicker.style.top = `${top}px`;

      $pointer.style.display = 'none';
    },
    buttons: ['clear'],
    dateFormat: 'yyyy-MM-dd',
    locale: {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'yyyy-MM-dd',
      timeFormat: 'HH:mm', // Corrected time format
      firstDay: 0
    }
  });

  // Initialize AirDatepicker for end date
  new AirDatepicker('#end_date', {
    autoClose: true,
    position({$datepicker, $target, $pointer}) {
      let coords = $target.getBoundingClientRect(),
          dpHeight = $datepicker.clientHeight,
          dpWidth = $datepicker.clientWidth;

      let top = coords.y + coords.height / 2 + window.scrollY - dpHeight / 2;
      let left = coords.x + coords.width / 2 - dpWidth / 2;

      $datepicker.style.left = `${left}px`;
      $datepicker.style.top = `${top}px`;

      $pointer.style.display = 'none';
    },
    buttons: ['clear'],
    dateFormat: 'yyyy-MM-dd',
    locale: {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'yyyy-MM-dd',
      timeFormat: 'HH:mm', // Corrected time format
      firstDay: 0
    }
  });
</script>
