<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                    <p style="color: #9ca3af; font-size: 12px; margin-top: 12px;">
                        <a href="{{ url('/') }}" style="color: #43a027; text-decoration: underline;">www.meearningplatform.com</a>
                    </p>
                    <p style="color: #9ca3af; font-size: 12px;">
                        You are receiving this email because an account action was requested on {{ config('app.name') }}.
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
