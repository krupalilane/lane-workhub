// Stop the carousel from auto sliding
$('#carousel-default').carousel({
  interval: false
});
$('#announcements_carousel').carousel({
  interval: false
});
$('#modal_announcements_carousel').carousel({
  interval: false
});
// Stop carousel from looping
$('#carousel-default').on('slid.bs.carousel', function() {
  var $this = $(this);

  // Check if the last item is active
  if ($('.carousel-inner .item:last').hasClass('active')) {
    $this.find('.right.carousel-control').hide(); // Hide the next button
  } else {
    $this.find('.right.carousel-control').show(); // Show the next button
  }

  // Check if the first item is active
  if ($('.carousel-inner .item:first').hasClass('active')) {
    $this.find('.left.carousel-control').hide(); // Hide the previous button
  } else {
    $this.find('.left.carousel-control').show(); // Show the previous button
  }
});
$('#holiday_year').change(function() {
   var year  = $(this).val();
   get_all_holiday(year);
});
$(document).on('click', '#view_all_holiday', function(e) {
  var year = $('#holiday_year').val();
  get_all_holiday(year);
  $('#all_holiday_list').modal('show');
});
$(document).on('click', '.read_more', function(e) {
  var active_annoucement = $(this).data('active_id');
  $('#active_annoucement_'+active_annoucement).addClass('active');
  $('#all_annoucement_modal').modal('show');
});
function get_all_holiday(year) {
  $("#overlay").fadeIn(300);
  $.ajax({
    url : get_all_holiday_url,
    type: "POST",
    data: {'year':year},
    success : function(data){
      var tbody = '';
      $.each(data, function(key, items) {
        if (key % 2 === 0) {
          if (key > 0) {
            tbody += '</tr>'; // Close the previous row
          }
          tbody += '<tr>'; // Start a new row
        }

        // Construct the holiday item
        if (items.MarkAsGrey == 1) {
          var holiday_item = '<td class="holiday-pass">';
        }else{
          var holiday_item = '<td>';
        }
        
        holiday_item += '<div class="holiday-cal">';
        holiday_item += '<div class="holiday-month">' + items.MonthName + '</div>';
        holiday_item += '<div class="holiday-date">' + items.Day + '</div>';
        holiday_item += '</div>';
        holiday_item += '</td>';
        if (items.MarkAsGrey == 1) {
          holiday_item += '<td class="holiday-pass pl-20">';
        }else{
          holiday_item += '<td class="pl-20">';
        }
        holiday_item += '<div class="holiday-name">' + items.HolidayName + '</div>';
        holiday_item += '<div class="holiday-day">' + items.WeekDay + '</div>';
        holiday_item += '</td>';

        // Add holiday item to the current row
        tbody += holiday_item;
      });

      // Close the last row
      tbody += '</tr>';

      $('#all_holiday_body').html(tbody);
      $("#overlay").fadeOut(300);
    }
  });
}
$(document).ready(function(){
  $('#weather-loader').show();
  $.ajax({
    url: get_all_weather_url,
    method: 'GET',
    dataType: 'json',
    success: function(weatherData) {
      var counter = 0;
      var weatherHTML = '<div class="location-row">'; // Start the first row

      $.each(weatherData, function(location, data) {
          var imageSrc = weather_baseURL + data.weather_image;
          
          // Add location box
          weatherHTML += '<div class="col-sm-4 location-box">' +
            '<div><b>' + location + '</b></div>' +
            '<div class="clock" id="clock_' + counter + '">' + data.current_time + '</div>' +
            '<div>' + data.temperature + '°F <img src="' + imageSrc + '" alt="Weather" title="' + data.weather_name + '"></div>' +
            '</div>';

          counter++;

          // After every 3 location boxes, close the row and start a new one
          if (counter % 3 === 0) {
              weatherHTML += '</div><div class="location-row">';
          }
      });

      // Close any unclosed row at the end (if there are less than 3 items in the last row)
      if (counter % 3 !== 0) {
          weatherHTML += '</div>';
      }

      $('#weather_data_time').append(weatherHTML);
      $('#weather-loader').hide();
      startClocks();
    }
  });
  function startClocks() {
    $('.clock').each(function(){
      let initialTime = $(this).text().trim(); // Get the initial time from the element's text
      let timeArray = initialTime.split(/[: ]/);
      let hours = parseInt(timeArray[0]);
      let minutes = parseInt(timeArray[1]);
      let seconds = parseInt(timeArray[2]);
      let ampm = timeArray[3];

      function updateClock() {
          seconds++;
          if (seconds >= 60) {
              seconds = 0;
              minutes++;
          }
          if (minutes >= 60) {
              minutes = 0;
              hours++;
          }
          if (hours > 12) {
              hours = 1;
          } else if (hours === 12 && minutes === 0 && seconds === 0) {
              ampm = (ampm === 'AM') ? 'PM' : 'AM';
          }

          let h = hours < 10 ? '0' + hours : hours;
          let m = minutes < 10 ? '0' + minutes : minutes;
          let s = seconds < 10 ? '0' + seconds : seconds;

          $(this).text(h + ':' + m + ':' + s + ' ' + ampm);
      }

      setInterval(updateClock.bind(this), 1000); // Update the clock every second
      updateClock.call(this); // Initial call to display the time immediately
    });
  }    
});