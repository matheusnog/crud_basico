<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver produto</title>
</head>

<body>
    {{$product->inputs->where('product_id', '1')->last()}}
    <h1>Entradas do produto: {{ $product->name }}</h1>
    @foreach($product->inputs as $input)
    <p>Data: {{ $input->date }}</p>
    @endforeach
</body>

</html>