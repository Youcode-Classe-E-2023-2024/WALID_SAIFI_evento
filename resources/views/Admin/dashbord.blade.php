@extends('Admin.layout')

@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard Admin</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Votre formulaire de recherche ou autres éléments ici -->
            </div>
        </div>

        <!-- Balise canvas pour afficher le graphique -->
        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-fJJw+6bF0tCjXlj9euUm61v6GJjzvG+KEiD9RKzAlZTTXgpW/xFCKSLaRJub3tcuL5WbOy1TlZbGyMq86rRNrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        /* globals Chart:false, feather:false */
        (function () {
            'use strict';

            feather.replace({ 'aria-hidden': 'true' });

            // Récupérer les données des catégories avec le nombre d'événements associés
            $.ajax({
                url: '{{ route('categories-events') }}',
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
    </script>
@endpush
