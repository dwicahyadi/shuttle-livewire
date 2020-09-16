<div>
    <h4 class="my-4">Penumpang per Point</h4>
    <div id="chart-customer-per-point" style="height: 300px;" class="w-100"></div>
    <!-- Your application script -->
    <script>
        const customer_per_point = new Chartisan({
            el: '#chart-customer-per-point',
            url: "@chart('customer_per_point',['month' => $month])",
            hooks: new ChartisanHooks()
                .colors(['rgb(127, 156, 245, 0.4)'])
        });
    </script>
</div>
