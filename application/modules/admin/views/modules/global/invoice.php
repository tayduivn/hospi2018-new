<style>
  tr { -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; transition: all 0.3s ease-out;  }
  #rotatingImg{display: none;}
  .modal-content{box-shadow: none !important;}
  .modal-footer{background-color: #E3E3E3;}
  .btn-circle{border-radius: 50%;font-size: 54px;padding: 0px 12px;}
  .panel-body{padding: 15px;}
  .paybtn { display: inline-block; padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: normal; line-height: 1.428571429; text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; border: 1px solid transparent; border-radius: 2px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; -o-user-select: none; user-select: none; color: #222222; background-color: #EEEEEE; border-color: #DDDDDD; }
  .paybtn:hover { background-color: #DDDDDD;border-color: #AAAAAA;}
  .table-bordered { width: 100%; margin-top: -20px; }
</style>
<div class="modal-dialog modal-lg" style="z-index: 10">
  <div class="modal-content" style="z-index: 1025">
      <div class="header-invoice"><div class="col-md-4">
          <div class="opensans">
              <?php echo trans('0647');?>
          </div>
          </div>
        <div class="col-md-4 text-center"><img src="<?php echo base_url();?>uploads/global/hospi_sm.png" class="logo" data-pin-nopin="true"></div>
        <div class="col-md-4">
            <div class="opensans">www.hospi.vn</div>
            <div class="opensans"><?php echo $contactemail;?></div>
        </div>
        
        </div>
    <div class="clearfix"></div>
    <hr>
    <?php if($invoice->status == "unpaid"){ if(time() < $invoice->expiryUnixtime){  ?>
    <h1 class="text-center">
          <?php echo trans('0643');?><?php echo trans($invoice->module.'hd');?><?php echo trans('0646');?>
      </h1>
    <div class="text-center purple">
      <?php echo trans('0644');?>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10" style="margin-top:10px;">
    <div class="text-justify opensans">
    <?php echo trans('0648');?>
        </div>
    <div class="text-justify opensans">
    <?php echo trans('0649');?>
    </div>
        </div>
    <div class="col-md-1"></div>
    <!--<div class="text-center">
      <div data-wow-delay="2s" class="wow fadeIn animated form-group" id="countdown"></div>
    </div>-->
    <!--<div class="form-group">
      <center>
        <?php if($payOnArrival){ ?>
        <button class="btn btn-default arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>"><?php echo trans('0345');?></button>
        <?php } if($singleGateway != "payonarrival"){ ?>
        <button data-toggle="modal" data-target="#paynow" type="submit" class="btn btn-primary"><?php echo trans('0117');?></button>
        <?php } ?>
        <?php echo getPayment($invoice->paymethod);?>
        
      </center>
    </div>-->
    <?php } } ?>
    <div class="clearfix"></div>
        <div class="opensans" style="padding:10px 20px;"><i>
    <?php echo trans('0650');?>
        </div></i>        
        
   
  
    <div class="modal-body">
      <?php require $themeurl . 'views/invoice.php';?>
        <div class="footer-invoice"><div class="col-md-6">
              <img style="float:right;" src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="img-responsive logo"/>
            </div>
            <div class="col-md-6">
                <div><?php echo trans('Company');?></div>
                <div class="ftitle go-text-right opensans"><?php echo $contactaddress;?></div>
              <div class="ftitle go-text-right opensans">Tel: 08 3920 1111 - Fax: 08 3920 1112</div>
            </div>
            </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<!-- PHPtravels Bank Transfer Modal Starting-->
<div class="modal fade" id="banktrans" tabindex="-1" role="dialog" aria-labelledby="banktrans" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo trans('0355');?></h4>
      </div>
      <div class="modal-body">
        <?php echo "banktransfer"; ?>
      </div>
    </div>
  </div>
</div>
<!-- PHPtravels Bank Transfer Modal Ending-->
<!-- Modal -->
<div class="modal fade" id="paynow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo trans('0377');?></h4>
      </div>
      <div class="modal-body">
        <div role="form">
          <div class="form-group">
            <label for="form-input" class="hidden-xs col-sm-2 control-label text-left" style="padding: 10px;font-size: 18px;"><?php echo trans('0154');?></label>
            <div class="col-sm-10 col-md-10 col-xs-12">
              <select class="form-control form selectx" name="gateway" id="gateway">
                <option value=""><?php echo trans('0159');?></option>
                <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival"){ ?>
                <option value="<?php echo $pay['name']; ?>" <?php makeSelected($invoice->paymethod, $pay['name']); ?> ><?php echo $pay['gatewayValues'][$pay['name']]['name']; ?></option>
                <?php } } ?>
              </select>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-sm-12">
            <hr>
            <center>
              <div  id="response"></div>
            </center>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-12 creditcardform" style="display:none;">
            <form  role="form" action="<?php echo base_url();?>creditcard" method="POST">
              <fieldset>
                <div class="row">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0171');?></label>
                      <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="<?php echo trans('0171');?>">
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0172');?></label>
                      <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="<?php echo trans('0172');?>">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0316');?></label>
                      <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="<?php echo trans('0316');?>" onkeypress="return isNumeric(event)" >
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-3 go-right">
                    <div class="form-group ">
                      <label style="font-size:13px"class="required  go-right"><?php echo trans('0329');?></label>
                      <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
                        <option value="01"><?php echo trans('0317');?> (01)</option>
                        <option value="02"><?php echo trans('0318');?> (02)</option>
                        <option value="03"><?php echo trans('0319');?> (03)</option>
                        <option value="04"><?php echo trans('0320');?> (04)</option>
                        <option value="05"><?php echo trans('0321');?> (05)</option>
                        <option value="06"><?php echo trans('0322');?> (06)</option>
                        <option value="07"><?php echo trans('0323');?> (07)</option>
                        <option value="08"><?php echo trans('0324');?> (08)</option>
                        <option value="09"><?php echo trans('0325');?> (09)</option>
                        <option value="10"><?php echo trans('0326');?> (10)</option>
                        <option value="11"><?php echo trans('0327');?> (11)</option>
                        <option value="12"><?php echo trans('0328');?> (12)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <select class="form-control" name="expYear" id="expiry-year">
                        <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                        <option value="<?php echo $y?>"><?php echo $y; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>">
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <label class="required go-right">&nbsp;</label>
                    <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive">
                  </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <div class="alert alert-danger submitresult"></div>
                  <input type="hidden" name="paymethod" id="creditcardgateway" value="" />
                  <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $invoice->bookingID;?>" />
                  <input type="hidden" name="refno" id="bookingid" value="<?php echo $invoice->code;?>" />
                  <button type="submit" class="btn btn-success btn-lg paynowbtn pull-left" onclick="return expcheck();"><?php echo trans('0117');?></button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  // set the date we're counting down to
  // var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
  var target_date = <?php echo $invoice->expiryUnixtime * 1000; ?>;
  var invoiceStatus = "<?php echo $invoice->status; ?>";

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  //var countdown = document.getElementById('countdown');
  var ccc = new Date().getTime();

  /*if(invoiceStatus == "unpaid"){

      // update the tag with id "countdown" every 1 second
  setInterval(function () {

  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();

  var seconds_left = (target_date - current_date) / 1000;

  // do some time calculations
  days = parseInt(seconds_left / 86400);
  seconds_left = seconds_left % 86400;

  hours = parseInt(seconds_left / 3600);
  seconds_left = seconds_left % 3600;

  minutes = parseInt(seconds_left / 60);
  seconds = parseInt(seconds_left % 60);

  // format countdown string + set tag value
  countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
  + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

  }, 1000);

  }*/


  $(function(){
      $(".submitresult").hide();
      loadPaymethodData();

    $(".arrivalpay").on("click",function(){
      var id = $(this).prop("id");
      var module = $(this).data("module");
      var check = confirm("<?php echo trans('0483')?>");
      if(check){
      $.post("<?php echo base_url();?>invoice/updatePayOnArrival", {id: id,module: module}, function(resp){
        location.reload();
      });

      }

    });

    $('#response').on('click','input[type="image"],input[type="submit"]',function(){
      setTimeout(function(){
      $("#response").html("<div id='rotatingDiv'></div>");
      }, 500)


    });

    $("#gateway").on("change",function(){
      var gateway = $(this).val();
      $("#response").html("<div id='rotatingDiv'></div>");
      $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
       var response = $.parseJSON(resp);
       console.log(response);
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");
       }else{
       $(".creditcardform").hide();
       $("#response").html(response.htmldata);
       }


      });
    })
  });

  function expcheck(){
          $(".submitresult").html("").fadeOut("fast");
       var cardno = $("#card-number").val();
       var firstname = $("#card-holder-firstname").val();
       var lastname = $("#card-holder-lastname").val();
      var minMonth = new Date().getMonth() + 1;
      var minYear = new Date().getFullYear();
      var month = parseInt($("#expiry-month").val(), 10);
      var year = parseInt($("#expiry-year").val(), 10);

       if($.trim(firstname) == ""){
       $(".submitresult").html("Enter Tên").fadeIn("slow");
       return false;
       }else if($.trim(lastname) == ""){
      $(".submitresult").html("Enter Họ").fadeIn("slow");
       return false;
       }else if($.trim(cardno) == ""){
      $(".submitresult").html("Enter Card number").fadeIn("slow");
       return false;
       }else if(month <= minMonth && year <= minYear){
        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");
       return false;

       }else{
         $(".paynowbtn").hide();
        $(".submitresult").removeClass("alert-danger");
        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");
       }

       }

       function loadPaymethodData(){

      var gateway = $("#gateway").val();
      var invoiceStatus = "<?php echo $invoice->status; ?>";

      if(invoiceStatus == "unpaid"){

        if(gateway != ""){

       $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
       var response = $.parseJSON(resp);
       console.log(response);
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");
       }else{
       $(".creditcardform").hide();
       $("#response").html(response.htmldata);
       }
      });
      }
      }
      }
</script>