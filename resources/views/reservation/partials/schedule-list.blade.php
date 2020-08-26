@forelse($departures as $i => $departure)

    <li class="list-group-item animate__animated animate__fadeInUp animate__faster" onclick="getDeparture({{ $departure->id }})">
        <div class="d-flex">
            <strong class="flex-fill">{{ $departure->time }}</strong>
            Tersedia :{{ $departure->schedule->seats - $departure->schedule->count_tickets }}
        </div>
        <div>
            <small>Note: {{ $departure->schedule->note }}</small>
        </div>

    </li>
@empty
    <div class="col-md-12 p-4">
        <h2 class="text-muted animate__animated animate__fadeInUp animate__faster">tidak ada jadwal...</h2>
    </div>
@endforelse
