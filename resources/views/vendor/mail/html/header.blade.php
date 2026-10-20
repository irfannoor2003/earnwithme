@props(['url'])

{{-- Brand header: a solid green band with the wordmark. A text wordmark is
     used rather than <img> because email clients block remote images by
     default, which would leave the header blank. --}}
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            <span style="color: #ffffff; font-size: 20px; font-weight: 800; letter-spacing: -0.02em;">{{ config('app.name') }}</span>
            <span style="color: #eaf7e5; font-size: 12px; font-weight: 500; letter-spacing: 0.06em; padding-top: 4px; text-transform: uppercase;">Referral Earning Platform</span>
        </a>
    </td>
</tr>
