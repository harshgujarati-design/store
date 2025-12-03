<!DOCTYPE html>
<html>
<head>
    <title>Handmade Store</title>
    <link rel="stylesheet" href="/store/public/style.css">
</head>

<script>
let searchBox = document.getElementById("searchBox");
let resultsDiv = document.getElementById("searchResults");

searchBox.onkeyup = function () {
    let term = this.value;

    if (term.length < 1) {
        resultsDiv.style.display = "none";
        return;
    }

    fetch("search_autocomplete.php?term=" + term)
        .then(res => res.json())
        .then(data => {
            resultsDiv.innerHTML = "";
            resultsDiv.style.display = "block";

            if (data.length === 0) {
                resultsDiv.innerHTML = "<p class='no-result'>No results</p>";
                return;
            }

            data.forEach(item => {
                let div = document.createElement("div");
                div.className = "search-item";
                div.innerHTML = `
                    <img src="images/${item.image}">
                    <span>${item.name}</span>
                `;

                div.onclick = () => {
                    window.location.href = "product.php?id=" + item.id;
                };

                resultsDiv.appendChild(div);
            });
        });
};
</script>

<body>
<header>
    <h1>Handmade Crafts Store</h1>
    <div class="search-container">
    <input type="text" id="searchBox" placeholder="Search jewellery...">
    <div class="search-results" id="searchResults"></div>
</div>

    <div class="navbar">
    <div>
        <a href="index.php">Handmade Store</a>
    </div>
    <div>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
    </div>
</div>

    <div class="navbar">

    <div class="nav-left">
        <a href="index.php" class="logo">Handmade Store</a>
    </div>

    <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>

        <!-- Dark Mode Toggle -->
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let mode = localStorage.getItem("theme") || "light";

    document.body.classList.toggle("dark", mode === "dark");
    document.getElementById("themeToggle").innerText = mode === "dark" ? "☀️" : "🌙";

    document.getElementById("themeToggle").onclick = function () {
        document.body.classList.toggle("dark");
        let isDark = document.body.classList.contains("dark");
        localStorage.setItem("theme", isDark ? "dark" : "light");
        this.innerText = isDark ? "☀️" : "🌙";
    };
});
</script>


    <nav>
        <a href="/store/public/index.php">Home</a>
        <a href="/store/public/cart.php">Cart</a>
    </nav>
</header>
