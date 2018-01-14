<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="news.php">News</a></li>
    <li><a target="_blank" href="phpBB3/index.php">Have Your Say</a></li>
    <li><a href="">eMagazine</a>
        <ul>
            <li><a href="mag_access.php">How To Access</a></li>'
            <?php
                $gi_query = "SELECT mi.id, mi.issue, mi.year, mi.title, mi.link FROM mag_issue mi WHERE mi.published=1 ORDER BY mi.id";
                $gi_result = $dbcn->query($gi_query);
                while(list($gi_id,$gi_issue,$gi_year,$gi_title,$gi_link) = $gi_result->fetch_row()) {
                    echo '<li><a target="_blank" href="'.$gi_link.'">Issue '.$gi_issue.': '.$gi_title.'</a><ul>';
                    echo '<li><a target="_blank" href="'.$gi_link.'">Go to Issue '.$gi_issue.'</a></li>';
                    echo '<li><a href="contents.php?ino='.$gi_issue.'">Contents</a></li></ul></li>';
                }
                $gi_result->free();
            ?>
            <li><a href="magsearch.php">Search</a></li>
        </ul>
    </li>
    <li><a href="locoindex.php">Model Loco DB</a></li>
    <li><a target="_blank" href="https://shop.spreadshirt.co.uk/MREMag">MREMag Shop</a></li>
</ul>
