<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uddokta Pay - Code Ecstasy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;600&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Nunito';
        }
        h1{
            font-family: 'Baloo Thambi 2';
            font-weight: 600;
            color: #493ADA;
            font-size: 50px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="text-center">Code Ecstasy</h1>

                @if ( $errors->any() )
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li class="text-danger">{{ $error }}</li>
                        </ul>
                    @endforeach
                @endif

                <form action="{{ route('uddoktapay.pay') }}" class="mt-4" method="POST">

                    @csrf

                    <label for="name" class="mt-2"><b>Name:</b></label>
                    <input name="full_name" type="text" id="name" class="form-control mt-2" value="Code Ecstasy">

                    <label for="email" class="mt-4"><b>Email:</b></label>
                    <input name="email" type="email" id="email" class="form-control mt-2" value="email@example.com">

                    <label for="name" class="mt-4"><b>Amount:</b></label>
                    <input name="amount" type="number" id="name" class="form-control mt-2" value="50">

                    <input type="submit" class="btn btn-primary mt-4">
                </form>

                <p class="small text-center font-bold mt-5">&copy; Copyright {{ date('Y') }} <a href="http://codecstasy.com">Code Ecstasy</a> - All Rights Reserved</p>
            </div>
        </div>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>