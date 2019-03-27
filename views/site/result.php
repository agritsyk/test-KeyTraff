<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Results</title>
    <link rel="stylesheet" href="/template/css/style.css">
</head>
<body>
<?php if (isset($ordersList)): ?>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">№ заказа</th>
            <th scope="col">Имя товара</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Имя оператора</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ordersList as $order): ?>
            <tr>
                <th scope="row"><?php echo $order['id']; ?></th>
                <td><?php echo $order['name']; ?></td>
                <td><?php echo $order['price']; ?></td>
                <td><?php echo $order['count']; ?></td>
                <td><?php echo $order['fio']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (isset($productsList)): ?>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Имя товара</th>
            <th scope="col">Общая сумма</th>
            <th scope="col">Общее количество</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($productsList as $product): ?>
            <tr>
                <th scope="row"><?php echo $product['name']; ?></th>
                <td><?php echo $product['price_sum']; ?></td>
                <td><?php echo $product['count_sum']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<div class="text-center">
    <a href="/" class="btn btn-success">Назад</a>
</div>
</body>
</html>