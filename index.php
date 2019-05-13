<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'test');
$sql =
    "SELECT
    book.id AS id,
    title AS book_title,
    COUNT(author.id) AS author_count
FROM
    book
LEFT JOIN author_book ON author_book.book_id = book.id
LEFT JOIN author ON author_book.author_id = author.id
GROUP BY id
HAVING author_count > 2
ORDER BY author_count DESC";
$result = $mysqli->query($sql);
?>

<div class="wrap">
<?php while ($book = $result->fetch_assoc()):?>
    <div class="single-card">
        <div class="row">
            <?=$book['book_title']?>
        </div>
        <div class="row">
            Количество соавторов:
        </div>
        <div class="row">
            <b><?=$book['author_count']?></b>
        </div>
    </div>
<?php endwhile; ?>
</div>
<style>
    .single-card {
        display: flex;
        flex-direction: column;
        place-content: space-around;
        width: 200px;
        min-height: 140px;
        margin: 15px 10px;
        padding: 20px 25px 20px 25px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
        background-color: #fff;
    }
    .wrap {
        justify-content: flex-start;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .row {
        text-align: center;
        display: flex;
        flex-direction: column;
    }
    @media screen and (max-width: 900px){
        .single-card {
            width: 100%;
        }
    }
</style>