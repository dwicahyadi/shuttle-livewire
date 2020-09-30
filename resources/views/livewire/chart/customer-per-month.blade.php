<div>
    <h4 class="my-4">Penumpang per Bulan</h4>
    <span class="text-muted">Perbandingan Penumpang tiap bulan</span>
    <div id="chart-customer-per-month" style="height: 300px;" class="w-100"></div>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart-customer-per-month',
            url: "@chart('customer_per_month')",
            hooks: new ChartisanHooks()
                .colors(['rgb(127, 156, 245)'])
                .tooltip()
        });
    </script>
</div>
