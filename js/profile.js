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
