<div>
    <h4>CSO Ranking</h4>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>CSO</th>
            <th>Total Reservasi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $val)
            <tr>
                <td>{{ $val->reservation_by }}</td>
                <td>{{ number_format($val->val) }}</td>
            </tr>
        @empty

        @endforelse
        </tbody>
    </table>
</div>
