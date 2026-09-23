@php
    try {
        $enabled = \App\Models\Setting::get('adsense_enabled', '0') === '1';
        $publisherId = \App\Models\Setting::get('adsense_publisher_id', '');
        $headerSlot = \App\Models\Setting::get('adsense_ad_slot_header', '');
        $sidebarSlot = \App\Models\Setting::get('adsense_ad_slot_sidebar', '');
        $footerSlot = \App\Models\Setting::get('adsense_ad_slot_footer', '');
    } catch (\Exception $e) {
        $enabled = false;
        $publisherId = '';
    }
@endphp

@if($enabled && $publisherId)
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
