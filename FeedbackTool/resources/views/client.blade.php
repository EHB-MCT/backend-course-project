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
        console.log(survey);

        const chartOne = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: survey.dates,
                datasets: [
                    {
                    label: '# of Votes',
                    data: survey.scores[0],
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)'
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)',
                    ,
                    borderColor:
                        'rgba(255, 99, 132, 1)'
                    ,
                    borderWidth: 1
                },
                {
                    label: '# of Clicks',
                    data: survey.scores[1],
                    backgroundColor:
                        'rgba(54, 162, 235, 0.2)'
                    ,
                    borderColor:
                        'rgba(54, 162, 235, 1)'
                    ,
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
</x-app-layout>
