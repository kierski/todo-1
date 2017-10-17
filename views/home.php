<?php include 'header.php' ?>

<div class="col">
    <div class="jumbotron">
        <h4 class="display-4">Todo list</h4>
        <ul>
            <?php foreach ($itemsEl as $item): ?>
            <li>
                <p>
                    <?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <form action="?deleteItem" method="post">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="col">
    <div class="jumbotron">
        <h4 class="display-4">Add item</h4>
        <form class="form" action="?" method="post">
            <div class="form-group mx-sm-3">
                <textarea name="todoItem" id="todoItem"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-primary">Add!</button>
        </form>
    </div>
</div>



<?php include 'footer.php' ?>