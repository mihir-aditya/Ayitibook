<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0; 
            padding: 0; 
            background: #f5f7fa; 
        }
        .header { 
            background: linear-gradient(135deg, #dc2626, #b91c1c); 
            color: white; 
            padding: 20px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px; 
        }
        .stats { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px; 
            margin: 20px 0; 
        }
        .stat-card { 
            background: white; 
            padding: 25px; 
            border-radius: 15px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #dc2626;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .stat-card h3 { 
            color: #666; 
            margin: 0 0 10px 0; 
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card .value { 
            font-size: 32px; 
            font-weight: bold; 
            color: #333; 
            margin: 0; 
        }
        .stat-card .icon { 
            font-size: 24px; 
            color: #dc2626; 
            margin-bottom: 15px;
            background: #fee2e2;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
        }
        tr:hover td {
            background: #f9fafb;
        }
        .status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status.completed {
            background: #d1fae5;
            color: #10b981;
        }
        .status.pending {
            background: #fef3c7;
            color: #f59e0b;
        }
        .welcome-message {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        .welcome-message h2 {
            color: #dc2626;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1><i class="fas fa-crown"></i> Admin Dashboard</h1>
            <p>Welcome back, {{ auth()->guard('admin')->check() ? auth()->guard('admin')->user()->name : 'Guest' }}!</p>
        </div>
    </div>
    
    <div class="container">
        @if(session('success'))
        <div class="welcome-message" style="background: #d1fae5; border-left: 4px solid #10b981;">
            <h2 style="color: #10b981;"><i class="fas fa-check-circle"></i> Success!</h2>
            <p>{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="stats">
            <div class="stat-card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3>Total Users</h3>
                <p class="value">{{ \App\Models\User::count() }}</p>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                <h3>Total Orders</h3>
                <p class="value">{{ \App\Models\Order::count() }}</p>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-box"></i></div>
                <h3>Total Products</h3>
                <p class="value">{{ \App\Models\Product::count() }}</p>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                <h3>Total Revenue</h3>
                <p class="value">${{ number_format(\App\Models\Order::where('order_status', 'completed')->sum('total_amount') ?? 0, 2) }}</p>
            </div>
        </div>
        
        <div class="table-container">
            <h2><i class="fas fa-clock"></i> Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Order::orderBy('placed_at', 'desc')->take(5)->get() as $order)
                    <tr>
                        <td>#{{ $order->order_id ?? $order->sl_no }}</td>
                        <td>
                            @if($order->placed_at)
                                {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @if($order->order_status == 'completed')
                                <span class="status completed">Completed</span>
                            @elseif($order->order_status == 'pending')
                                <span class="status pending">Pending</span>
                            @else
                                <span class="status">{{ ucfirst($order->order_status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px;">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #e5e7eb; margin-bottom: 10px;"></i>
                            <p style="color: #9ca3af;">No orders found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        // Auto-refresh page every 60 seconds
        setTimeout(function() {
            location.reload();
        }, 60000);
    </script>
</body>
</html>