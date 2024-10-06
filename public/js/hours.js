document.addEventListener('DOMContentLoaded', function () {
    const timetableRows = document.querySelectorAll('tbody tr');
    const dailyTotalElement = document.getElementById('daily-total');
    const weeklyTotalElement = document.getElementById('weekly-total');
  
    let dailyTotals = {};
    let weeklyTotal = 0;
  
    timetableRows.forEach(row => {
      const day = row.querySelector('td[data-label="Day"]').textContent.trim();
      const time = row.querySelector('td[data-label="Time"]').textContent.trim();
  
      const [start, end] = time.split('-').map(convertTimeTo24Hour);
      const hours = calculateHoursDifference(start, end);
  
      // Add hours to the total for the day
      if (!dailyTotals[day]) {
        dailyTotals[day] = 0;
      }
      dailyTotals[day] += hours;
  
      // Add hours to the weekly total
      weeklyTotal += hours;
  
      // Display the total hours in the current row
      row.querySelector('.total-hours').textContent = hours.toFixed(2) + ' hrs';
    });
  
    // Display daily total and weekly total
    let dailyTotalText = '';
    for (let day in dailyTotals) {
      dailyTotalText += `${day}: ${dailyTotals[day].toFixed(2)} hrs\n`;
    }
    dailyTotalElement.textContent = dailyTotalText.trim();
    weeklyTotalElement.textContent = weeklyTotal.toFixed(2) + ' hrs';
  });
  
  // Convert time from "HH:MMAM/PM" format to 24-hour format as a decimal
  function convertTimeTo24Hour(timeStr) {
    const [time, modifier] = timeStr.split(/(AM|PM)/i);
    let [hours, minutes] = time.split(':').map(Number);
    if (modifier.toUpperCase() === 'PM' && hours !== 12) {
      hours += 12;
    }
    if (modifier.toUpperCase() === 'AM' && hours === 12) {
      hours = 0;
    }
    return hours + minutes / 60;
  }
  
  // Calculate the difference in hours between two times in 24-hour decimal format
  function calculateHoursDifference(startTime, endTime) {
    return endTime - startTime;
  }
  