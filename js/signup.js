var mentorOnlySection = `
            <div class="col-12">
                <label for="mentoringDetails" class="form-label text-signup-label">Mentoring</label>
                <textarea rows="3" class="form-control" id="mentoringDetails" name="mentoringDetails" placeholder="Provide a short bio about your mentoring experience." > </textarea>
            </div>
            <div class="col-6 py-2">

                <label for="mentoringUpload" class="form-label text-signup-label">Mentoring Verification</label>
                <input type="file" class="form-control" id="mentoringUpload" name="mentoringUpload" placeholder="Upload resume">
            </div>`;

function toggleFields() {
  const userType = document.getElementById('userType').value;
  //
  const mentorOnlyRow = document.getElementById('mentorOnlySection');
  if (userType == '1') {
    mentorOnlyRow.innerHTML = mentorOnlySection;
  } else {
    mentorOnlyRow.innerHTML = '';
  }
  console.log(userType);
}

// Skills
$(document).ready(function () {
  var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
    removeItemButton: true,
    renderChoiceLimit: 5,
  });
});
