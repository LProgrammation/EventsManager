<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($renderData['data']['title']) ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <?php
    foreach ($renderData['styles'] as $stylePath): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($stylePath) ?>">
    <?php endforeach; ?>

    <?php
    foreach ($renderData['head_scripts'] as $s): ?>
        <script src="<?= htmlspecialchars($s) ?>" defer></script>
    <?php endforeach; ?>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <section class="mainContent">
        <?php include $renderData['content']; ?>
        <?php include 'components/footer.php'; ?>
    </section>

    <?php foreach ($renderData['scripts'] as $scriptPath): ?>
        <script src="<?= htmlspecialchars($scriptPath) ?>" defer></script>
    <?php endforeach; ?>

</body>

</html>