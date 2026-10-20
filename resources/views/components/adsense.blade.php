@php
    $enabled = (bool) config('adsense.enabled') && config('adsense.publisher_id');
    $publisherId = (string) config('adsense.publisher_id');
    $headerSlot = (string) config('adsense.slots.header');
    $sidebarSlot = (string) config('adsense.slots.sidebar');
    $footerSlot = (string) config('adsense.slots.footer');
@endphp

@if($enabled)
    @if($slot === 'header' && $headerSlot)
        <div class="my-6 flex justify-center">
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="{{ $publisherId }}"
                 data-ad-slot="{{ $headerSlot }}"></ins>
        </div>
    @elseif($slot === 'sidebar' && $sidebarSlot)
        <div class="my-6 flex justify-center">
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="{{ $publisherId }}"
                 data-ad-slot="{{ $sidebarSlot }}"></ins>
        </div>
    @elseif($slot === 'footer' && $footerSlot)
        <div class="my-6 flex justify-center">
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="{{ $publisherId }}"
                 data-ad-slot="{{ $footerSlot }}"></ins>
        </div>
    @endif
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
@endif