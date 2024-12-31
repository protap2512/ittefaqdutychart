<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            color: #555;
            margin-bottom: 10px;
        }
        .employee-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .employee {
            text-align: center;
            width: 100px;
        }
        .employee img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }
        .employee.unavailable img {
            opacity: 0.5;
        }
        .employee span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }
        .special-duty {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Employee Availability</h1>
    
    <!-- Calendar -->
    <div id="calendar"></div>

    <!-- Employee Groups -->
    <div class="section" id="employeeGroups">
        <!-- Dynamic Content Will Be Loaded Here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            defaultDate: new Date(), // Set default to today's date
            events: [], // You can add events here if needed
            dayClick: function(date, jsEvent, view) {
                var selectedDate = date.format(); // Get selected date
                getEmployeeAssignments(selectedDate);
            }
        });

        // Function to fetch and display employee assignments
        function getEmployeeAssignments(date) {
            $.ajax({
                url: '/duties',
                method: 'GET',
                data: { date: date },
                success: function(response) {
                    // Clear the previous content
                    $('#employeeGroups').html('');

                    // Add Late Night Duty Employees
                    $('#employeeGroups').append('<div class="section"><h3>Late Night Duty</h3><div class="employee-list"></div></div>');
                    response.late_night.forEach(function(duty) {
                        $('.employee-list').last().append('<div class="employee"><img src="https://via.placeholder.com/80" alt="' + duty.employee.name + '"><span>' + duty.employee.name + '</span><span class="special-duty">(' + duty.start_date + ' - ' + duty.end_date + ')</span></div>');
                    });

                    // Add Picture Selection Duty Employees
                    $('#employeeGroups').append('<div class="section"><h3>Picture Selection Duty</h3><div class="employee-list"></div></div>');
                    response.picture_selection.forEach(function(duty) {
                        $('.employee-list').last().append('<div class="employee"><img src="https://via.placeholder.com/80" alt="' + duty.employee.name + '"><span>' + duty.employee.name + '</span><span class="special-duty">(' + duty.start_date + ' - ' + duty.end_date + ')</span></div>');
                    });

                    // Add Available Employees (other groups)
                    $('#employeeGroups').append('<div class="section"><h3>Available Employees</h3><div class="employee-list"></div></div>');
                    response.available_employees.forEach(function(employee) {
                        $('.employee-list').last().append('<div class="employee"><img src="https://via.placeholder.com/80" alt="' + employee.name + '"><span>' + employee.name + '</span></div>');
                    });
                }
            });
        }
    });
</script>

</body>
</html>
