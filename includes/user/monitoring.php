<div class="row" style="margin: 5px;">
    <div style="text-align: center;">
        <legend><span class="fa fa-camera"></span> Monitoring</legend>
    </div>
</div>

<div class="row" style="margin: 5px;">
    <div class="col-md-1" style="padding-top: 1px">
        &nbsp;
    </div>
    <div class="col-md-8" style="padding-top: 1px">
        <div class="row">
            <div class="col-md-3" style="padding-top: 1px">
               &nbsp;
            </div>
            <div class="col-md-9">
               <div class="panel panel-primary">
                   <div class="panel-body"><strong>Result:</strong> <span style="color: red; font-size: 24px;" id="imageResult">---</span> </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        &nbsp;
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
</script>