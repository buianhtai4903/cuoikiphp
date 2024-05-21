<?php 
    include("myclass/clstmdt.php");
    $p = new tmdt();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuoi ky</title>
</head>
<body>
    <?php 
        $p->xuatdscty("select*from congty order by tencty asc");
    ?>
</body>
</html>