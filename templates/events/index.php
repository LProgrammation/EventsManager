<h1>Events</h1>
<?php foreach ($renderData['data']['events'] as $event): ?>
    <div class="eventCard">
        <h2><?= htmlspecialchars($event['name']) ?></h2>
        <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
        <p><strong>Start Date:</strong> <?= htmlspecialchars($event['start_date']) ?></p>
        <p><strong>End Date:</strong> <?= htmlspecialchars($event['end_date']) ?></p>
        <p><strong>Max Attendees:</strong> <?= htmlspecialchars($event['max_attendees']) ?></p>
        <p><strong>Current Attendees:</strong> <?= htmlspecialchars($event['attendees_count']) ?></p>
        <button onclick="location.href='/events/deleteEvent/<?= htmlspecialchars($event['id']) ?>'">Delete Event</button>
    </div>
<?php endforeach; ?>