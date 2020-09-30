<div>
    <h4 class="my-4">Penumpang per Point</h4>
    <span class="text-muted">Menampilkan total penumpang berdsarkan point keberangkatan di bulan ini</span>
    <div id="chart-customer-per-point" style="height: 300px;" class="w-100" wire:ignore wire:key="chart-customer-per-point"></div>
    <!-- Your application script -->
    <script>
        const customer_per_point = new Chartisan({
            el: '#chart-customer-per-point',
            url: "@chart('customer_per_point',['month' => $month])",
            hooks: new ChartisanHooks()
                .colors(['rgb(127, 156, 245)'])
                .tooltip()
        });
    </script>
</div>
