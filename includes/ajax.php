<?php
	require "functions.php";
	$ajax = new Stratek();
	 if(isset($_POST['edit'])){
        //edit user details
        $ajax->verifyData($_POST['pid'],$_POST['table']);
    }elseif(isset($_POST['updateStatusPid'])){
    	$ajax->updateStatusAdminPid($_POST['pid'],$_POST['table']);
    }elseif(isset($_POST['deleteReq'])){
    	$ajax->deleteReqAdmin($_POST['pid'],$_POST['table']);
    }elseif(isset($_POST['unlock'])){
        $ajax->unlockSession($_POST['unlock']);
    }elseif(isset($_POST['lock'])){
        $ajax->lockSession();
    }elseif(isset($_POST['device_data'])){
        $ajax->addDeviceData();
    }elseif(isset($_POST['get_processed_image'])){
        $ajax->getLatestCapturedImage();
    }elseif(isset($_POST['processCheckOut'])){
        $ajax->processCheckOut();
    }elseif(isset($_POST['loadTransactions'])){
        $ajax->loadTransactions($_POST['loadTransactions'], $_POST['start'], $_POST['end']);
    }
?>