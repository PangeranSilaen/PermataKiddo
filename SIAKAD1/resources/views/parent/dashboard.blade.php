<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - Permata Kiddo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="header">
            <div>
                <h1>Parent Dashboard</h1>
                <p>Welcome, {{ Auth::user()->name }}</p>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">My Children</h5>
                    </div>
                    <div class="card-body">
                        <p>View your children's information and academic progress.</p>
                        <!-- This section will be expanded with real data later -->
                        <a href="#" class="btn btn-primary">View Children</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Announcements</h5>
                    </div>
                    <div class="card-body">
                        <p>Stay updated with the latest school news and announcements.</p>
                        <!-- This section will be expanded with real announcements later -->
                        <a href="#" class="btn btn-success">View All</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Schedule</h5>
                    </div>
                    <div class="card-body">
                        <p>View your children's class schedules.</p>
                        <!-- This section will be expanded with real schedule data later -->
                        <a href="#" class="btn btn-info">View Schedule</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Payments</h5>
                    </div>
                    <div class="card-body">
                        <p>View and manage school fee payments.</p>
                        <!-- This section will be expanded with real payment data later -->
                        <a href="#" class="btn btn-warning">View Payments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>