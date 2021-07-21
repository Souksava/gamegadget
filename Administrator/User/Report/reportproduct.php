<?php
  $title = "ສ້າງລາຍງານສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
?>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <form action="PDF-Product" method="POST" id="form_pdf" target="_blank">
            <input type="hidden" name="pdf_search" id="pdf_search">
            <button class="btn btn-outline-danger" name="btnPDF" type="submit">PDF</button>
        </form>
    </div>
    <div class="col-xs-12 col-sm-6" align="right">
        <form action="Excel-Product" method="POST" id="form_pdf" target="_blank">
            <input type="hidden" name="excel_search" id="excel_search">
            <button class="btn btn-outline-success" name="btnExcel">Excel</button>
        </form>
    </div>
</div><br>
<div id="result_data" class="result_data">
    <?php
           include ($path."header-footer/loading.php");
        ?>
</div>
<?php
    include ("../../header-footer/footer.php");
  ?>

<script>
$(document).ready(function() {
    load_data("%%", "0");

    function load_data(query, page) {
        $.ajax({
            url: "fetch_product.php",
            method: "POST",
            data: {
                query: query,
                page: page
            },
            success: function(data) {
                $("#result_data").html(data);
            }
        });
    }
    $('#search').keyup(function() {
        var page = "0";
        var search = $('#search').val();
        $('#pdf_search').val(search);
        $('#excel_search').val(search);
        if (search != '') {
            load_data(search, page);
        } else {
            load_data('%%', page);
        }
    });
    $(document).on("click", ".page-links_table", function() {
        var page = this.id;
        var search = $('#search').val();
        if (search != "") {
            load_data(search, page);
        } else {
            load_data("%%", page);
        }
    });
});
</script>