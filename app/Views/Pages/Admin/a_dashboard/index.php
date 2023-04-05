<canvas id="myChart"></canvas>


<?php
$tingkat = "";
$jumlah = "";

foreach ($grafik as $row) :
    $tingkattampil = $row->tingkat;
    $tingkat .= "'$tingkattampil'" . ",";

    $jumlahtampil = $row->jumlahjenis;
    $jumlah .= "'$jumlahtampil'" . ",";

endforeach;
?>

<script>
    var ctx2 = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {

            datasets: [{
                data: [<?= $jumlah ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1,



            }],
            labels: [<?= $tingkat ?>],

        },
        plugins: [ChartDataLabels],


        // options: {
        //     scales: {
        //         y: {
        //             beginAtZero: true
        //         }
        //     }
        // }
        options: {

            plugins: {
                datalabels: {

                    font: {
                        size: 16,
                        weight: 'bold',
                    },
                    formatter: (value) => {
                        if (value == 0) {
                            return '';
                        } else {
                            return value;
                        }
                    },
                    color: [
                        'rgba(128, 0, 26, 1)',
                        'rgba(3, 62, 101, 1)',
                        'rgba(166, 122, 0, 1)',
                    ],
                }
            },



            // maintainAspectRatio: false,
            responsive: true,
            hoverOffset: 20,
            aspectRatio: 1.62,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0,
                }
            },


        },
    });
</script>