const selection = document.getElementById('selection');
const singleAppointment = document.getElementById('singleAppointment');
const rangeAppointment = document.getElementById('rangeAppointment');

selection.addEventListener('change', function () {
  if (selection.value === 'single') {
    singleAppointment.style.display = 'block';
    rangeAppointment.style.display = 'none';
  } else if (selection.value === 'range') {
    singleAppointment.style.display = 'none';
    rangeAppointment.style.display = 'block';
  }
});
