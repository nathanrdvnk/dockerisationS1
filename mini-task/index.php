<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$pdo = db();
$error = null;

try {
    // ADD
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
        $title = trim((string)$_POST['title']);
        if ($title === '') {
            throw new RuntimeException("Le titre est vide (et ça, même Docker peut pas le réparer).");
        }
        $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
        $stmt->execute([':title' => $title]);
        header('Location: /');
        exit;
    }

    // DELETE
    if (isset($_GET['delete'])) {
        $id = (int)$_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
        header('Location: /');
        exit;
    }

    // LIST
    $tasks = $pdo->query("SELECT id, title, created_at FROM tasks ORDER BY id DESC")->fetchAll();
} catch (Throwable $e) {
    $tasks = [];
    $error = $e->getMessage();
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mini Task Manager</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,Segoe UI,Arial;margin:40px;max-width:720px}
    form{display:flex;gap:10px;margin-bottom:20px}
    input{flex:1;padding:10px}
    button{padding:10px 14px;cursor:pointer}
    .task{display:flex;justify-content:space-between;align-items:center;padding:10px;border:1px solid #ddd;border-radius:10px;margin:8px 0}
    .meta{color:#666;font-size:12px}
    .err{background:#ffe8e8;border:1px solid #ffb3b3;padding:10px;border-radius:10px;margin-bottom:15px}
    a{color:#b00020;text-decoration:none}
  </style>
</head>
<body>
  <h1>Mini Task Manager</h1>

  <?php if ($error): ?>
    <div class="err"><strong>Erreur:</strong> <?= htmlspecialchars($error, ENT_QUOTES) ?></div>
  <?php endif; ?>

  <form method="post" autocomplete="off">
    <input name="title" placeholder="Nouvelle tâche..." maxlength="255" required>
    <button type="submit">Ajouter</button>
  </form>

  <?php if (!$tasks): ?>
    <p>Aucune tâche. On est soit très organisé, soit dans le déni.</p>
  <?php else: ?>
    <?php foreach ($tasks as $t): ?>
      <div class="task">
        <div>
          <div><strong>#<?= (int)$t['id'] ?></strong> — <?= htmlspecialchars($t['title'], ENT_QUOTES) ?></div>
          <div class="meta"><?= htmlspecialchars((string)$t['created_at'], ENT_QUOTES) ?></div>
        </div>
        <div>
          <a href="/?delete=<?= (int)$t['id'] ?>" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</body>
</html>
