<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver entrada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label for="">Quantidade</label>
            <input class="form-control" type="text" value="{{ $input->amount }}" disabled>
        </div>
        <div class="form-group">
            <label for="">Nome do produto</label>
            <input class="form-control" type="text" value="{{ $input->product->name }}" disabled>
        </div>
    </div>
</body>

</html>