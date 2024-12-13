<html>
<head><title>Update Preferences</title></head>
<body>
<header>
    <h1>Update Preferences</h1>
</header>
<div class="container">
    <form method="POST" action="index.php?action=updatePreferences">
        Customer ID: <input type="text" name="customer_id" required><br>
        Dietary Preferences: <textarea name="dietary_preferences"></textarea><br>
        <button type="submit">Save Preferences</button>
    </form>
</div>
</body>
</html>
