$(document).ready(function () {
  // Call fetchMessages() when the page loads
  var senderID = $('#firstUser').find('.userID').text();
  fetchMessages(senderID);

  // Click event handler for the list items
  $('.list-group-item').click(function (event) {
    event.preventDefault();
    $('.list-group-item').removeClass('active');
    $(this).addClass('active');
    senderID = $(this).find('.userID').text();
    $('#recipientID').val(senderID);
    // Fetch and display the message chain for the selected sender
    fetchMessages(senderID);
  });

  // Submit message form
  $('#message-form').submit(function (event) {
    event.preventDefault();
    var messageInput = $('#message-form input[type="text"]');
    var message = messageInput.val();
    var recipientIDInput = $('#message-form input[type="hidden"]');
    var recipientID = recipientIDInput.val();
    if (message.trim() !== '') {
      sendMessage(message, recipientID);
      messageInput.val(''); // Clear the input field
    }
  });

  // Delete message form
  $(document).on('submit', '.delete-form', function (event) {
    event.preventDefault();
    var deleteInput = $(this).find('input[type="hidden"]');
    var messageID = deleteInput.val();
    deleteMessage(messageID);
  });

  // Function to fetch and display the message chain for the selected sender
  function fetchMessages(senderID) {
    // Make an AJAX request to fetch the message chain for the selected sender
    $.ajax({
      url: 'fetch-messages.php',
      type: 'POST',
      dataType: 'json',
      data: { senderID: senderID },
      success: function (response) {
        if (response.success) {
          var messageTitle = response.messageTitle;
          var messages = response.messages;
          // Update the UI with the message chain for the selected sender
          $('.message-title').html(messageTitle);
          $('.messages').html(messages);
        } else {
          // Error occurred while fetching the message chain
        }
      },
      error: function () {
        // Error occurred during the AJAX request
      },
    });
  }

  setInterval(function () {
    fetchMessages(senderID);
  }, 3000); // Update every 3 seconds

  $(document).ready(function () {
    $(document).on('mouseenter', '.message-body-right', function () {
      var deleteForm = $(this).find('.delete-form');
      deleteForm.append(
        '<button type="submit" class="hover-div btn px-0 m-0 pt-2"><i class="fa-solid fa-trash-can"></i></button>'
      );
    });

    $(document).on('mouseleave', '.message-body-right', function () {
      var deleteForm = $(this).find('.delete-form');
      deleteForm.find('.hover-div').remove();
    });
  });

  // Function to send a message
  function sendMessage(message, recipientID) {
    // Make an AJAX request to send the message
    $.ajax({
      url: 'send-message.php',
      type: 'POST',
      data: { message: message, recipientID: recipientID },
      success: function (response) {
        if (response.success) {
          // Message sent successfully
          // You can update the UI here if needed
        } else {
          // Error occurred while sending the message
        }
      },
      error: function () {
        // Error occurred during the AJAX request
      },
    });
  }

  // Function to delete a message
  function deleteMessage(messageID) {
    // Make an AJAX request to send the message
    $.ajax({
      url: 'delete-message.php',
      type: 'POST',
      data: { messageID: messageID },
      success: function (response) {
        if (response.success) {
          // Message sent successfully
          // You can update the UI here if needed
        } else {
          // Error occurred while sending the message
        }
      },
      error: function () {
        // Error occurred during the AJAX request
      },
    });
  }
});

$(document).ready(function () {
  var $searchInput = $('#recipientName');
  var $dropdown = $(
    '<ul class="dropdown-menu" id="messageSearchResults"></ul>'
  );

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
    var hiddenInput = $('<input>').attr({
      type: 'hidden',
      name: 'recipientID',
      value: userID,
    });
    $('#newMessage').append(hiddenInput);
    $dropdown.empty().hide();
  });
});
