<div class="card">
    <div class="card-body">
        <h1 class="m-0">Info Akun</h1>

        <table class="table">
            <tr>
                <td width="150">Nama Lengkap</td>
                <td width="1">:</td>
                <td><?php echo $_SESSION['data']['NamaLengkap']; ?></td>
            </tr>
            <tr>
                <td>Role</td>
                <td width="1">:</td>
                <td><?php echo $_SESSION['data']['Role']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td width="1">:</td>
                <td><?= $_SESSION['data']['Email']; ?></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td width="1">:</td>
                <td><?= $_SESSION['data']['telp']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td width="1">:</td>
                <td><?= $_SESSION['data']['Alamat']; ?></td>
            </tr>

        </table>
    </div>

</div>