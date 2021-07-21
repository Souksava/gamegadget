<?php
  $title = "ສ້າງລາຍງານການນຳເຂົ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
  ?>
<div class="container-fluid font12">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="input-group">
                <input type="date" id="date1" name="date1" class="form-control">
                <input type="date" id="date2" name="date2" class="form-control">
                <div class="input-group-prepend">
                    <button type="button" name="" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6" align="right">
            <div style="width: 100%;">
                <div style="width: 82%;float: left;" align="right">
                    <form action="PDF-Import" method="POST" id="form_pdf" target="_blank">
                        <input type="hidden" name="pdf_date1" id="pdf_date1">
                        <input type="hidden" name="pdf_date2" id="pdf_date2">
                        <button class="btn btn-outline-danger" name="btnPDF" type="submit">PDF</button>
                    </form>
                </div>
                <div  style="width: 18%;float: left;">
                    <form action="Excel-Import" method="POST" id="form_pdf" target="_blank">
                        <input type="hidden" name="excel_date1" id="excel_date1">
                        <input type="hidden" name="excel_date2" id="excel_date2">
                        <button class="btn btn-outline-success" name="btnExcel">Excel</button>
                    </form>
                </div>
            </div>

        </div>
    </div><br>
    <div id="result" class="result"></div>
</div>
<?php
    include ("../../header-footer/footer.php");
    ?>
<script>
function formatDate(date) {
    var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = "0" + month;
    if (day.length < 2)
        day = "0" + day;

    return [year, month, day].join("-");
}
</script>
<script>
$(document).ready(function() {
    load_data("%%", "%%", "0");

    function load_data(date1, date2, page) {
        $.ajax({
            url: "fetch_import.php",
            method: "POST",
            data: {
                date1: date1,
                date2: date2,
                page: page
            },
            success: function(data) {
                $("#result").html(data);
            }
        });
    }
    $('#date1').change(function() {
        var page = "0";
        var date1 = "";
        if (!date1) {
            var date1 = formatDate(new Date($('#date1').val()));
        } else {
            var date1 = null;
        }
        var valueDate = $('#date2').val();
        if (!Date.parse(valueDate)) {
            var date2 = "";
        } else {
            var date2 = formatDate(new Date($('#date2').val()));
        }
        console.log(date1);
        console.log(date2);
        $('#pdf_date1').val(date1);
        $('#pdf_date2').val(date2);
        $('#excel_date1').val(date1);
        $('#excel_date2').val(date2);
        if (date1 != "") {
            load_data(date1, date2, page);
        } else {
            load_data("", date2, page);
        }

    });
    $('#date2').change(function() {
        var page = "0";
        var date2 = "";
        if (!date2) {
            var date2 = formatDate(new Date($('#date2').val()));
        } else {
            var date2 = null;
        }
        var valueDate = $('#date1').val();
        if (!Date.parse(valueDate)) {
            var date1 = "";
        } else {
            var date1 = formatDate(new Date($('#date1').val()));
        }
        console.log(date1);
        console.log(date2);
        $('#pdf_date1').val(date1);
        $('#pdf_date2').val(date2);
        $('#excel_date1').val(date1);
        $('#excel_date2').val(date2);
        if (date2 != "") {
            load_data(date1, date2, page);
        } else {
            load_data(date1, "", page);
        }

    });
    $(document).on('click', '.page-links_table', function() {
        var page = this.id;
        var valueDate = $('#date1').val();
        if (!Date.parse(valueDate)) {
            var date1 = "";
        } else {
            var date1 = formatDate(new Date($('#date1').val()));
        }


        var valueDate2 = $('#date2').val();
        if (!Date.parse(valueDate2)) {
            var date2 = "";
        } else {
            var date2 = formatDate(new Date($('#date2').val()));
        }
        console.log(page);
        if (date1 != "" || date2 != "") {
            load_data(date1, date2, page);
        } else {
            load_data("%%", "%%", page);
        }
    });
   
});
</script>