document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('userEmployeeChart').getContext('2d');
    var userEmployeeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Employees'],
            datasets: [{
                label: 'Count',
                data: [userCount, employeCount],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(153, 102, 255)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
