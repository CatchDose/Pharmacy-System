@extends("layouts.app")

@section('title' , 'Statistics')

@section('style')


@endsection

@section("header","Statistics")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="">Order</a></li>

@endsection

@section('content')

<div class="container-fluid d-flex justify-content-center">

    <div class="row d-flex justify-content-between align-items-center align-content-evenly" style="min-height:100vh ;">

        <div class="col-md-5 col-12 mb-3">

          <label>Orders</label>

            <canvas id="first"></canvas>

        </div>

        <div class="col-md-5 col-12 mb-3">

            <label>Profit</label>
            <canvas id="second"></canvas>

        </div>

        <div class="col-md-5 col-12 ">

            <label>Attendance</label>
            <canvas id="third"></canvas>

        </div>

        <div class="col-md-5 col-12">

            <canvas id="fourth"></canvas>

        </div>
    </div>
</div>



@endsection



@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script src="{{asset("/dist/js/chart.umd.js")}}"></script>--}}
<script type="module">
  const first = document.getElementById('first');
  const second = document.getElementById('second');
  const third = document.getElementById('third');
  const fourth = document.getElementById('fourth');
  const dataPie =  function () {

  }
  new Chart(first, {
    type: 'bar',
    data: {
        labels: [@foreach($topUsers as $user) "{{"$user->user"}}", @endforeach],
        datasets: [{
        label: '# of Orders',
        data: [@foreach($topUsers as $user) {{"$user->count"}}, @endforeach],
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
        labels: [@foreach($revenue as $key=>$Value) {{"$key ,"}} @endforeach],
        datasets: [{
            label: 'Profit',
            data: [@foreach($revenue as $key=>$Value) {{"$Value ,"}} @endforeach],
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
            data: [{{ count($gender[1]) }} , {{ count($gender[2]) }}],
            backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',

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
