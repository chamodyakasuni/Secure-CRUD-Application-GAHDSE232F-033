<?php

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['user_id'])) {
	header("Location: /Secure-CRUD/");
	exit; // Ensure script execution stops after redirection
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>
	body {
    color: #d1d1d1;
    background: #181818;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    display: flex;
    min-height: 100vh;
    overflow-x: hidden;
}

.table-wrapper {
    background: #1e1e1e;
    padding: 25px 30px;
    border-radius: 10px;
    min-width: 1000px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.table-title {
    background: transparent;
    color: #fff;
    padding: 20px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title h2 {
    font-size: 28px;
    font-weight: 600;
    margin: 0;
    color: #fff;
}

.table-title .btn-group {
    display: flex;
}

.table-title .btn {
    color: #fff;
    background: #1abc9c;
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    transition: background 0.3s ease;
}

.table-title .btn:hover {
    background: #16a085;
}

.table-title .btn i {
    margin-right: 10px;
}

table.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table.table th,
table.table td {
    padding: 15px 20px;
    border: none;
    vertical-align: middle;
}

table.table th {
    background: #2c2c2c;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

table.table td {
    background: #232323;
    color: #b0b0b0;
    font-size: 13px;
}

table.table tr {
    transition: background 0.3s ease;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #202020;
}

table.table-hover tbody tr:hover {
    background-color: #2a2a2a;
}

table.table td a {
    font-weight: bold;
    color: #1abc9c;
    transition: color 0.3s ease;
}

table.table td a:hover {
    color: #16a085;
}

table.table td i {
    font-size: 18px;
    color: #d1d1d1;
    transition: color 0.3s ease;
}

table.table td i:hover {
    color: #1abc9c;
}

.pagination {
    display: flex;
    justify-content: flex-end;
    padding: 20px 0;
    margin-top: 20px;
}

.pagination li a {
    color: #b0b0b0;
    background: #232323;
    border: none;
    padding: 10px 15px;
    margin: 0 5px;
    border-radius: 5px;
    transition: background 0.3s ease, color 0.3s ease;
}

.pagination li.active a,
.pagination li.active a.page-link {
    background: #1abc9c;
    color: #fff;
}

.pagination li a:hover {
    background: #16a085;
    color: #fff;
}

.custom-checkbox input[type="checkbox"]:checked+label:before {
    border-color: #1abc9c;
    background: #1abc9c;
}

/* Sidebar Styles */
#sidebar {
    background: #121212;
    color: #fff;
    min-width: 250px;
    transition: all 0.3s;
    font-family: 'Poppins', sans-serif;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #1abc9c;
    text-align: center;
    border-bottom: 1px solid #333;
    font-size: 18px;
    color: #fff;
}

#sidebar ul.components {
    padding: 20px;
    margin: 0;
    list-style: none;
}

#sidebar ul li {
    padding: 15px 20px;
    font-size: 15px;
    display: block;
    transition: background 0.3s;
    border-bottom: 1px solid #2c2c2c;
}

#sidebar ul li:last-child {
    border-bottom: none;
}

#sidebar ul li a {
    color: #b0b0b0;
    display: block;
    text-decoration: none;
    transition: color 0.3s ease, background 0.3s ease;
}

#sidebar ul li a:hover,
#sidebar ul li.active>a {
    color: #fff;
    background: #1abc9c;
    border-radius: 5px;
}

/* Content Styles */
#content {
    width: 100%;
    padding: 40px;
    background: #181818;
    color: #fff;
    transition: all 0.3s;
    min-height: 100vh;
}

/* Navbar Toggle Button */
#sidebarCollapse {
    width: 45px;
    height: 45px;
    background: #1abc9c;
    color: #fff;
    cursor: pointer;
    transition: background 0.3s ease;
    border: none;
    position: absolute;
    top: 15px;
    left: 15px;
    border-radius: 5px;
}

#sidebarCollapse:hover {
    background: #16a085;
}

/* Responsive Styles */
@media (max-width: 768px) {
    #sidebar {
        min-width: 0;
        max-width: 0;
        display: none;
    }

    #sidebar.active {
        min-width: 250px;
        max-width: 250px;
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        z-index: 999;
    }

    #content {
        padding: 20px;
    }

    #sidebarCollapse {
        display: block;
    }
}

</style>
	<script>
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});

			// Activate tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Select/Deselect checkboxes
			var checkbox = $('table tbody input[type="checkbox"]');
			$("#selectAll").click(function () {
				if (this.checked) {
					checkbox.each(function () {
						this.checked = true;
					});
				} else {
					checkbox.each(function () {
						this.checked = false;
					});
				}
			});
			checkbox.click(function () {
				if (!this.checked) {
					$("#selectAll").prop("checked", false);
				}
			});
		});
	</script>
