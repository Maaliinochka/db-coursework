function openModal() {
    document.getElementById('eventModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('eventModal').style.display = 'none';
}

function editEvent(eventData) {
    document.getElementById('modal-title').innerText = 'Редактирование мероприятия';
    document.getElementById('event_id').value = eventData.event_id;
    document.getElementById('title').value = eventData.title;
    document.getElementById('event_date').value = eventData.date;
    document.getElementById('event_time').value = eventData.time;
    document.getElementById('location').value = eventData.location;
    document.getElementById('description').value = eventData.description;
    document.getElementById('image_url').value = eventData.image;
    document.getElementById('accessibility').value = eventData.accessibility;
    document.getElementById('submitButton').innerText = 'Редактировать';
    openModal();
}
