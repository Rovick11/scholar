function toggleNotifications() {
    var dropdown = document.getElementById('notificationDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.notification, .notification *')) {
        var dropdown = document.getElementById('notificationDropdown');
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    }
}

function toggleChatBox() {
    const chatBox = document.getElementById('chatBox');
    if (chatBox.style.display === 'none' || chatBox.style.display === '') {
        chatBox.style.display = 'flex';
    } else {
        chatBox.style.display = 'none';
    }
}

   function showPopup() {
        document.getElementById("popup").style.display = "block";
        document.getElementById("overlay").style.display = "block";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
        document.getElementById("overlay").style.display = "none";
    }

    function saveDetails() {
        let lastName = document.getElementById("last-name").value;
        let firstName = document.getElementById("first-name").value;
        let middleName = document.getElementById("middle-name").value;
        let email = document.getElementById("email").value;
        let phone = document.getElementById("phone").value;
        let birthDate = document.getElementById("birth-date").value;

        alert("Details Saved!\n" +
            "Last Name: " + lastName + "\n" +
            "First Name: " + firstName + "\n" +
            "Middle Name: " + middleName + "\n" +
            "Email: " + email + "\n" +
            "Phone: " + phone + "\n" +
            "Birth Date: " + birthDate);
        
        closePopup();
    }