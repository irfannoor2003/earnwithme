<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type }} Receipt #{{ str_pad($record->id, 6, '0', STR_PAD_LEFT) }} - Me Earning Platform</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; color: #111827; -webkit-font-smoothing: antialiased; padding: 24px 16px; }
        .receipt-wrap { max-width: 640px; margin: 0 auto; }
        .toolbar { max-width: 640px; margin: 0 auto 20px; display: flex; gap: 12px; justify-content: flex-end; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: all .2s ease; }
        .btn-primary { background: #4caf2f; color: #fff; }
        .btn-primary:hover { background: #43a027; }
        .btn-outline { background: #fff; color: #374151; border: 1px solid #e5e7eb; }
        .btn-outline:hover { border-color: #4caf2f; color: #4caf2f; }
        .receipt { background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,.08); position: relative; }
        .head { background: linear-gradient(135deg, #e8f5e1 0%, #f0faf0 60%, #ffffff 100%); padding: 32px 36px 26px; border-bottom: 1px solid #e8f5e1; display: flex; align-items: center; justify-content: space-between; }
        .brand img { height: 44px; width: auto; }
        .badge-type { font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: #43a027; background: #e8f5e1; border: 1px solid #c8e6b8; padding: 6px 14px; border-radius: 999px; }
        .body { padding: 30px 36px 34px; }
        .rid { font-size: 13px; color: #6b7280; margin-bottom: 22px; }
        .rid b { color: #111827; }
        table.meta { width: 100%; border-collapse: collapse; }
        table.meta td { padding: 11px 0; border-bottom: 1px dashed #e5e7eb; vertical-align: top; }
        table.meta td:first-child { font-size: 12px; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; color: #9ca3af; width: 42%; }
        table.meta td:last-child { font-size: 14.5px; font-weight: 600; color: #374151; }
        .amount-box { margin-top: 24px; border: 2px solid #c8e6b8; background: #f8fdf7; border-radius: 14px; padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; }
        .amount-label { font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #43a027; }
        .amount-value { font-size: 30px; font-weight: 800; background: linear-gradient(135deg,#43a027,#66bb6a); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .stamp { position: absolute; top: 118px; right: 34px; transform: rotate(-12deg); border: 3px solid #16a34a; color: #16a34a; font-weight: 800; font-size: 26px; letter-spacing: .25em; text-transform: uppercase; padding: 8px 20px 8px 26px; border-radius: 10px; opacity: .85; background: rgba(22,163,74,.05); pointer-events: none; }
        .foot { padding: 0 36px 32px; text-align: center; }
        .foot .line { border-top: 1px dashed #e5e7eb; padding-top: 18px; font-size: 12px; color: #9ca3af; line-height: 1.7; }
        .verify { margin-top: 6px; font-size: 12px; color: #6b7280; }
        @media print {
            body { background: #fff; padding: 0; }
            .toolbar { display: none; }
            .receipt { box-shadow: none; border-radius: 0; }
            .stamp { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .amount-value, .amount-box, .head, .badge-type { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="{{ url()->previous() }}" class="btn btn-outline">Back</a>
        <button onclick="window.print()" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Download / Print PDF
        </button>
    </div>

    <div class="receipt-wrap">
        <div class="receipt">
            <div class="stamp">{{ $type === 'Reward' ? 'Awarded' : 'Approved' }}</div>

            <div class="head">
                <div class="brand">
                    <img src="/images/logo.png" alt="Me Earning">
                </div>
                <span class="badge-type">{{ $type }} Receipt</span>
            </div>

            <div class="body">
                <p class="rid">Receipt No: <b>{{ strtoupper(substr($type, 0, 3)) }}-{{ str_pad($record->id, 6, '0', STR_PAD_LEFT) }}</b></p>

                <table class="meta">
                    <tr><td>Member Name</td><td>{{ $user->name }}</td></tr>
                    <tr><td>Email</td><td>{{ $user->email }}</td></tr>
                    @if($user->phone)
                    <tr><td>Phone</td><td>{{ $user->phone }}</td></tr>
                    @endif
                    <tr><td>Date &amp; Time</td><td>{{ $record->created_at->format('d M Y, h:i A') }}</td></tr>

                    @if($type === 'Deposit')
                        <tr><td>Plan</td><td>{{ $record->plan->name ?? 'N/A' }}</td></tr>
                        <tr><td>Payment Method</td><td style="text-transform: capitalize;">{{ $record->method }}</td></tr>
                        <tr><td>Transaction ID</td><td>{{ $record->transaction_id }}</td></tr>
                    @elseif($type === 'Withdrawal')
                        <tr><td>Payment Method</td><td style="text-transform: capitalize;">{{ $record->method }}</td></tr>
                        <tr><td>Account Number</td><td>{{ $record->account_number }}</td></tr>
                        @if(!empty($record->account_name))
                        <tr><td>Account Title</td><td>{{ $record->account_name }}</td></tr>
                        @endif
                        <tr><td>Processing Fee ({{ rtrim(rtrim(number_format((float) config('withdrawals.fee_percent'), 2, '.', ''), '0'), '.') }}%)</td><td>Rs {{ number_format($record->fee ?? \App\Models\Withdrawal::feeFor((float) $record->amount), 2) }}</td></tr>
                    @elseif($type === 'Reward')
                        <tr><td>Reason</td><td>{{ $record->reason }}</td></tr>
                        <tr><td>Issued By</td><td>{{ $record->issuer->name ?? 'Admin' }} (Admin)</td></tr>
                    @endif

                    <tr><td>Status</td><td style="color:#16a34a; text-transform:capitalize; font-weight:700;">{{ $type === 'Reward' ? 'Awarded' : ucfirst($record->status ?? 'approved') }}</td></tr>
                </table>

                <div class="amount-box">
                    <div>
                        <p class="amount-label">{{ $type === 'Withdrawal' ? 'Amount Approved' : ($type === 'Reward' ? 'Reward Amount' : 'Amount Received') }}</p>
                        <p class="amount-value">Rs {{ number_format($record->amount, $record->amount == intval($record->amount) ? 0 : 2) }}</p>
                    </div>
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8.5 12.5 2.5 2.5 5-5.5"/></svg>
                </div>
            </div>

            <div class="foot">
                <div class="line">
                    Thank you for being a part of <strong style="color:#43a027;">Me Earning Platform</strong>.<br>
                    This is a computer-generated receipt and does not require a signature.
                </div>
                <p class="verify">Issued on {{ now()->format('d M Y, h:i A') }} · www.meearningplatform.com</p>
            </div>
        </div>
    </div>

    @if(request()->query('print') == '1')
    <script>window.addEventListener('load', () => setTimeout(() => window.print(), 400));</script>
    @endif
</body>
</html>
