<div>
    <h4>CSO Ranking</h4>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Driver</th>
            <th>Total Ritase</th>
            <th>Total Kas Jalan</th>
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
