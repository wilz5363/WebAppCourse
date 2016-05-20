<?php
include 'constant.php';
$title = 'Categories';
$section = 'category';

$all_categories = $conn->prepare('select * from category');
$all_categories->execute();
$categories = $all_categories->fetchAll(PDO::FETCH_ASSOC);


include 'header.php'; ?>

<div class="container">
    <ol class="breadcrumb">
        <li class="active">Category</li>
    </ol>
    <h1 class="page-header">Categories</h1>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name of Categories</th>
            <th>Last Update</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($categories as $category) {
            echo '<tr>'
                . '<td>'.$category['id'].'</td>'
                . '<td>'.$category['name'].'</td>'
                . '<td>'.$category['updated_at'].'</td>'
                . '<td><a href="passages.php?cid='.$category['id'].'">View</a></td>'
                . '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
