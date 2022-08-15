<x-app-layout>
    @if($user != null)
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

        @if(!$user->survlists->isEmpty())
            <!-- javascript chart -->
            <canvas id="myChart" width="400" height="200"></canvas>
            <script>
                // Get chart ids
                const ctx = document.getElementById('myChart').getContext('2d');

                var survey = {!! $user->survlists[0] !!}

                var colours = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ]

                var borderColours = [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ]


                function fillDatasets(){

                    var allDatasets = [];

                    for (let index = 0; index < survey.scores.length; index++) {

                        var itemBackgroundColor = '';
                        var itemBorderColor = '';
                        var i = 0;

                        do {
                            if(colours[index - (colours.length * i)]){
                                itemBackgroundColor = colours[index - (colours.length * i)];
                                itemBorderColor = borderColours[index - (colours.length * i)];
                            } else {
                                i++;
                            }
                        } while (!itemBackgroundColor);

                        var set = {
                            label : survey.questions[index],
                            data : survey.scores[index],
                            backgroundColor : itemBackgroundColor,
                            borderColor : itemBorderColor,
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
        @else
            <div>
                Nothing to show here
            </div>
        @endif
    @else
        <x-slot name="header">
            <h2>
                {{ __("Hidden") }}
            </h2>
        </x-slot>
        <div>
            Nothing to find here
        </div>
    @endif
</x-app-layout>
