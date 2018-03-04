<div class="row" style="margin: 5px;">
    <div style="text-align: center;">
        <legend><span class="fa fa-camera"></span> Monitoring</legend>
    </div>
</div>

<div class="row" style="margin: 5px;">
    <div class="col-md-1" style="padding-top: 1px">
        &nbsp;
    </div>
    <div class="col-md-10" style="padding-top: 1px">
        <div class="row">
            <div class="col-md-4" style="padding-top: 1px">
               <div style="text-align: center; padding-top: 15px;">
                    <a href="#checkout" onclick="checkout()" data-backdrop="static" data-toggle="modal" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-credit-card"></span> Checkout</a>
               </div>
            </div>
            <div class="col-md-8">
               <div class="panel panel-primary">
                   <div class="panel-body"><strong>Result:</strong> <span style="color: red; font-size: 24px;" id="imageResult">---</span> </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-1">
        &nbsp;
    </div>
</div>

<!--modal for checkout -->
<div class="modal fade" id="checkout">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bgblue">
                <h3 class="panel-title" style="text-align: center;"><span class="glyphicon glyphicon-credit-card"></span> Checkout <a href="#" data-dismiss="modal" class="btn-link tooltip-bottom" title="Close" style="text-decoration: none; float: right;"><span class="glyphicon glyphicon-remove"></span></a></h3>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 5px;">
                    <form method="post" action="#" class="form well">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plate">License Plate:</label>
                                    <input type="text" id="plate" name="plate" class="form-control bgwhite" placeholder="License Plate" readonly>
                                    <input type="hidden" name="pid" id="pid" value=""/>
                                    <input type="hidden" name="service_charge" id="service_charge" value=""/>
                                </div>
                                <div class="form-group">
                                    <label for="arrival">Time of Arrival:</label>
                                    <input type="text" id="arrival" name="arrival" class="form-control bgwhite" placeholder="Arrival" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="departure">Time of Departure:</label>
                                    <input type="text" id="departure" name="departure" class="form-control bgwhite" placeholder="Departure" readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Estimated Amount(GH&cent;):</label>
                                    <input type="text" id="amount" name="amount" class="form-control bgwhite" placeholder="Estimated Amount(GH&cent;)" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="paid">Amount Paid(GH&cent;):</label>
                                    <input type="text" id="paid" name="paid" onkeyup="processBalance()" class="form-control" placeholder="Amount Paid(GH&cent;)">
                                </div>
                                <div class="form-group">
                                    <label for="balance">Balance(GH&cent;):</label>
                                    <input type="text" id="balance" class="form-control bgwhite" placeholder="Balance (GH&cent;)" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-xs btn-success" id="checkoutBtn" name="checkoutBtn"><span class="glyphicon glyphicon-ok"></span> Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin: 5px;">
    <div class="col-md-6">
        <div class="modal-dialog modal-md" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header bgblue">
                    <h3 class="panel-title" style="text-align: center;">
                        Camera View
                    </h3>
                </div>
                <div class="modal-body">
                    <center>
                        <div style="text-align: center; align-items: center;" id="webcam"></div>
                    </center>
                </div>
                <div class="modal-footer">
                    <div style="text-align: center; font-weight: bold;" id="displayTime"><?php echo $this->genDate(); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="modal-dialog modal-md" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header bgblue">
                    <h3 class="panel-title" style="text-align: center;">
                        Captured Image
                    </h3>
                </div>
                <div class="modal-body">
                    <center>
                        <div style="text-align: center; align-items: center;" id="processedImage">
                            <img src="cms/images/noWebcam.png" style="height: 240px; width: auto;"/>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <div style="text-align: center; font-weight: bold;" id="displayDate"><?php echo $this->genDate(); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    if(isset($_POST['checkoutBtn'])){
        $this->checkOut();
    }
?>


<script>
    $('#webcam').html("<img src=\"cms/images/noWebcam.png\" style=\"height: 240px; width: auto;\"/>");
    
    //get current processed image
    setInterval(function(){
        $.post('ajax.php',{'get_processed_image': 'y'}, function(data){
            recv = JSON.parse(data);
            var captured_image = recv.captured_image;
            var processed_image = recv.processed_image;
            var captured_date = recv.date;
            if(captured_image != null){
                $('#processedImage').html("<img src=\"data:image/jpeg;base64," + captured_image + "\" style=\"height: 240px; width: auto;\"/>");
            }

            if(captured_date != null){
                $('#displayDate').html(captured_date);
            }

            if(processedImage != null){
                $('#imageResult').html(processed_image);
            }

        });
    }, 1000);

    function checkout(){
       //getting current license plate reading
       var licensePlate = $('#imageResult').val();
       $.post('ajax.php',{'processCheckOut': 'y', 'plate': licensePlate}, function(data){
            if(data == 0){
                //no data received; disable checkout btn
                $('#checkoutBtn').attr('disabled', 'disabled');
            }else{
                //data received; display data
                recv = JSON.parse(data);
                var arrival = recv.arrival;
                var departure = recv.departure;
                var amount = recv.amount;
                var pid = recv.pid;
                var service_charge = recv.service_charge;

                if(arrival == "" || arrival == null){
                    $('#checkoutBtn').attr('disabled', 'disabled');
                }

                //updating views
                document.getElementById('arrival').value = arrival;
                document.getElementById('departure').value = departure;
                document.getElementById('amount').value = amount;
                document.getElementById('pid').value = pid;
                document.getElementById('service_charge').value = service_charge;

            }
       });
    }

    function processBalance(){
        var amount = $('#amount').val();
        var paid = $('#paid').val();
        //console.log('Amount: ' + amount + '; paid: ' + paid);
        var balance = amount - paid;
        document.getElementById('balance').value = balance;

    }
</script>