</head>

<body>
	<!-- Sidebar -->
	<nav id="sidebar">
		<div class="sidebar-header">
			<h3>Dashboard</h3>
		</div>
		<ul class="components">
			<li>
				<a href="http://localhost/Secure-CRUD/public/index.php?action=dashboard_product"><i class="fas fa-home"></i> Product</a>
			</li>

			<li class="active">
				<a href="http://localhost/Secure-CRUD/public/index.php?action=dashboard_users"><i
						class="fas fa-user-friends"></i> Users</a>
			</li>
			<li>
				<a href="#"><i class="fas fa-chart-line"></i> Analytics</a>
			</li>
		</ul>
	</nav>

	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Manage <b>Users</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
									class="material-icons">&#xE147;</i> <span>Add New User</span></a>

									<a href = "http://localhost/Secure-CRUD/public/index.php?action=logout" class="btn btn-danger" >Logout</a>
						</div>



					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Role</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$users = $userController->getAllUsers();
						foreach ($users as $user) {
							$status = $user['failed_attempts'] < 3 ? 'Active' : 'Locked';

							$buttonHtml = '';
							if ($status === 'Active') {
								$buttonHtml = '<button class="btn btn-danger" data-user-id="' . htmlspecialchars($user['id']) . '" data-action="lock" onclick="handleAction(this)" data-toggle="tooltip" title="Lock">Lock</button>';
							} else {
								$buttonHtml = '<button class="btn btn-success" data-user-id="' . htmlspecialchars($user['id']) . '" data-action="activate" onclick="handleAction(this)" data-toggle="tooltip" title="Activate">Activate</button>';
							}

							echo '<tr data-user-id="' . htmlspecialchars($user['id']) . '" class="view-details-row">
									<td>' . htmlspecialchars($user['name']) . '</td>
									<td>' . htmlspecialchars($user['email']) . '</td>
									<td>' . htmlspecialchars($user['tele']) . '</td>
									<td>' . htmlspecialchars($user['role']) . '</td>
									<td>' . htmlspecialchars($status) . '</td>
									<td>
										<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
										<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
										' . $buttonHtml . '
									</td>
								</tr>';
						}
						?>


						<script>
							function handleAction(button) {
								const userId = button.getAttribute('data-user-id');
								const action = button.getAttribute('data-action');

								fetch('http://localhost/Secure-CRUD/public/index.php?action=updateStatus', {
									method: 'POST',
									headers: {
										'Content-Type': 'application/x-www-form-urlencoded',
									},
									body: `user_id=${encodeURIComponent(userId)}&action=${encodeURIComponent(action)}`
								})
									.then(response => response.text())
									.then(text => {
										console.log('Raw response:', text);
										let data;
										try {
											data = JSON.parse(text);
										} catch (error) {
											console.error('Error parsing JSON:', error);
											alert('An error occurred. Please try again later.');
											return;
										}

										if (data.success) {
											window.location.href = 'http://localhost/Secure-CRUD/public/index.php?action=dashboard_users'; // Redirect to the desired URL
										} else {
											alert('Failed to update user status. Please try again.');
										}
									})
									.catch(error => {
										console.error('Error:', error);
										alert('An error occurred. Please try again later.');
									});
							}
						</script>





					</tbody>
				</table>

			</div>
		</div>
	</div>
	<!-- Add Employee Modal -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="http://localhost/Secure-CRUD/public/index.php?action=register" method="POST">

						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="Enter employee name"
								required>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Enter employee email"
								required>
						</div>

						<div class="form-group">
							<label>Phone</label>
							<input type="number" name="tele" class="form-control" placeholder="Enter employee Tele No"
								required>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="text" name="password" class="form-control"
								placeholder="Enter employee Password" required>
						</div>

						<div class="form-group">
							<label for="role">Role</label>
							<select name="role" class="form-control" name="role" id="role" required>
								<option value="admin">Admin</option>
								<option value="editor">Editor</option>
								<option value="user">User</option>
							</select>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>

					</form>

				</div>

			</div>
		</div>
	</div>

	<!-- Edit Employee Modal -->
	<div id="editEmployeeModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editUserForm">
						<input type="hidden" id="editUserId">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" id="editName">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" id="editEmail">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" id="editPhone">
						</div>
						<div class="form-group">
							<label>Role</label>
							<select class="form-control" id="editRole">
								<option value="">Select Role</option>
								<option value="admin">Admin</option>
								<option value="user">User</option>
								<option value="manager">Manager</option>
								<!-- Add more roles as needed -->
							</select>
						</div>

						<div class="form-group">
							<label>Status</label>
							<input type="text" class="form-control" id="editStatus">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="updateUserBtn" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>



	<script>
		// When 'Edit' button is clicked
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.edit').forEach(button => {
				button.addEventListener('click', function () {
					const row = this.closest('tr');
					// Fetch the user data from the row's cells
					const userId = row.dataset.userId;
					const name = row.querySelector('td:nth-child(1)').textContent.trim();
					const email = row.querySelector('td:nth-child(2)').textContent.trim();
					const phone = row.querySelector('td:nth-child(3)').textContent.trim();
					const role = row.querySelector('td:nth-child(4)').textContent.trim();
					const status = row.querySelector('td:nth-child(5)').textContent.trim();

					// Populate the form in the modal
					document.getElementById('editUserId').value = userId;
					document.getElementById('editName').value = name;
					document.getElementById('editEmail').value = email;
					document.getElementById('editPhone').value = phone;

					// Set the role in the select dropdown
					const roleSelect = document.getElementById('editRole');
					for (let option of roleSelect.options) {
						if (option.value === role) {
							roleSelect.value = option.value;
							break;
						}
					}

					document.getElementById('editStatus').value = status;

					// Show the modal
					$('#editEmployeeModal').modal('show');
				});
			});
		});

		// Handle the form submission for updating user
		document.getElementById('updateUserBtn').addEventListener('click', function (event) {
			event.preventDefault();  // Prevent default button behavior

			const userId = document.getElementById('editUserId').value;
			const userName = document.getElementById('editName').value;
			const userEmail = document.getElementById('editEmail').value;
			const userPhone = document.getElementById('editPhone').value;
			const userRole = document.getElementById('editRole').value;
			const userStatus = document.getElementById('editStatus').value;

			fetch('http://localhost/Secure-CRUD/public/index.php?action=updateUser', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: `id=${encodeURIComponent(userId)}&name=${encodeURIComponent(userName)}&email=${encodeURIComponent(userEmail)}&tele=${encodeURIComponent(userPhone)}&role=${encodeURIComponent(userRole)}&status=${encodeURIComponent(userStatus)}`
			})
				.then(response => response.text())
				.then(text => {
					console.log('Raw response:', text);
					let data;
					try {
						data = JSON.parse(text);
					} catch (error) {
						console.error('Error parsing JSON:', error);
						alert('An error occurred. Please try again later.');
						return;
					}

					if (data.success) {
						$('#editEmployeeModal').modal('hide');  // Close the modal
						window.location.href = 'http://localhost/Secure-CRUD/public/index.php?action=dashboard_users';  // Redirect to the dashboard
					} else {
						alert('Failed to update user. Please try again.');
					}
				})
				.catch(error => {
					console.error('Error:', error);
					alert('An error occurred. Please try again later.');
				});
		});
	</script>



	<!-- Delete Employee Modal -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this user?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
					<input type="hidden" id="deleteUserId">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="deleteUserBtn">Delete</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		// When 'Delete' button is clicked, open the modal and set userId
		document.querySelectorAll('.delete').forEach(button => {
			button.addEventListener('click', function () {
				const row = this.closest('tr');
				const userId = row.dataset.userId;
				document.getElementById('deleteUserId').value = userId;
			});
		});

		// Handle delete action
		document.getElementById('deleteUserBtn').addEventListener('click', function () {
			const userId = document.getElementById('deleteUserId').value;
			fetch('http://localhost/Secure-CRUD/public/index.php?action=deleteUser', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: `id=${encodeURIComponent(userId)}`
			})
				.then(response => response.text())  // Capture the response as plain text first
				.then(text => {
					console.log('Raw response:', text);  // Log raw response to debug
					let data;

					// Try to parse JSON response
					try {
						data = JSON.parse(text);
					} catch (error) {
						console.error('Error parsing JSON:', error);
						alert('An error occurred. Please try again later.');
						return;  // Exit if JSON parsing fails
					}

					// Check for success key in parsed data
					console.log('Parsed response:', data);  // Log parsed data for debugging
					if (data.success) {
						$('#deleteEmployeeModal').modal('hide');
						window.location.href = 'http://localhost/Secure-CRUD/public/index.php?action=dashboard_users';
					} else {
						alert('Failed to delete user. Please try again.');
					}
				})
				.catch(error => {
					console.error('Error:', error);
					alert('An error occurred. Please try again later.');
				});
		});


	</script>


</body>

</html>