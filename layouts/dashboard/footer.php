</section>
</div>

<footer class="main-footer">
    <strong> Perpustakaan Digital 2024 </strong> By Mayoras.

    <style>
        .social-link {
            margin-right: 10px;
            color: inherit;
        }
    </style>

    <div class="float-right d-none d-sm-inline-block">
        <a href="https://github.com/ererern" class="social-link"><i class="fab fa-github"></i></a>
        <a href="https://www.instagram.com/uranusmeren?igsh=MXRjZXZuMTM0dHc4bQ==" class="social-link"><i class="fab fa-instagram"></i></a>
    </div>

</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="Adminv/plugins/jquery/jquery.min.js"></script>

<script src="Adminv/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="Adminv/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Adminv/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="Adminv/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="Adminv/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="Adminv/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Adminv/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Adminv/plugins/jszip/jszip.min.js"></script>
<script src="Adminv/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Adminv/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Adminv/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Adminv/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Adminv/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="Adminv/dist/js/adminlte.min.js?v=3.2.0"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        }).container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>

</html>