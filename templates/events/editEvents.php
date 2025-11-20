<h1>Modifier la date d'un événement</h1>
<form id="editEventForm" method="POST" action="/events/updateEventSubmit">
    <label for="event">Choisissez un événement :</label>
    <select id="event" name="event_id" required>
        <?php foreach ($renderData['data']['events'] as $event): ?>
            <option value="<?= htmlspecialchars($event['id']) ?>">
                <?= htmlspecialchars($event['name']) ?> (<?= htmlspecialchars($event['location']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="new_date">Nouvelle date :</label>
    <input type="date" id="new_date" name="new_date" required>

    <br><br>

    <button type="submit">Modifier</button>
</form>
