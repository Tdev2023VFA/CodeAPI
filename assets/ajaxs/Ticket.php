<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Ticket')
    {
        $title = check_string($_POST['title']);
        $content = $_POST['content'];
                if($title==""||$content=="")
                {
                   nnl_error('Vui lòng điền đủ thông tin');
                }
                else
                {
                                $NNL->insert("ticket", array(
                                    'title' => $title,
                                    'content' => $content,
                                    'username' => $getUser['username'],
                                    'time' => gettime()
                                ));
                                nnl_success_time("Gửi yêu cầu thành công, vui lòng đợi admin trả lời", "", 2000);    
                }

    }