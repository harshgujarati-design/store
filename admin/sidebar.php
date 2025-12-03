<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="add-product.php">Add Product</a>
    <a href="orders.php">Orders</a>
    <a href="logout.php">Logout</a>

    <!-- Dark Mode -->
    <button id="adminThemeToggle" class="theme-btn">🌙</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let mode = localStorage.getItem("adminTheme") || "light";

    document.body.classList.toggle("dark", mode === "dark");
    document.getElementById("adminThemeToggle").innerText = mode === "dark" ? "☀️" : "🌙";

    document.getElementById("adminThemeToggle").onclick = function () {
        document.body.classList.toggle("dark");
        let isDark = document.body.classList.contains("dark");
        localStorage.setItem("adminTheme", isDark ? "dark" : "light");
        this.innerText = isDark ? "☀️" : "🌙";
    };
});
</script>
