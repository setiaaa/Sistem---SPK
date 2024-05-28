<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="card-icon-container row no-gutters align-items-center">
                @if (!empty($card) && isset($card[2]))
                    <div class="col mr-2 card-icon-{{ $card[2]->status }}" id="">
                            {!! file_get_contents('icons/status-up.svg') !!}
                    </div>
                    <div class="card-count-container col">
                        <div class="card-count-{{ $card[2]->status }}" class="mb-0">
                            {{ $card[2]->count }}
                        </div>
                        <div class="card-status" class="text-xs text-uppercase mb-1">{{ $card[2]->status }}</div>
                    </div>
                @else
                    <div class="col mr-2 card-icon" id="">
                        {!! file_get_contents('icons/status-up.svg') !!}
                    </div>
                    <div class="card-count-container col">
                        <div class="card-count" class="mb-0">0</div>
                        <div class="card-status" class="text-xs text-uppercase mb-1">Done</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>