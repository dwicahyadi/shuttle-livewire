<div>
    <h4 class="my-4">Tren Penumpang</h4>
    <span class="text-muted">Menampilkan total penumpang pertanggal selama 30 hari kebelakang</span>
    <div id="chart-tend-customer" style="height: 300px;" ></div>
    <!-- Your application script -->
    <script>
        const trend_customer = new Chartisan({
            el: '#chart-tend-customer',
            url: "@chart('trend_customer')",
            hooks: new ChartisanHooks()
                .colors(['rgb(127, 156, 245)'])
                .tooltip()
        });
    </script>
</div>
