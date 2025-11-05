<?php 
include 'koneksi.php'; 
include 'sidebar.php'; 

// Ambil data profil sekolah
$data = $koneksi->query("SELECT * FROM profil_sekolah WHERE id = 1")->fetch_assoc(); 

// Update data
if (isset($_POST['simpan'])) {   
  $visi = $_POST['visi'];   
  $misi = $_POST['misi'];   
  $koneksi->query("UPDATE profil_sekolah SET visi='$visi', misi='$misi' WHERE id = 1");   
  echo "<script>alert('Visi dan Misi berhasil diperbarui.'); window.location='edit_visimisi.php';</script>"; 
} 
?> 

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Visi & Misi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    textarea {
      overflow:hidden;
      resize:none; /* biar user tidak ubah manual */
    }
  </style>
</head>
<body class="bg-light">

<div class="container-fluid" style="margin-left:250px; padding:20px;">

  <!-- Judul -->
  <div class="card shadow mb-4">
    <div class="card-body text-center">
      <h3 class="fw-bold text-primary">
        <i class="fas fa-edit me-2"></i> Edit Visi & Misi Perpustakaan
      </h3>
    </div>
  </div>

  <!-- Form Edit -->
  <div class="card shadow">
    <div class="card-body">
      <form method="POST">
        <div class="row g-4">

          <!-- Visi -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">
              <i class="fas fa-eye text-primary me-2"></i> Visi
            </label>
            <textarea 
              name="visi" 
              class="form-control auto-resize" 
              required><?= htmlspecialchars($data['visi']) ?></textarea>
          </div>

          <!-- Misi -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">
              <i class="fas fa-tasks text-success me-2"></i> Misi
            </label>
            <textarea 
              name="misi" 
              class="form-control auto-resize" 
              required><?= htmlspecialchars($data['misi']) ?></textarea>
          </div>

        </div>

        <!-- Tombol -->
        <div class="text-center mt-4">
          <button type="submit" name="simpan" class="btn btn-primary px-4">
            <i class="fas fa-save me-2"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

</div>

<!-- JS Auto Resize -->
<script>
  document.querySelectorAll(".auto-resize").forEach(function(textarea) {
    textarea.style.height = textarea.scrollHeight + "px";
    textarea.addEventListener("input", function() {
      this.style.height = "auto";
      this.style.height = this.scrollHeight + "px";
    });
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
   