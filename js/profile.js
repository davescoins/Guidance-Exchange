$(document).ready(function () {
  $('.profile-section').each(function () {
    var upperContainer = $(this);
    var container = upperContainer.find('.profile-wrap');
    var textEnd = upperContainer.find('.text-end');

    // Check if content overflows horizontally
    if (container[0].scrollHeight > container.outerHeight()) {
      // Create and append the additional div
      var newDiv = $('<div class="open-link">').html(
        '<div class="expand-btn"><i class="fa-solid fa-plus"></i></div>'
      );
      textEnd.append(newDiv);
    }
  });
});

// This function is used to expand the profile sections to allow for additional content
$(document).ready(function () {
  $('.expand-btn').click(function () {
    var section = $(this).closest('.profile-section');
    var wrap = section.find('.profile-wrap');
    var icon = section.find('.profile-icon');

    if (wrap.css('height') == '110px') {
      wrap.css('height', 'auto');
      var autoHeight = wrap.height();
      wrap.css('height', '110px');
      wrap.animate(
        {
          height: autoHeight,
        },
        1000
      );
      icon.animate(
        {
          height: autoHeight,
        },
        1000
      );
      $(this).html('<i class="fa-solid fa-minus"></i>');
    } else {
      wrap.animate(
        {
          height: '110px',
        },
        1000
      );
      icon.animate(
        {
          height: '110px',
        },
        1000
      );
      $(this).html('<i class="fa-solid fa-plus"></i>');
    }
  });
});

// This function is used to open the time selection modals on the mentor profile page
function openModal(modalId) {
  const projectsModal = new bootstrap.Modal(document.getElementById(modalId));
  projectsModal.show();
}

$(document).ready(function () {
  $('form').submit(function (event) {
    var checkedBoxes = $(this).find('input[type=checkbox]:checked');
    if (checkedBoxes.length > 1) {
      alert('Only one appointment can be selected.');
      event.preventDefault(); // Prevent form submission
    }
  });
});
