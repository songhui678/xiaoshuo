<?php
//����һ���ļ��ϴ����е��ϴ���
include "fileupload.class.php";

$up = new fileupload;
//��������(�ϴ���λ�ã� ��С�� ���ͣ� �����Ƿ�Ҫ�������)
$up->set("maxsize", 2000000);
$up->set("allowtype", array("gif", "png", "jpg", "jpeg", "doc", "docx", "pdf"));
$up->set("israndname", false);

//ʹ�ö����е�upload������ �Ϳ����ϴ��ļ��� ������Ҫ��һ���ϴ��������� pic, ����ɹ�����true, ʧ�ܷ���false
if ($up->upload("file")) {
    //��ȡ�ϴ����ļ�����
    echo json_encode($up->getFileName());

} else {
    //��ȡ�ϴ�ʧ���Ժ�Ĵ�����ʾ
    echo json_encode($up->getErrorMsg());
    echo 'fail';
}
