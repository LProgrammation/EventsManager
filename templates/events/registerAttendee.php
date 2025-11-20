<form id="registerForm" method="POST" action="/events/registerSubmit">
    <h1>Register to Events</h1>
    <label for="event">Choisissez un événement :</label>
    <select id="event" name="event_id" required>
        <?php foreach ($renderData['data']['events'] as $event): ?>
            <option value="<?= htmlspecialchars($event['id']) ?>">
                <?= htmlspecialchars($event['name']) ?> (<?= htmlspecialchars($event['location']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="first_name">Prénom :</label>
    <input type="text" id="first_name" name="first_name" required>

    <br><br>

    <label for="last_name">Nom :</label>
    <input type="text" id="last_name" name="last_name" required>

    <br><br>


    <button type="submit">S'inscrire</button>
</form>