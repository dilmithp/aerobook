<?php
require 'header.php';
if (!isset($_SESSION['adminID'])) {
  header("Location: ../admin-login.php");
  exit();
}
require '../includes/db.inc.php';
?>
<div class="admin-dashboard">
  <h1>Admin Dashboard - User Management</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM users";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['uId'] . "</td>";
          echo "<td>" . $row['fName'] . "</td>";
          echo "<td>" . $row['lName'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['age'] . "</td>";
          echo "<td>" . $row['gender'] . "</td>";
          echo "<td>
                                <a href='edit_user.php?id=" . $row['uId'] . "'>Edit</a> |
                                <a href='#' onclick='confirmDelete(" . $row['uId'] . ")'>Delete</a>
                              </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No users found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Footer -->
<footer>
  <p>Admin@AeroBook © 2024</p>
</footer>

<!-- JS for Delete Confirmation -->
<script src="script.js"></script>
<script>
  // Delete confirmation
  function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
      window.location.href = `delete_user.php?id=${userId}`;
    }
  }

  // Optional: Table sorting (simple version)
  document.addEventListener('DOMContentLoaded', () => {
    const getCellValue = (row, index) => row.children[index].innerText || row.children[index].textContent;

    const comparer = (index, asc) => (a, b) => ((v1, v2) =>
      v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, index), getCellValue(asc ? b : a, index));

    document.querySelectorAll('th').forEach(th => th.addEventListener('click', () => {
      const table = th.closest('table');
      Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr));
    }));
  });
</script>

</body>

</html>