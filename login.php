<div class="row mt-5 mb-5 justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <p class="text-center"><strong>Login Perpustakaan Digital</strong></p>
      </div>
      <form action="index.php?page=postlogin" method="POST" id="logForm">
        <div class="card-body">

          <div class="form-group">
            <label>Nama Pengguna</label>
            <input type="text" class="form-control" name="Username" placeholder="Masukan Nama Pengguna" required>
          </div>

          <div class="form-group">
            <label>Kata Sandi</label>
            <input type="password" class="form-control" name="Password" placeholder="Masukan Kata Sandi" required>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Login</button>
          <hr>
          <center>
            <a href="index.php?page=register">Belum punya akun? Silahkan Daftar terlebih dahulu</a>
          </center>
        </div>
      </form>
    </div>
  </div>

</div>