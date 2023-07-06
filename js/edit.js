// This function discards the changes made on the profile edit page
document.getElementById('confirm').addEventListener('click', function () {
  var userID = this.getAttribute('data-userid');
  window.location.href = 'profile.php?profileID=' + userID;
});

$(document).ready(function () {
  var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
    removeItemButton: true,
    renderChoiceLimit: 5,
  });
});
