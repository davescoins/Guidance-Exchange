const selection = document.getElementById('selection');
const existingUser = document.getElementById('existing');
const newUser = document.getElementById('new');

selection.addEventListener('change', function () {
  if (selection.value === 'existing') {
    existingUser.style.display = 'block';
    newUser.style.display = 'none';
  } else if (selection.value === 'new') {
    existingUser.style.display = 'none';
    newUser.style.display = 'block';
  }
});

$(document).ready(function () {
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
