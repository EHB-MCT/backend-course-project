<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __($user->name) }}
        </h2>
    </x-slot>

    <div>
        <ul>
            <li>
                {{ $user->name }}
            </li>
            <li>
                {{ $user->email }}
            </li>
        </ul>
    </div>

    <!-- javascript chart -->
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        // Get chart ids
        const ctx = document.getElementById('myChart').getContext('2d');

        var survey = {!! $user->survlists[0] !!}

        function fillDatasets(){
            var allDatasets = []

            for (let index = 0; index < survey.scores.length; index++) {

                var set = {
                    label : survey.questions[index],
                    data : survey.scores[index],
                    backgroundColor : 'rgba(255, 99, 132, 0.2)',
                    borderColor : 'rgba(255, 99, 132, 1)',
                    borderWidth : 1
                }

                allDatasets.push(set);
            }

            return allDatasets;
        }

        const chartOne = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: survey.dates,
                datasets: fillDatasets(),
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
</x-app-layout>
