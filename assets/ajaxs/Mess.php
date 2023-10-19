<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Ticket')
    {
        $content = $_POST['content'];
        $id = $_POST['id'];
                if($content=="")
                {
                   nnl_error('Vui lòng điền đủ thông tin');
                }
                else
                {
                                $NNL->insert("messticket", array(
                                    'id_mess' => $id,
                                    'content' => $content,
                                    'username' => $getUser['username'],
                                    'time' => gettime()
                                ));
                                nnl_success_time("Gửi yêu cầu thành công, vui lòng đợi admin trả lời", "", 2000);    
                }

    }