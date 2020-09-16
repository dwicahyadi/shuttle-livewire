<div class="container">
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body my-2">
                <livewire:chart.trend-customer />
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-body my-2">
                <livewire:chart.customer-per-month />
            </div>
        </div>


        <div class="col-md-6">
            <div class="card card-body my-2">
                <livewire:chart.customer-per-point :month="$month" />
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-body my-2">
                <livewire:chart.favorite-time :month="$month" />
            </div>
        </div>


        <div class="col-md-6">
            <div class="card card-body my-2">
                <livewire:chart.cso-ranking />
            </div>
        </div>

        <div class="col-md-3">
            <div class="card m-2">
                <div class="card-body">
                    <h3 class="card-title">{{ \App\Helpers\SmsHelper::getCredit() }}</h3>
                    <span class="card-subtitle">Sms Credit</span>
                </div>
            </div>
        </div>

    </div>



</div>
