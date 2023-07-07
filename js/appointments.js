var app = {
  settings: {
    container: $('.calendar'),
    calendar: $('.front'),
    days: $('.weeks span'),
    form: $('.back'),
    input: $('.back input'),
    buttons: $('.back button'),
    infoDate: $('.back .info-date'),
    infoTime: $('.back .info-time span'),
    address: $('.back .address span'),
    observations: $('.back .observations span'),
  },

  init: function () {
    instance = this;
    settings = this.settings;
    this.bindUIActions();
  },

  swap: function (currentSide, desiredSide) {
    settings.container.toggleClass('flip');

    currentSide.fadeOut(900);
    currentSide.hide();
    desiredSide.show();
  },

  updateInfo: function (date) {
    settings.infoDate.text(date);

    // Replace the following lines with your own logic to fetch the data dynamically
    var time = '6:35 PM';
    var address = '129 W 81st St, New York, NY';
    var observations = 'Be there 15 minutes earlier';

    settings.infoTime.text(time);
    settings.address.text(address);
    settings.observations.text(observations);
  },

  bindUIActions: function () {
    settings.days.on('click', function () {
      var clickedDate = $(this).text();
      instance.updateInfo(clickedDate);
      instance.swap(settings.calendar, settings.form);
      settings.input.focus();
    });

    settings.buttons.on('click', function () {
      instance.swap(settings.form, settings.calendar);
    });
  },
};

app.init();
