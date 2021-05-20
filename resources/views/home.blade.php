<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 style="color: white;">JakJak</h3>
                </div>
                <div class="card-body">
                    <div class="row align-items-start">
                    <div class="col-3 bg-light">
                    <img src="images/default_dp.jpg" class="rounded" alt="Cinque Terre">
                    <h5><strong>{{ Auth::user()->name }}</strong></h5>
                    <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div class="col-9">
                        @foreach ($wisatas as $wisata)
                            <div class="card">
                            <div class="card-header">
                                <h5>{{ $wisata->nama_wisata }}</h5>
                            </div>
                            <div class="card-body">
                                <img src="images/{{ $wisata->nama_file }}" class="rounded" style="text-align: center;">
                                <table class="table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td sytle="width:  8.33%">Posted by</td><td>: {{ $wisata->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td><td>: {{ $wisata->created_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Likes</td><td>: {{ $wisata->likes }} <button>like</button></td>
                                        </tr>
                                    </tbody>
                                    </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>