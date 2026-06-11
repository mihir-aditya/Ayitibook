@extends('admin.layouts.basic')

@section('title', 'Analytics')
@section('page-title', 'Analytics Dashboard')

@section('content')
<div class="analytics-container">
    <!-- Period Selector -->
    <div class="period-selector" style="margin-bottom: 30px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <label style="font-weight: 500;">Time Period:</label>
            <select id="period-select" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; background: white;">
                <option value="day" {{ request('period') == 'day' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('period', 'month') == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>This Year</option>
            </select>
        </div>
    </div>

    <!-- Charts Container -->
    <div class="charts-grid" style="display: grid; grid-template-columns: 1fr; gap: 30px;">
        <!-- Sales Revenue Chart -->
        <div class="chart-card">
            <div class="chart-header" style="margin-bottom: 20px;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #111827;">Sales Revenue</h3>
            </div>
            <div class="chart-container" style="height: 300px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Orders Chart -->
        <div class="chart-card">
            <div class="chart-header" style="margin-bottom: 20px;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #111827;">Orders</h3>
            </div>
            <div class="chart-container" style="height: 300px;">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="summary-stats" style="margin-top: 40px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            <div class="summary-card" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <div style="font-size: 14px; color: #64748b; margin-bottom: 8px;">Total Revenue</div>
                <div style="font-size: 24px; font-weight: bold; color: #0f172a;">${{ number_format($totalRevenue ?? 0, 2) }}</div>
            </div>
            <div class="summary-card" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <div style="font-size: 14px; color: #64748b; margin-bottom: 8px;">Total Orders</div>
                <div style="font-size: 24px; font-weight: bold; color: #0f172a;">{{ number_format($totalOrders ?? 0) }}</div>
            </div>
            <div class="summary-card" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <div style="font-size: 14px; color: #64748b; margin-bottom: 8px;">Average Order Value</div>
                <div style="font-size: 24px; font-weight: bold; color: #0f172a;">${{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 2) : '0.00' }}</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const periodSelect = document.getElementById('period-select');
    const salesData = @json($sales ?? []);

    // Initialize charts
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');

    let revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: salesData.map(item => item.label),
            datasets: [{
                label: 'Revenue ($)',
                data: salesData.map(item => item.revenue),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    let ordersChart = new Chart(ordersCtx, {
        type: 'bar',
        data: {
            labels: salesData.map(item => item.label),
            datasets: [{
                label: 'Orders',
                data: salesData.map(item => item.orders),
                backgroundColor: '#10b981',
                borderColor: '#059669',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Handle period change
    periodSelect.addEventListener('change', function() {
        const newPeriod = this.value;
        window.location.href = '{{ route("admin.analytics") }}?period=' + newPeriod;
    });
});
</script>

<style>
.analytics-container {
    padding: 20px;
}

.chart-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.chart-container {
    position: relative;
}
</style>
@endsection