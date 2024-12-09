<script>
  // Fetch usernames from the server when the dropdown is opened
  document.querySelector('.menu-toggle').addEventListener('click', function() {
    fetch("{{ route('users.usernames') }}")
      .then(response => response.json())
      .then(users => {
        const dropdown = document.getElementById('usernames-dropdown');
        dropdown.innerHTML = ''; // Clear existing items
        
        // Loop through the users and create a list item for each username
        users.forEach(user => {
          const li = document.createElement('li');
          li.classList.add('menu-item');
          
          const a = document.createElement('a');
          a.href = "javascript:void(0)";
          a.classList.add('menu-link');
          a.textContent = user.username; // Display username here
          
          li.appendChild(a);
          dropdown.appendChild(li);
        });
      })
      .catch(error => console.error('Error fetching usernames:', error));
  });
</script>