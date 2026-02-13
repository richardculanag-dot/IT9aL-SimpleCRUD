<?php
include 'components/pdo.php';

$firstname = "";
$lastname = "";
$id = null;
$error = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $firstname = $user["firstname"];
        $lastname = $user["lastname"];
    } else {
        header("Location: view.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
        $error = "Please fill in all fields.";
    } else {
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $id = $_POST["id"];
        
        $sql = "UPDATE users SET firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $id]);
        
        header("Location: view.php?updated=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 mb-4 text-center">Update User</h1>
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" 
                                       id="firstname" 
                                       name="firstname" 
                                       class="form-control" 
                                       placeholder="Enter first name" 
                                       value="<?php echo htmlspecialchars($firstname); ?>"
                                       required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" 
                                       id="lastname" 
                                       name="lastname" 
                                       class="form-control" 
                                       placeholder="Enter last name" 
                                       value="<?php echo htmlspecialchars($lastname); ?>"
                                       required>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning btn-lg">Update User</button>
                                <a href="view.php" class="btn btn-secondary btn-lg">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>