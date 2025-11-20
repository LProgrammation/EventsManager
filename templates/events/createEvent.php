<form id="createEventForm" method="POST" action="/events/createEventSubmit">
    <h1>Créer un évenements</h1>
    <label for="event_name">Nom de l'événement :</label>
    <input type="text" id="event_name" name="event_name" required>

    <br><br>

    <label for="event_location">Lieu de l'événement :</label>
    <input type="text" id="event_location" name="event_location" required>

    <br><br>

    <label for="start_date">Date de début :</label>
    <input type="date" id="start_date" name="start_date" required>

    <br><br>

    <label for="end_date">Date de fin :</label>
    <input type="date" id="end_date" name="end_date" required>

    <br><br>

    <label for="max_attendees">Nombre maximum de participants :</label>
    <input type="number" id="max_attendees" name="max_attendees" max="30" required>

    <br><br>

    <button type="submit">Créer l'événement</button>
</form>