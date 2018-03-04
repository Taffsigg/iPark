<?php 
	 $service_charge = $this->getServiceCharge();
?>
<div class="row" style="margin: 15px;">
	<div style="text-align: center;"><legend><span class="glyphicon glyphicon-credit-card"></span> Service Charge</legend></div>
</div>

<div id="displayRes" class="row"></div>

<div class="row" style="margin: 15px;">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bgblue">
                    <h3 class="panel-title" style="text-align: center;"><span class="glyphicon glyphicon-credit-card"></span> Service Charge/Minute</h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" class="form" id="printerForm">
                       <div class="form-group">
                            <label for="amount">Amount(GH&cent;):</label>
                            <input type="text" id="amount" name="amount" class="form-control" required='required' value='<?php echo $this->formatNumber($service_charge[1])?>'/>
                            <input type='hidden' id='id' name='id' value='<?php echo $service_charge[0]; ?>'/>
                       </div>
                       <div class="form-group">
                            <div style="text-align: center;">
                                <button type="submit" name="updateBtn" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> Update</button>
                            </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<?php
    if(isset($_POST['updateBtn'])){
        $this->updateServiceCharge();
    }
?>

<script type="text/javascript">
    $(function(){
        $('#printerForm').bootstrapValidator({
            message: 'This is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:{
                ip:{
                    validators:{
                        notEmpty:{
                            message: 'IP Address can\'t be empty'
                        },
                        stringLength:{
                            min: 7,
                            max: 15,
                            message: 'Invalid input length'
                        },
                         regexp:{
                            regexp: /^[0-9\.]+$/,
                            message: 'Invalid IP Address'
                        }
                    }
                },
                port:{
                    validators:{
                        notEmpty:{
                            message: 'Port Address can\'t be empty'
                        },
                        stringLength:{
                            min: 2,
                            max: 5,
                            message: 'Invalid input length'
                        },
                        regexp:{
                            regexp: /^[0-9]+$/,
                            message: 'Invalid Port Address'
                        }
                    }
                }
            }
        });
    });
</script>