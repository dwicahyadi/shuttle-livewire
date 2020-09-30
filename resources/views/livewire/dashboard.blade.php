<div class="container">
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

    <div class="row my-4">
        <div class="col-md-12 animate__animated animate__fadeIn animate__fast">
            <h1 class="my-3"><strong>Summary Dashboard</strong> {{ date('F', mktime(0, 0, 0, $month, 1)) }}</h1>
            <p>Dashboard periode :</p>
            <form method="get">
                <select name="month">
                    @for($i = 1; $i <= 12; $i++)
                        <option @if($month == $i) selected @endif value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>

                <button type="submit" class="mx-4">Tampilkan</button>
            </form>
        </div>
    </div>
    <livewire:dashboard.customer-stats :month="$month" />
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
                <livewire:chart.cso-ranking :month="$month" />
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
