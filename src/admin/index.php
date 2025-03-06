<?php
include_once("admin_header.php");

if (!isset($_SESSION['ad'])) {

    echo '<form action = "login.php" method="post">';
    echo '<p>Please login to continue.</p>';
    echo '<label for="uname">Username:</label><br>';
    echo '<input type="text" id="uname" name="uname"><br>';
    echo '<label for="pass">Password:</label><br>';
    echo '<input type="password" id="pass" name="pass"><br>';
    echo '<input type="submit" value="Login">';
    echo '</form>';
} else {
    echo '<h1>Welcome Admin</h1>';
    echo '<p><a href ="/admin/logout.php">Logout</a></p>';
    echo '<br>';
    echo '<p><a href ="/admin/senators/">Edit Senators</a></p>';
    echo '<p><a href ="/admin/committees/">Edit Committees</a></p>';
    echo '<p><a href ="/admin/parties/">Edit Parties</a></p>';
    echo '<p><a href ="/admin/bills/">Edit Bills</a></p>';

    echo '<br>';
    echo '<p><a href ="/admin/bills_committees">Assign Bills to Committees</a></p>';
    echo '<p><a href ="/admin/bills_parties">Assign Bills to Parties</a></p>';
    echo '<p><a href ="/admin/senators_committees">Assign Senators to Committees</a></p>';
    
    echo '<br>';
    echo '<p><a href ="/admin/senate_floor">Senate Floor Functions</a></p>';

    echo '<br>';
    echo '<p><a href ="/admin/bills/bill_list.php">Bill List</a></p>';
    echo '<p><a href ="/admin/parties/party_list.php">Party List</a></p>';
    echo '<p><a href ="/admin/committees/committee_list.php">Committee List</a></p>';

    echo '<h1>Tables for Reference</h1>';
	$da->show_all_tables();
}

include_once("footer.php");
?>