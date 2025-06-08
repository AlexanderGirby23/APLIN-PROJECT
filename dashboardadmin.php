<?php
require_once('adminnav.php');

$query = "
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(price * stock) AS monthly_expense
    FROM master_spareparts
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
    ORDER BY month DESC;
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DASHBOARD</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="margin:100px">
    <div class="row">
        <div class="col-6">
            <h1>EXPENSE REPORT</h1>
            <canvas id="expenseChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div class="col-6">
            <h1>BOOKING REPORT</h1>
            <canvas id="bookingChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div class="col-6">
            <h1>MOST POPULAR CAR</h1>
            <canvas id="topCarsChart" style="width: 100%; height: 400px;"></canvas>
        </div>
    </div>
</body>

<script>
    fetch('expensedata.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('expenseChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Expense (IDR)',
                        data: data.values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'Rp ' + value.toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        });

    fetch('booking_report.php')
        .then(res => res.json())
        .then(data => {
            const labels = data.map(item => item.month);
            const values = data.map(item => parseInt(item.total_expense));

            const ctx = document.getElementById('bookingChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Monthly Booking Expense (IDR)',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive:false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(err => console.error('Fetch error:', err));

    fetch('bookedcarreport.php')
        .then(res => res.json())
        .then(data => {
            const labels = data.map(item => item.CAR_NAME);
            const values = data.map(item => parseInt(item.total_bookings));

            const ctx = document.getElementById('topCarsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Bookings',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Top 5 Most Booked Cars'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        })
        .catch(err => {
            console.error('Fetch error:', err);
        });
</script>

</html>