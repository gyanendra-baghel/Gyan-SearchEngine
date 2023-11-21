<header class="container">
    <section class="header-section">
        <div class="logo-section">
            <a href="/"><img src="icon/logo.png" alt="Gyan logo" height="40px" /></a>
        </div>
        <form class="search-container" action="\search" method="GET">
            <input type="hidden" name="type" value="<?= $type ?>">
            <input class="search-box" type="text" name="s" autocomplete="off" spellcheck="off" value="<?= $term ?>">
            <button class="search-button">Search</button>
        </form>
    </section>
    <div class="tabs-container">
        <ul class="tab-list">
            <li class="<?= $type == 'site' ? "active" : ""; ?>">
                <a href='search?query=<?= $term ?>&type=site'>Sites</a>
            </li>
            <li class="<?= $type == 'img' ? 'active' : '' ?>">
                <a href='search?query=<?= $term ?>&type=img'>Images</a>
            </li>
            <li class="<?= $type == 'vid' ? 'active' : '' ?>">
                <a href='search?query=<?= $term ?>&type=vid'>Videos</a>
            </li>
        </ul>
    </div>
</header>
<main class="results-section">
    <div class="no-result">
        <p>
            Sorry, no results were found
        </p>
        <h3>Search Suggestions</h3>
        <ul class="">
            <li>Check your spelling</li>
            <li>Try more general words</li>
            <li>Try different words that mean the same thing</li>
        </ul>
    </div>
</main>