<header class="container">
    <section class="header-section">
        <div class="logo-section">
            <a href="/"><img src="icon/logo.png" alt="Gyan logo" height="40px" /></a>
        </div>
        <form class="search-container" action="\search" method="GET">
            <input class="search-box" type="text" name="query" autocomplete="off" spellcheck="off" value="<?= $term ?>">
            <input type="hidden" name="type" value="<?= $type ?>">
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
<main class="results-section" style="margin:0 auto;">
    <p class='results-count'><?= $num_results ?> results found</p>
    <div class='site-results'>
        <?php
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $title = $result['title'];
            $description = $result['description'];
            $url = rtrim($result['url'], '/');
            $pretty_url = preg_replace("/\w\/\w/i", ' › ', $url);
            echo "
        <div class='result-container'>
            <div class='result-header'>
                <div class='url'>$pretty_url</div>
            </div>
            <div class='title'>
                <a href='$url'>$title</a>
            </div>
            <div class='description'>$description</div>
        </div>";
        }
        ?>
        <!-- <p>$timetaken ms time taken"</p> -->
    </div>
</main>