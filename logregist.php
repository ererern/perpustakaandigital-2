<body>
    <div class="container">
        <div class="forms-container">
            <div class="form-control signup-form">
                <form action="index.php?page=postRegist" method="POST">
                    <h2>Daftar Akun</h2>
                    <input type="text" name="UserID" hidden>
                    <input type="text" name="NamaLengkap" placeholder="Nama Lengkap" required />
                    <input type="text" name="Username" placeholder="Nama Pengguna" required />
                    <input type="email" name="Email" placeholder="Email" required />
                    <input type="text" name="telp" placeholder="No. Telepon" required />
                    <input type="password" name="Password" placeholder="Kata Sandi" required />
                    <input cols="30" rows="5" name="Alamat" placeholder=" Alamat" required></input>
                    <button>Daftar Akun</button>
                </form>

            </div>
            <div class="form-control signin-form">
                <form action="index.php?page=postlogin" method="POST">
                    <h2>Masuk Akun</h2>
                    <input type="text" name="Username" placeholder="Nama Pengguna" required />
                    <input type="password" name="Password" placeholder="Kata Sandi" required />
                    <button>Masuk Akun</button>
                </form>

            </div>
        </div>
        <div class="intros-container">
            <div class="intro-control signin-intro">
                <div class="intro-control__inner">
                    <h2>Selamat Datang!</h2>
                    <p>Untuk mengakses layanan yang tersedia pada aplikasi anda diwajibkan memiliki akun.
                    </p>
                    <button id="signup-btn">Belum Punya Akun? Daftar disini</button>
                </div>
            </div>
            <div class="intro-control signup-intro">
                <div class="intro-control__inner">
                    <h2>Ayo Bergabung!</h2>
                    <p>
                        Untuk mengakses layanan yang tersedia pada aplikasi anda diwajibkan memiliki akun.
                    </p>
                    <button id="signin-btn">Sudah Punya Akun? Silahkan Masuk</button>
                </div>
            </div>
        </div>
    </div>

</body>