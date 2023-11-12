<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/student-profile.css">
	<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
  <title>Document</title>
</head>
<body>

<div class="col-md-4">
    <table class="table2 table-striped">
        <thead>
            <tr>
                <th>Record</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if(!empty($Form_137)) {
                        echo '<i class="bi bi-file-person"></i> Form 137';
                    } else {
                        echo '<i class="bi  bi-file-earmark-check"></i> Form 137  <span style="color:red; font-size:10px">Empty!</span>';
                    } ?>
                </td>
                <td>
                    <?php if($toggleUpload) { ?>
                        <input type="file" name="Form_137_file">
                    <?php } else { ?>
                        <a href="download.php?file=<?php echo $fullname;?>_Form_137.pdf&id=<?php echo $id;?>" class="btn btn-success">Download</a>
                        <a href="view_rec.php?file=<?php echo $fullname;?>_Form_137.pdf" class="btn btn-warning">View</a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if(!empty($Form_138)) {
                        echo '<i class="bi bi-file-person"></i> Form 138';
                    } else {
                        echo '<i class="bi  bi-file-earmark-check"></i> Form 138  <span style="color:red; font-size:10px">Empty!</span>';
                    } ?>
                </td>
                <td>
                    <?php if($toggleUpload) { ?>
                        <input type="file" name="Form_138_file">
                    <?php } else { ?>
                        <a href="download.php?file=<?php echo $fullname;?>_Form_138.pdf&id=<?php echo $id;?>" class="btn btn-success">Download</a>
                        <a href="view_rec.php?file=<?php echo $fullname;?>_Form_138.pdf" class="btn btn-warning">View</a>
                    <?php } ?>
                </td>
            </tr>
            <!-- Add similar code for the other records -->
            <tr>
                <td colspan="2">
                    <label>Toggle Upload:</label>
                    <input type="checkbox" name="toggle_upload" onchange="toggleUpload()">
                </td>
            </tr>
        </tbody>
    </table>
</div>

	
  
