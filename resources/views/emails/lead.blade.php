<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая заявка с сайта Paraplan</title>
</head>
<body>
    <h2>Новая заявка с сайта Paraplan</h2>

    <p><strong>Имя:</strong> {{ $lead['name'] }}</p>
    <p><strong>Телефон:</strong> {{ $lead['phone'] }}</p>
    <p><strong>Согласие:</strong> Да</p>
    <p><strong>Дата и время:</strong> {{ $submittedAt->format('d.m.Y H:i:s') }}</p>
</body>
</html>
