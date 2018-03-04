<div class="row" style="margin: 5px;">
    <div style="text-align: center;">
        <legend><span class="fa fa-credit-card"></span> Transactions</legend>
    </div>
</div>
<div class='row' style='margin: 15px;'>
    <div class='col-md-2'></div>
    <div class='col-md-8'>
        <div class='row'>
            <div class='col-md-5'>
                <input type='text' class='form-control day' onchange="loadTransactions()" style='background-color: #fff;' placeholder='Start Date' id='startDate' readonly='readonly' value='<?php echo $this->genDay(); ?>'/>
            </div>
            <div class='col-md-5'>
                <input type='text' class='form-control day' onchange="loadTransactions()" style='background-color: #fff;' placeholder='End Date' id='endDate' value='<?php echo $this->genDay(); ?>'/>
            </div>
            <div class='col-md-2'>
                <div style='float: left; padding-top: 10px; font-size: 20px;'>
                    <span class='fa fa-search'></span>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'></div>
</div>
<div class="row" style="margin: 15px;" id="result"></div>

<script>
	function loadTransactions(){
		var from = $('#startDate').val();
		var to = $('#endDate').val();
		$.post('ajax.php',{'loadTransactions':'all', 'start':from, 'end': to}, function(data){
			$('#result').html(data);
		});
	}
	loadTransactions();
</script>