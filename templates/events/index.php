<h1>Events</h1>
<?php foreach ($renderData['data']['events'] as $event): ?>
    <div class="event">
        <h2><?= htmlspecialchars($event['name']) ?></h2>
        <p><?= htmlspecialchars($event['start_date']) ?></p>
        <p>Date: <?= htmlspecialchars($event['end_date']) ?></p>
    </div>
<?php endforeach; ?>