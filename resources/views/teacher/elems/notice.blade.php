<div class="notification mt-3 border shadow">
    <div class="card-body">
        <h5 class="card-title">Полезная информация</h5>
        <h6 class="card-subtitle mb-2 text-muted">Сегодня: {{ date('d.m.Y') }}</h6>
        @if (!empty($notifications))
            @foreach ($notifications as $notification)
                @if ($notification->start_date <= date('Y-m-d') && $notification->finish_date >= date('Y-m-d'))
                    <p class="card-text alert alert-secondary p-2">
                        {{ $notification->text }}
                    </p>
                @endif
            @endforeach
        @endif
    </div>
</div>

