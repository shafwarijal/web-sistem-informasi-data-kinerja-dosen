<?= $grafik ?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var tampilgrafiktahun = new Chart(ctx, {
        type: 'doughnut',
        responsive: true,
        data: {
            labels: [<?php $tingkat ?>],
            datasets: [{
                data: [<?= $jumlah ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
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
</script>