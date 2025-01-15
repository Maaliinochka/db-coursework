function openModal() {
    document.getElementById('eventModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('eventModal').style.display = 'none';
}

function editEvent(eventData) {
    document.getElementById('modal-title').innerText = 'Edit Event';
    document.getElementById('event_id').value = eventData.event_id;
    document.getElementById('event_date').value = eventData.event_date;
    document.getElementById('event_time').value = eventData.event_time;
    document.getElementById('location').value = eventData.location;
    document.getElementById('description').value = eventData.description;
    document.getElementById('image_url').value = eventData.image_url;
    document.getElementById('accessibility').value = eventData.accessibility;
    document.getElementById('submitButton').innerText = 'Update Event';
    openModal();
}
