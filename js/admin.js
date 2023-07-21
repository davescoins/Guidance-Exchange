const selection = document.getElementById('selection');
const formDiv = document.getElementById('formDiv');

selection.addEventListener('change', function () {
  var existingUser = `<div id="existing">
  <div class="mb-3">
    <label for="existingUser" class="col-form-label">User Search</label>
    <div class="dropdown" id="userSearch">
      <input type="text" class="form-control" id="existingUser" placeholder="Search for a user" name="existingUser" autocomplete="off" required>
      <ul class="dropdown-menu" id="userSearchResults"></ul>
    </div>
  </div>
</div>
<button type="submit" class="btn main-button">Create</button>`;

  var newUser = `<div id="new">
<div class="mb-3">
  <label for="firstName" class="form-label">First Name</label>
  <input type="text" class="form-control" id="firstName" name="firstName" required>
</div>
<div class="mb-3">
  <label for="lastName" class="form-label">Last Name</label>
  <input type="text" class="form-control" id="lastName" name="lastName" required>
</div>
<div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input type="text" class="form-control" id="username" name="username" required>
</div>
<div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control" id="password" name="password" required>
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control" id="email" name="email" required>
</div>
<div class="mb-3">
  <label for="tel" class="form-label">Phone Number</label>
  <input type="tel" class="form-control" id="tel" name="tel" required>
</div>
</div>
<button type="submit" class="btn main-button">Create</button>`;
  if (selection.value === 'existing') {
    formDiv.innerHTML = existingUser;
  } else if (selection.value === 'new') {
    formDiv.innerHTML = newUser;
  } else if (selection.value === 'null') {
    formDiv.innerHTML = '';
  }
});

$(document).on('keydown', '#existingUser', function () {
  var $searchInput = $('#existingUser');
  var $dropdown = $('<ul class="dropdown-menu" id="userSearchResults"></ul>');

  $searchInput.after($dropdown);

  $searchInput.keyup(function () {
    var searchText = $(this).val();
    if (searchText != '') {
      $.ajax({
        url: 'recipient-search.php',
        method: 'post',
        data: { query: searchText },
        success: function (response) {
          $dropdown.html(response).show();
        },
      });
    } else {
      $dropdown.empty().hide();
    }
  });

  $(document).on('click', '.dropdown-item', function () {
    var resultText = $(this).text();
    var userID = $(this).data('userid');
    $searchInput.val(resultText);

    var existingInput = $('#userID');
    if (existingInput.length > 0) {
      existingInput.val(userID);
    } else {
      var hiddenInput = $('<input>').attr({
        type: 'hidden',
        name: 'userID',
        value: userID,
        id: 'userID',
      });
      $('#userSearch').append(hiddenInput);
    }

    $dropdown.empty().hide();
  });
});
