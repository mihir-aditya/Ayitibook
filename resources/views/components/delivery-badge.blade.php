{{-- resources/views/components/delivery-badge.blade.php --}}
{{-- Usage:
     <x-delivery-badge :partner="$partner" />                      — inline badge only
     <x-delivery-badge :partner="$partner" :show-progress="true" /> — badge + next-tier hints
--}}

@php
    $info    = $partner->getBadgeInfo();
    $tier    = $partner->getBadgeTier();
    $hints   = $showProgress ? $partner->getBadgeProgressHints() : [];
@endphp

<span class="delivery-badge {{ $info['bg_class'] }}"
      title="{{ $info['label'] }} Partner"
      data-bs-toggle="tooltip"
      data-bs-placement="top">
    <i class="{{ $info['icon'] }} me-1"></i>
    {{ $info['label'] }}
</span>

@if($showProgress && count($hints))
    <div class="badge-progress-hints mt-2">
        <small class="text-muted d-block mb-1 fw-semibold">
            <i class="fas fa-arrow-up me-1"></i>To reach
            @php
                $tierOrder = ['unranked','beginner','bronze','silver','gold','platinum'];
                $idx = array_search($tier, $tierOrder);
                $nextLabel = isset($tierOrder[$idx+1])
                    ? ucfirst($tierOrder[$idx+1])
                    : 'Max Tier';
            @endphp
            {{ $nextLabel }}:
        </small>
        <ul class="list-unstyled mb-0">
            @foreach($hints as $hint)
                <li class="small text-muted">
                    <i class="fas fa-circle-dot me-1 text-warning" style="font-size:.65rem"></i>
                    {{ $hint }}
                </li>
            @endforeach
        </ul>
    </div>
@endif