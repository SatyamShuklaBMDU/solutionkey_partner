@extends('include.master')
@section('content')
<main class="s-layout__content px-4">
    <section class="">
      <div class="row">
        <div class="col-lg-3 mt-3 py-1">
          <div class="card bg-light shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-bg rounded-circle mr-3">
                <img src="{{asset('images/booking.png')}}" alt="" class="icon">
              </div>
              <div class="px-3">
                <h5 class="fw-bold mb-0" style="color: #90D7D7;">Total Consultations</h5>
                <p class="text-muted fw-bold mb-0">23</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 mt-3 py-1">
          <div class="card bg-light shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-bg rounded-circle mr-3">
                <img src="https://cdn-icons-png.flaticon.com/128/10509/10509226.png" alt="" class="icon">
              </div>
              <div class="px-3">
                <h5 class="fw-bold mb-0" style="color: #BFA1FD;">Pending Consultation</h5>
                <p class="text-muted fw-bold mb-0">23</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 mt-3 py-1">
          <div class="card bg-light shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-bg rounded-circle mr-3">
                <img src="https://cdn-icons-png.flaticon.com/128/10339/10339845.png" alt="" class="icon">
              </div>
              <div class="px-3">
                <h5 class="fw-bold mb-0 fs-5" style="color: #FC9FB3;">Today Consultation</h5>
                <p class="text-muted fw-bold mb-0">23</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 mt-3 py-1">
          <div class="card bg-light shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-bg rounded-circle mr-3">
                <img src="{{asset('images/profile.png')}}" alt="" class="icon">
              </div>
              <div class="px-3">
                <h5 class="fw-bold mb-0" style="color: #FCE098;">Total Earning</h5>
                <p class="text-muted fw-bold mb-0">23</p>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section>
      <div class="row py-3">
        <div class="col-md-8 shadow-sm bg-light">
          <canvas id="myChart"></canvas>
        </div>
        <div class="col-md-4 shadow-sm bg-light">
          <canvas id="paymentPieChart" width="400" height="400"></canvas>
        </div>
      </div>
    </section>
  </main>
  @endsection
  @section('script-area')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
  <script>
    // Data for the chart
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'jul', 'Aug', 'sep', 'Oct', 'Nov', 'Dec'];
    const data = {
      labels: labels,
      datasets: [{
        label: 'My User',
        backgroundColor: 'rgb(36,62,86)',
        borderColor: 'rgb(36,62,86)',
        data: [10, 5, 80, 81],
        tension: 0.1
      }]
    };
  
    // Configuration options
    const config = {
      type: 'line',
      data: data,
      options: {}
    };
  
    // Create the chart
    var myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
</script>
<script>
    // Data for the pie chart
    const paymentData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'jul', 'Aug', 'sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Payment',
        data: [800, 300, 200, 100, 500, 56, 87, 123, 345, 345, 123, 456], // Example amounts for each category
        backgroundColor: [
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(255, 99, 132, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(255, 206, 86, 0.6)',
        ],
        borderWidth: 0
      }]
    };
  
    // Get the canvas element
    const ctx = document.getElementById('paymentPieChart').getContext('2d');
  
    // Create the pie chart
    const myPieChart = new Chart(ctx, {
      type: 'pie',
      data: paymentData,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Payment Distribution'
          }
        }
      }
    });
</script>
@endsection