<body class="login-page" style="height: auto;">
  <div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <p class="text-center"><strong>Register Perpustakaan Digital</strong></p>
          </div>
          <form action="index.php?page=postRegist" method="POST" id="logForm">
            <div class="card-body">
              <div class="form-group">
                <input type="text" class="form-control" name="UserID" hidden>
              </div>
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="NamaLengkap" placeholder="Masukan Nama Lengkap" required>
              </div>
              <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" name="Username" placeholder="Masukan Nama Pengguna" required>
              </div>
              <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" class="form-control" name="Password" placeholder="Masukan Kata Sandi" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="Email" placeholder="Masukan Email" required>
              </div>
              <div class="form-group">
                <label>No telp</label>
                <input type="text" class="form-control" name="telp" placeholder="Masukan No telepon" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="Alamat" class="form-control" cols="30" rows="5" placeholder="Masukan Alamat" required></textarea>
              </div>
              <button name="daftar" type="submit" class="btn btn-primary btn-sm">Daftar</button>
            </div>
            <div class="card-footer">
              <center><a href="index.php?page=login">Sudah Punya Akun? Silahkan Login</a></center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- jQuery -->