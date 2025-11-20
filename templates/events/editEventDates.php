<form id="editEventDateForm" method="POST" action="/events/updateEventSubmit">
    <h1>Modifier la date d'un événement</h1>
    <label for="event">Choisissez un événement :</label>
    <select id="event" name="event_id" required>
        <?php foreach ($renderData['data']['events'] as $event): ?>
            <option value="<?= htmlspecialchars($event['id']) ?>">
                <?= htmlspecialchars($event['name']) ?> (<?= htmlspecialchars($event['location']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="new_start_date">Nouvelle date de début :</label>
    <input type="date" id="new_start_date" name="new_start_date" required>

    <br><br>

    <label for="new_end_date">Nouvelle date de fin :</label>
    <input type="date" id="new_end_date" name="new_end_date" required>

    <br><br>

    <button type="submit">Modifier</button>
</form>