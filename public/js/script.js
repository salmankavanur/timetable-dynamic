document.querySelectorAll('.notification-btn').forEach(button => {
    button.addEventListener('click', function() {
        const day = this.getAttribute('data-day');
        const time = this.getAttribute('data-time');
        const student = this.getAttribute('data-student');
        const platform = this.getAttribute('data-platform');

        // Split the time into start and end times
        const timeSlots = time.split('-');
        const startTime = timeSlots[0].trim();
        const endTime = timeSlots[1].trim();

        // Assuming your classes are on the current week's days
        const today = new Date();
        const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const dayOfWeek = daysOfWeek.indexOf(day);
        
        const eventDate = new Date(today.setDate(today.getDate() - today.getDay() + dayOfWeek));

        // Format the date and time
        const formattedStartDateTime = formatDateTime(eventDate, startTime);
        const formattedEndDateTime = formatDateTime(eventDate, endTime);

        // Google Calendar link
        const calendarUrl = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(student)} - ${encodeURIComponent(platform)}&dates=${formattedStartDateTime}/${formattedEndDateTime}&details=Class with ${encodeURIComponent(student)} at ${encodeURIComponent(platform)}&location=Online&sf=true&output=xml`;

        window.open(calendarUrl, '_blank');
    });
});

function formatDateTime(date, time) {
    const [hours, minutes] = time.split(':');
    date.setHours(parseInt(hours, 10), parseInt(minutes, 10));
    
    return date.toISOString().replace(/-|:|\.\d\d\d/g, '');
}