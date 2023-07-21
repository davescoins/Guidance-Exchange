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

$(document).ready(function () {
  $('#uploadButton').click(function () {
    var formData = new FormData($('#pictureUpload')[0]);

    $.ajax({
      url: 'profile-picture.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        $('#response').html(data);
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  // Prevent form submission and page reload
  $('#pictureUpload').submit(function (event) {
    event.preventDefault();
  });
});
