document.getElementById('follow-button').addEventListener('click', function () {
    const button = this;
    const userId = button.getAttribute('data-user-id');
    const followerCountElement = document.getElementById('jumlah-follower'); // Ambil elemen follower count

    fetch(`/follow/${userId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'followed') {
                button.textContent = 'Berhenti Mengikuti';
                // Update jumlah follower
                followerCountElement.textContent = data.newFollowerCount;
            } else if (data.status === 'unfollowed') {
                button.textContent = 'Ikuti';
                // Update jumlah follower
                followerCountElement.textContent = data.newFollowerCount;
            }
        })
        .catch(error => console.error('Error:', error));
});