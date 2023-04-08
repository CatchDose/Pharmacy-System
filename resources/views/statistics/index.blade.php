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
            data: [{{ isset($gender[1]) ? count($gender[1]) : 0  }} , {{ isset($gender[2]) ? count($gender[2]) : 0 }}],
            backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',

            ],
            hoverOffset: 4
        }]
        },
  });
</script>


@endsection
