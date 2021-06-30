<?php
  $title = "ລາຍງານເບີກຈ່າຍສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php")
?>
<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b><?php echo $title ?></b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
    </div>
    <div style="width: 46%; float: right;" align="right">

        <button type="button" class="btn btn-sm btn-primary">Word </button>
        <button type="button" class="btn btn-sm btn-success">Excel</button>
        <button type="button" class="btn btn-sm btn-danger"> &nbsp; PDF &nbsp;</button> 
    </div>

</div>


<div class="clearfix">
    <!-- button search report -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="date" aria-label="Search" name="da" id="da">
        <input class="form-control form-control-navbar" type="date"aria-label="Search" name="db" id="db">
            <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-outline-warning" id="test">&nbsp;&nbsp; ສະແດງລາຍການ 
                    &nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div><br>
<div id="result"></div>

<script>
$(document).ready(function(){
  load_data('%%','0');
  function load_data(query,page)
  {
    $.ajax({
      url:"fetch_report_distribute.php",
      method:"POST",
      data:{query:query,page:page},
      success:function(data)
      {
        $('#result').html(data);
      }
    });
  }
  $('#search').keyup(function(){
    var page = "0";
    var search = $(this).val();
    if(search != '')
    {
    load_data(search,page);
    }
    else
    {
      load_data('%%',page);
    }
  });
  $(document).on('click', '.page-links', function(){    
    var page = this.id;
    console.log(page);
    var search = $('#search').val();
    if(search != '')
    {
      load_data(search,page);
    }
    else
    {
      load_data('%%',page);
    }
  });
});

</script>


<?php
    include ("../../header-footer/footer.php");
  ?>