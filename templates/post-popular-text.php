<p>
    <!-- Вызов функции, обрабатывающей текст -->
    <?= sizePost(htmlspecialchars($row['content'] ?? '')) ?>
</p>
