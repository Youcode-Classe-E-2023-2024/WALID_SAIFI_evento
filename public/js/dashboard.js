/* globals Chart:false, feather:false */
(function () {
    'use strict'

    feather.replace({ 'aria-hidden': 'true' })

    // Récupérer les données des catégories avec le nombre d'événements associés
    $.ajax({
        url: '/categories-events',
        method: 'GET',
        success: function(response) {
            var categories = response;
            var labels = [];
            var data = [];

            // Parcourir les catégories et récupérer les noms et le nombre d'événements
            categories.forEach(function(category) {
                labels.push(category.name);
                data.push(category.event_count);
            });

            // Construire le graphique avec les données récupérées
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nombre d\'événements',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

})();
