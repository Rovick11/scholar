<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin_scholarMan.css') }}">
</head>

<body>
    @include('admin_navbar')
    <div class="container">
        <div class="button-container">
            <button class="create-btn" onclick="openModal('createModal')">+ Create</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Eligibility</th>
                    <th>Deadline</th>
                    <th>Funding</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="scholarshipTable"></tbody>
        </table>
    </div>

    <!-- Create Scholarship Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create Scholarship</h3>
                <span class="close" onclick="closeModal('createModal')">&times;</span>
            </div>
            <div class="modal-body">
                <label>Name:</label>
                <input type="text" id="scholarshipName">
                <label>Eligibility:</label>
                <input type="text" id="eligibility">
                <label>Deadline:</label>
                <input type="date" id="deadline">
                <label>Funding:</label>
                <input type="number" id="funding">
            </div>
            <div class="modal-footer">
                <button onclick="addScholarship()">Save</button>
            </div>
        </div>
    </div>

    <!-- Update Scholarship Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update Scholarship</h3>
                <span class="close" onclick="closeModal('updateModal')">&times;</span>
            </div>
            <div class="modal-body">
                <input type="hidden" id="updateIndex">
                <label>Name:</label>
                <input type="text" id="updateName">
                <label>Eligibility:</label>
                <input type="text" id="updateEligibility">
                <label>Deadline:</label>
                <input type="date" id="updateDeadline">
                <label>Funding:</label>
                <input type="number" id="updateFunding">
            </div>
            <div class="modal-footer">
                <button onclick="saveUpdate()">Update</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function addScholarship() {
            let table = document.getElementById('scholarshipTable');
            let row = table.insertRow();
            row.innerHTML = `
                <td>${document.getElementById('scholarshipName').value}</td>
                <td>${document.getElementById('eligibility').value}</td>
                <td>${document.getElementById('deadline').value}</td>
                <td>$${document.getElementById('funding').value}</td>
                <td>
                    <button onclick="updateScholarship(this)">Update</button>
                    <button class="delete-btn" onclick="confirmDelete(this)">Delete</button>
                </td>
            `;
            closeModal('createModal');
        }

        function updateScholarship(btn) {
            let row = btn.parentNode.parentNode;
            document.getElementById('updateIndex').value = row.rowIndex;
            document.getElementById('updateName').value = row.cells[0].innerText;
            document.getElementById('updateEligibility').value = row.cells[1].innerText;
            document.getElementById('updateDeadline').value = row.cells[2].innerText;
            document.getElementById('updateFunding').value = row.cells[3].innerText.replace('$', '');
            openModal('updateModal');
        }

        function saveUpdate() {
            let index = document.getElementById('updateIndex').value;
            let table = document.getElementById('scholarshipTable');
            let row = table.rows[index - 1];
            row.cells[0].innerText = document.getElementById('updateName').value;
            row.cells[1].innerText = document.getElementById('updateEligibility').value;
            row.cells[2].innerText = document.getElementById('updateDeadline').value;
            row.cells[3].innerText = `$${document.getElementById('updateFunding').value}`;
            closeModal('updateModal');
        }

        function confirmDelete(btn) {
            if (confirm("Are you sure you want to delete this scholarship?")) {
                btn.parentNode.parentNode.remove();
            }
        }
    </script>
</body>

</html>