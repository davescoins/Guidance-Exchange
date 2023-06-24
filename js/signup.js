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
    if (userType == "1") {
        mentorOnlyRow.innerHTML = mentorOnlySection;
    } else {
        mentorOnlyRow.innerHTML = "";
    }
    console.log(userType);
};

// function updateSkills() {
//     const userSkills = document.getElementById('Skills');
//     const selectedSkillsContainer = document.getElementById('selectedSkills');
//     selectedSkillsContainer.innerHTML = '';
//     for (var option of userSkills.options) {
//         if (option.selected) {
//             // Create a chip for it
//             selectedSkillsContainer.innerHTML += `
//                 <button class="btn btn-secondary rounded-pill skillSelection" onclick="removeSkill('${option.value}')">${option.text} x</button>
//             `;
//         }
//     }
// }

// function removeSkill(currentSkill) {
//     const userSkills = document.getElementById('Skills');
//     console.log(currentSkill)
//     for (var option of userSkills.options) {
//         if (option.value == currentSkill) {
//             // De-select the skill
//             option.selected = false;
//         }
//     }
//     updateSkills();

// }

// Skills
$(document).ready(function () {
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      renderChoiceLimit: 5,
    });
  });

  
  