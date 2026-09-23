<x-layouts.dashboard>
    <x-slot:title>Earnings History</x-slot:title>

    <div class="space-y-8">

        @if(session('success'))
            <div class="rounded-2xl px-5 py-4 text-sm font-medium bg-[#f0faf0] border border-[#d7f0d0] text-[#43a027]">
                {{ session('success') }}
            </div>
        @endif

        <!-- Level-wise Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($totalByLevel as $levelData)
                @php
                    $levelStyles = [
                        1 => ['iconClass' => 'text-[#43a027]', 'bgClass' => 'bg-[#f0faf0]'],
                        2 => ['iconClass' => 'text-[#2e7d32]', 'bgClass' => 'bg-[#f0faf0]'],
                        3 => ['iconClass' => 'text-amber-500', 'bgClass' => 'bg-amber-50'],
                        4 => ['iconClass' => 'text-violet-600', 'bgClass' => 'bg-violet-50'],
                        5 => ['iconClass' => 'text-blue-500', 'bgClass' => 'bg-blue-50'],
                        6 => ['iconClass' => 'text-pink-500', 'bgClass' => 'bg-pink-50'],
                        7 => ['iconClass' => 'text-cyan-500', 'bgClass' => 'bg-cyan-50'],
                    ];
                    $ls = $levelStyles[$levelData->level] ?? ['iconClass' => 'text-gray-500', 'bgClass' => 'bg-gray-50'];
                @endphp
                <div class="bg-white border border-gray-100 rounded-2xl p-5 relative overflow-hidden transition-all duration-300 hover:-translate-y-0.5">
                    <div class="absolute top-0 right-0 w-20 h-20 rounded-full -translate-y-1/2 translate-x-1/2 {{ $ls['bgClass'] }}"></div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold {{ str_replace('bg-50', 'bg-100', $ls['bgClass']) }} {{ $ls['iconClass'] }}">L{{ $levelData->level }}</span>
                            <span class="text-xs text-gray-500">{{ $levelData->count }} commissions</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">Rs {{ number_format($levelData->total, 2) }}</p>
                        <p class="text-xs mt-1 text-gray-500">Total from Level {{ $levelData->level }}</p>
                    </div>
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 bg-white border border-gray-100 rounded-2xl p-8 text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-gray-500">Abhi tak koi earnings data nahi</p>
                </div>
            @endforelse
        </div>

        <!-- Commission History Table -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#f0faf0]">
                    <svg class="w-4 h-4 text-[#43a027]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </span>
                Commission History <span class="font-urdu text-sm">کومیشن کی تاریخ</span>
            </h3>

            @if($commissions->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-sm text-gray-500">Abhi tak koi commission nahi mila</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left py-3 px-4 font-medium text-gray-500">From</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Level</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Amount</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissions as $commission)
                                @php
                                    $levelStyles = [
                                        1 => ['iconClass' => 'text-[#43a027]', 'bgClass' => 'bg-[#f0faf0]'],
                                        2 => ['iconClass' => 'text-[#2e7d32]', 'bgClass' => 'bg-[#f0faf0]'],
                                        3 => ['iconClass' => 'text-amber-500', 'bgClass' => 'bg-amber-50'],
                                        4 => ['iconClass' => 'text-violet-600', 'bgClass' => 'bg-violet-50'],
                                        5 => ['iconClass' => 'text-blue-500', 'bgClass' => 'bg-blue-50'],
                                        6 => ['iconClass' => 'text-pink-500', 'bgClass' => 'bg-pink-50'],
                                        7 => ['iconClass' => 'text-cyan-500', 'bgClass' => 'bg-cyan-50'],
                                    ];
                                    $ls = $levelStyles[$commission->level] ?? ['iconClass' => 'text-gray-500', 'bgClass' => 'bg-gray-50'];
                                @endphp
                                <tr class="border-b border-gray-50 hover:bg-[#f0faf0]/50 transition-colors duration-200">
                                    <td class="py-3.5 px-4 text-gray-900 font-medium">{{ $commission->fromUser->name ?? 'Unknown' }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold {{ $ls['bgClass'] }} {{ $ls['iconClass'] }}">L{{ $commission->level }}</span>
                                    </td>
                                    <td class="py-3.5 px-4 font-semibold text-[#43a027]">+Rs {{ number_format($commission->amount, 2) }}</td>
                                    <td class="py-3.5 px-4 text-gray-500">{{ $commission->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $commissions->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layouts.dashboard>
