<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Importar CSV | MiElementos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
          <!-- Botón para regresar -->
      <a href="../index.php">
        <button type="button">Regresar</button>
      </a>
    <div class="card shadow-lg border-0 rounded-3">
      <div class="card-header bg-secondary text-white text-center" >
        <h4><i class="bi bi-bar-chart-line"></i> Importar registros desde archivo CSV</h4>
      </div>
      <div class="card-body">
        <form action="import_csv.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="csv_file" class="form-label">Seleccione un archivo CSV</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success">Importar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
