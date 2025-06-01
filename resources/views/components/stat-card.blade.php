
<div class="col">
    <div class="card h-100 shadow-sm {{ $bgColorClass ?? 'bg-light' }}">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="avatar-sm rounded-circle {{ $bgColorClass ?? 'bg-primary' }} bg-opacity-25 d-flex align-items-center justify-content-center me-3"
                        style="width: 50px; height: 50px;">
                        <i class="fas {{ $icon ?? 'fa-info-circle' }} fs-3 {{ $colorClass ?? 'text-primary' }}"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <p class="text-muted mb-1">{{ $title }}</p>
                    <h4 class="mb-0">{{ $value }}</h4>
                </div>
            </div>
        </div>
        @if(isset($link) && $link)
        <div class="card-footer bg-transparent border-top-0">
            <a href="{{ $link }}" class="text-decoration-none {{ $colorClass ?? 'text-primary' }}">
                View Details <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
        @endif
    </div>
</div>
