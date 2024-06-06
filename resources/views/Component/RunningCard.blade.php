<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="card-icon-container row no-gutters align-items-center">
                @if (!empty($card) && isset($card[1]) && $card[1]->status == 'Running')
                    <div class="col mr-2 card-icon-{{ $card[1]->status }}" id="">
                        {!! file_get_contents('icons/chart-2.svg') !!}
                    </div>
                    <div class="card-count-container col">
                        <div class="card-count-{{ $card[1]->status }}" class="mb-0">
                            {{ $card[1]->count }}
                        </div>
                        <div class="card-status" class="text-xs text-uppercase mb-1">{{ $card[1]->status }}</div>
                    </div>
                @else
                    <div class="col mr-2 card-icon-Running" id="">
                        {!! file_get_contents('icons/chart-2.svg') !!}
                    </div>
                    <div class="card-count-container col">
                        <div class="card-count-Running mb-0">0</div>
                        <div class="card-status" class="text-xs text-uppercase mb-1">Running</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
