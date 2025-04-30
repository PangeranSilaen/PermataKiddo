<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Permata Kiddo</title>
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
                <h1>Teacher Dashboard</h1>
                <p>Welcome, {{ Auth::user()->name }}</p>
                @if(Auth::user()->teacher)
                <p>Subject: {{ Auth::user()->teacher->subject ?? 'Not assigned' }}</p>
                @endif
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
                        <h5 class="mb-0">My Classes</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage your class schedule and student attendance.</p>
                        <!-- This section will be expanded with real data later -->
                        <a href="#" class="btn btn-primary">View Classes</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Student Grades</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage and input student grades and evaluations.</p>
                        <!-- This section will be expanded with real data later -->
                        <a href="#" class="btn btn-success">Manage Grades</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Announcements</h5>
                    </div>
                    <div class="card-body">
                        <p>Create and manage announcements for students and parents.</p>
                        <!-- This section will be expanded with real functionality later -->
                        <a href="#" class="btn btn-info">Create Announcement</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Learning Materials</h5>
                    </div>
                    <div class="card-body">
                        <p>Upload and manage learning materials for your classes.</p>
                        <!-- This section will be expanded with real functionality later -->
                        <a href="#" class="btn btn-warning">Manage Materials</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>