<!-- pagination.php -->
<nav aria-label="Page navigation">
  <ul class="pagination">
    <!-- Previous Page Link -->
    <li class="page-item">
      <a class="page-link" href="<?= $pagination['prev_page_url'] ?>">Previous</a>
    </li>

    <!-- Page Numbers -->
    <?php for ($i = 1; $i <= $pagination['last_page']; $i++) { ?>
      <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php } ?>

    <!-- Next Page Link -->
    <li class="page-item">
      <a class="page-link" href="<?= $pagination['next_page_url'] ?>">Next</a>
    </li>
  </ul>
</nav>