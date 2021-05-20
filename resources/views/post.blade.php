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
                        <form action="{{ route('post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if(session('errors'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Something it's wrong:
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for=""><strong>Nama Wisata</strong></label>
                                    <input type="text" name="namawisata" class="form-control" placeholder="Nama Wisata">
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Alamat</strong></label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Foto</strong></label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                    <input type="text" name="userId" class="form-control" hidden value="{{ Auth::user()->id }}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Post</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>