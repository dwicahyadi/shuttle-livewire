<div>
    <h4 class="my-4">Jam Keberangkatan Paling Diminati</h4>
    <span class="text-muted">Menampilkan jam keberangkatan paling diminati dibulan ini</span>
    <div id="chart-favorite-time" style="height: 300px;" class="w-100"></div>
    <!-- Your application script -->
    <script>
        const favorite_time = new Chartisan({
            el: '#chart-favorite-time',
            url: "@chart('favorite_time',['month' => $month])",

            hooks: new ChartisanHooks({
                tooltip: true
            })
                .colors(['rgb(127, 156, 245'])
                .tooltip()
        });
    </script>
</div>
