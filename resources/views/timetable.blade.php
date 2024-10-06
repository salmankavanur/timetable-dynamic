<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    
    <!-- Open Graph meta tags -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Class Timetable with Notification" />
  <meta property="og:description" content="Time Schedule with all mandatory details such as day, time, student name, platform, notification button. The Add to Calendar button will be helpful to get the notification via Google Calendar." />
  <meta property="og:image" content="https://salmanmp.me/timetable/meta_og_image.png" />
  <meta property="og:url" content="https://salmanmp.me/timetable" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Class Timetable with Notification" />
<meta name="twitter:description" content="Time Schedule with all mandatory details such as day, time, student name, platform, notification button. The Add to Calendar button will be helpful to get the notification via Google Calendar." />
<meta name="twitter:image" content="https://salmanmp.me/timetable/meta_og_image.png" />



    <title>Class Timetable</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/hours.js') }}"></script>

  </head>
  <body>
    <div class="timetable">
      <h2>Class Timetable</h2>
      
      <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Student Name</th>
                <th>Platform</th>
                <th>Notification</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr class="{{ strtolower($schedule->platform->name) }}">
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                    <td>{{ $schedule->student->name }}</td>
                    <td>{{ $schedule->platform->name }}</td>
                    <td>
                        <button
                            class="notification-btn"
                            data-day="{{ $schedule->day }}"
                            data-time="{{ $schedule->start_time }}-{{ $schedule->end_time }}"
                            data-student="{{ $schedule->student->name }}"
                            data-platform="{{ $schedule->platform->name }}"
                        >
                            Add to Calendar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
      <div class="legend">
        <h3>Day Colors</h3>
        <p><span class="color-box monday"></span> Monday</p>
        <p><span class="color-box tuesday"></span> Tuesday</p>
        <p><span class="color-box wednesday"></span> Wednesday</p>
        <p><span class="color-box thursday"></span> Thursday</p>
        <p><span class="color-box friday"></span> Friday</p>
        <p><span class="color-box saturday"></span> Saturday</p>
        <p><span class="color-box sunday"></span> Sunday</p>
      </div>
      <div class="legend">
       
            <h3>Platform Colors</h3>
            @foreach($schedules->groupBy('platform.name') as $platformName => $platformSchedules)
                <p><span class="legend-color {{ strtolower($platformName) }}"></span> {{ $platformName }}</p>
            @endforeach
        </div>
        
     
    </div>
    <script src="script.js"></script>
    <script src="hours.js"></script>

    <script>
      function calculateTotalHours() {
        const timeCells = document.querySelectorAll('td[data-label="Time"]');
        let totalHours = 0;
  
        timeCells.forEach(cell => {
          const timeRange = cell.textContent.trim();
          const [start, end] = timeRange.split('-').map(time => {
            const [hour, minute] = time.replace(/(AM|PM)/g, '').split(':').map(Number);
            const isPM = time.includes('PM');
            return hour + (isPM && hour !== 12 ? 12 : 0) + minute / 60;
          });
  
          const hours = end - start;
          totalHours += hours;
        });
  
        document.getElementById('total-hours').textContent = totalHours.toFixed(2);
      }
  
      calculateTotalHours();
    </script>

  </body>
</html>