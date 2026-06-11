<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Dashboard | Enterprise Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background-color: #f3f4f6;
        }
        .stat-card {
            transition: all 0.2s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }
        .metric-card {
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }
        .metric-card:hover {
            border-color: #d1d5db;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }
        .action-button {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        .action-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }
        .action-button:hover::after {
            width: 300px;
            height: 300px;
        }
        .table-header {
            background: linear-gradient(180deg, #f9fafb 0%, #f3f4f6 100%);
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
    <!-- Top Navigation Bar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">Affiliate<span class="text-indigo-600">Pro</span></span>
                    </div>
                    <span class="text-sm text-gray-500">Enterprise Partner Platform</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name ?? 'Guest' }}</span>
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold text-indigo-800">{{ substr(auth()->user()->name ?? 'G', 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Affiliate Performance Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ auth()->user()->name ?? 'Affiliate' }} • Partner since {{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>
            <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export Report
            </button>
        </div>

        <!-- Top Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-gradient-to-br from-emerald-500 to-emerald-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Total Earnings</p>
                    <div class="w-10 h-10 bg-emerald-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">Rs. {{ number_format($totalEarnings, 2) }}</p>
                <p class="text-emerald-100 text-xs mt-2">↑ 12% from last month</p>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">This Month</p>
                    <div class="w-10 h-10 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">Rs. {{ number_format($monthlyEarnings, 2) }}</p>
                <p class="text-blue-100 text-xs mt-2">Monthly recurring revenue</p>
            </div>

            <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-purple-100 text-sm font-medium uppercase tracking-wider">Total Clicks</p>
                    <div class="w-10 h-10 bg-purple-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">{{ number_format($totalClicks) }}</p>
                <p class="text-purple-100 text-xs mt-2">↑ 8.2% conversion rate</p>
            </div>

            <div class="stat-card bg-gradient-to-br from-orange-500 to-orange-700 text-white rounded-xl shadow-lg p-6 cursor-pointer">
                <div class="flex items-center justify-between">
                    <p class="text-orange-100 text-sm font-medium uppercase tracking-wider">Active Links</p>
                    <div class="w-10 h-10 bg-orange-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold mt-4">{{ number_format($totalLinks) }}</p>
                <p class="text-orange-100 text-xs mt-2">Across 3 campaigns</p>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="metric-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Commission Summary</h2>
                    <span class="text-xs text-gray-500">Last 30 days</span>
                </div>
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600">Approved Commissions</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $approvedCommissions }} transactions</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600">Pending Commissions</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $affiliate->commissions()->where('status', 'pending')->count() }} transactions</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600">Paid Commissions</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $affiliate->commissions()->where('status', 'paid')->count() }} transactions</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Total value</span>
                        <span class="font-semibold text-gray-900">Rs. {{ number_format($totalEarnings, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="metric-card bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Account Status</h2>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Active</span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Affiliate Code</span>
                        <code class="code-block px-3 py-1 rounded-md text-sm font-mono text-gray-800">{{ $affiliate->affiliate_code }}</code>
                    </div>
                    {{-- <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Program Tier</span>
                        <span class="text-sm font-semibold text-gray-900 bg-gray-100 px-3 py-1 rounded-full">Gold Partner</span>
                    </div> --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Commission Rate</span>
                        <span class="text-sm font-semibold text-green-600">15% - 25%</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-600">Next Payout</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $affiliate->next_payout_date ?? 'Not scheduled' }}</span>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                    <p class="text-xs text-blue-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{-- Your account is in good standing. All payments processed monthly. --}}
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Commissions Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Recent Commission Activity</h2>
                    <p class="text-xs text-gray-500 mt-1">Latest 10 transactions</p>
                </div>
                <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View All →</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentCommissions as $commission)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">#{{ $commission->order_id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">{{ substr($commission->customer->name ?? 'N/A', 0, 2) }}</span>
                                    </div>
                                    <span class="ml-3 text-sm text-gray-900">{{ $commission->customer->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">Rs. {{ number_format($commission->amount, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $commission->commission_percentage }}%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'approved' => 'bg-green-100 text-green-800',
                                        'paid' => 'bg-blue-100 text-blue-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                @endphp
                                <span class="status-badge {{ $statusColors[$commission->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $commission->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No commissions yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Start sharing your affiliate links to earn commissions.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('affiliate.links', $affiliate->affiliate_code) }}" class="action-button group bg-white border border-gray-200 rounded-xl p-6 hover:border-indigo-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-indigo-100">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">View Links</h3>
                <p class="text-sm text-gray-500">Manage your affiliate links</p>
            </a>

            <a href="{{ route('affiliate.clicks', $affiliate->affiliate_code) }}" class="action-button group bg-white border border-gray-200 rounded-xl p-6 hover:border-purple-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">View Clicks</h3>
                <p class="text-sm text-gray-500">Track click performance</p>
            </a>

            @if(auth('admin')->check())
            <a href="{{ route('admin.affiliate.commissions', $affiliate->id) }}" class="action-button group bg-white border border-gray-200 rounded-xl p-6 hover:border-green-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Commissions</h3>
                <p class="text-sm text-gray-500">Detailed commission report</p>
            </a>

            <a href="{{ route('admin.affiliate.edit', $affiliate->id) }}" class="action-button group bg-white border border-gray-200 rounded-xl p-6 hover:border-yellow-200 hover:shadow-lg transition-all">
                <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Edit Profile</h3>
                <p class="text-sm text-gray-500">Update account settings</p>
            </a>
            @endif
        </div>
    </div>
</body>
</html>