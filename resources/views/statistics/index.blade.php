@extends("layouts.app")

@section('title' , 'Statistics')

@section('style')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

@section("header","Statistics")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection

@section('content')

<div class="container-fluid d-flex justify-content-center">

    <div class="row d-flex justify-content-between align-items-center align-content-evenly" style="min-height:100vh ;">

        <div class="col-md-5 col-12">

            <canvas id="first"></canvas>

        </div>

        <div class="col-md-5 col-12">

            <canvas id="second"></canvas>

        </div>

        <div class="col-md-5 col-12">

            <canvas id="third"></canvas>

        </div>

        <div class="col-md-5 col-12">

            <canvas id="fourth"></canvas>

        </div>
    </div>
</div>

   

@endsection



@section('scripts')

<script>
  const first = document.getElementById('first');
  const second = document.getElementById('second');

  new Chart(first, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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

  new Chart(second, {
    type: 'line',

    data: {
        labels: [1,2,3,4,5,6,7,8,9,10,11,12],
        datasets: [{
            label: 'Profit',
            data: [65, 59, 80, 81, 56, 55, 40 , 200 , 10 , 30 , 500 , 5],
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            xAxisID: 'Months',
            yAxisID: 'Profit',
        }],
        options: {

            xAxisID: 'Months',
            yAxisID: 'Profit',
        }
    },
  });

  new Chart(third, {
    type: 'pie',
    data : {
        labels: [
            'Men',
            'Women',
        ],
        datasets: [{
            label: 'Attendance',
            data: [100 , 50],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            ],
            hoverOffset: 4
        }]
        },
  });
  
  new Chart(fourth, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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


@endsection