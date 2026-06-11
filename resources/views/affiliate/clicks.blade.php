<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Clicks | Enterprise Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f3f4f6; }
        .stat-card {
            transition: all 0.2s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1.25rem;
            border-radius: 9999px;
            letter-spacing: 0.025em;
        }
        .code-block {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border: 1px solid #d1d5db;
        }
    </style>
</head>
<body class="antialiased">

    {{-- ── Top Navigation ── --}}
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">Affiliate<span class="text-indigo-600">Pro</span></span>
                    </div>
                    <span class="text-sm text-gray-500">Enterprise Partner Platform</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm font-medium text-gray-700">{{ $affiliate->user->name }}</span>
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold text-indigo-800">{{ substr($affiliate->user->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- ── Page Header ── --}}
        <div class="mb-8 flex justify-between items-center">
            <div>
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-1">
                    <a href="{{ route('affiliate.dashboard', $affiliate->affiliate_code) }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
                    <span>›</span>
                    <span class="text-gray-800 font-medium">Click Analytics</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Click Analytics</h1>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $affiliate->user->name }} • Affiliate Code:
                    <code class="code-block px-2 py-0.5 rounded text-xs font-mono">{{ $affiliate->affiliate_code }}</code>
                </p>
            </div>
            <a href="{{ route('affiliate.dashboard', $affiliate->affiliate_code) }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Affiliate
            </a>
        </div>

        {{-- ── Stat Cards ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-purple-100 text-sm font-medium uppercase tracking-wider">Total Clicks</p>
                    <div class="w-10 h-10 bg-purple-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">{{ number_format($totalClicks) }}</p>
                <p class="text-purple-100 text-xs mt-2">All-time tracked clicks</p>
            </div>

            <div class="stat-card bg-gradient-to-br from-emerald-500 to-emerald-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Conversion Rate</p>
                    <div class="w-10 h-10 bg-emerald-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">{{ $conversionRate }}<span class="text-xl font-medium">%</span></p>
                <p class="text-emerald-100 text-xs mt-2">Clicks that converted to orders</p>
            </div>
        </div>

        {{-- ── Click Log Table ── --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Click Log</h2>
                    <p class="text-xs text-gray-500 mt-1">{{ $clicks->total() }} total records</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                @if($clicks->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Click Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($clicks as $click)
                        @php
                            $status = $click->status ?? 'pending';
                            $badgeClass = match($status) {
                                'converted' => 'bg-green-100 text-green-800',
                                'clicked'   => 'bg-blue-100 text-blue-800',
                                default     => 'bg-yellow-100 text-yellow-800',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $click->affiliateLink->product->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($click->affiliateLink?->link_code)
                                    <code class="code-block px-3 py-1 rounded-md text-xs font-mono text-gray-800">{{ $click->affiliateLink->link_code }}</code>
                                @else
                                    <span class="text-sm text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">{{ substr($click->customer->name ?? 'G', 0, 2) }}</span>
                                    </div>
                                    <span class="ml-3 text-sm text-gray-900">{{ $click->customer->name ?? 'Guest' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ optional($click->click_timestamp)->format('M d, Y · H:i') ?? '—' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No clicks recorded yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Share your affiliate links to start tracking clicks.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- ── Pagination ── --}}
        @if($clicks->hasPages())
        <div class="mb-8">{{ $clicks->links() }}</div>
        @endif

        {{-- ── Quick Actions ── --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('affiliate.links', $affiliate->affiliate_code) }}"
               class="group bg-white border border-gray-200 rounded-xl p-6 hover:border-indigo-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-indigo-100">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">View Links</h3>
                <p class="text-sm text-gray-500">Manage your affiliate links</p>
            </a>

            <a href="{{ route('affiliate.commissions', $affiliate->affiliate_code) }}"
               class="group bg-white border border-gray-200 rounded-xl p-6 hover:border-green-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Commissions</h3>
                <p class="text-sm text-gray-500">View your commission history</p>
            </a>

            <a href="{{ route('affiliate.dashboard', $affiliate->affiliate_code) }}"
               class="group bg-white border border-gray-200 rounded-xl p-6 hover:border-purple-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Dashboard</h3>
                <p class="text-sm text-gray-500">Back to performance overview</p>
            </a>
        </div>

    </div>
</body>
</html>