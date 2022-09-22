<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트(제품)/제품 상세</title>
	
	<script src="../../library/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="../../library/jquery-ui-1.13.1.custom/jquery-ui.css">
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
	<script src="../../library/jquery-ui-1.13.1.custom/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../css/style_main.css">

</head>
<body>

    <h3 class="product_list_detail_sub_title">제품 상세</h3>
    <hr class="product_list_detail_sub_hr">
    <br>
        <table class="product_list_detail_view_tbl">
            <tr>
                <td colspan="3" text-align: center; background-color:#e2e2e2; ">
                    프로젝트번호/제품번호/제품명
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    {section name=usr_item loop=$product_item}
                        {$product_item[usr_item].project_id} / {$product_item[usr_item].product_id} / {$product_item[usr_item].product_name}
                    {/section}
                </td>
            </tr>

            {section name=usr_item2 loop=$product_file_item}
            <tr>
                <td style="width:15%;background-color:#e2e2e2;">
                    파일
                </td>
                <td>
                    {$product_file_item[usr_item2].original_name} / {$product_file_item[usr_item2].file_size} 
                </td>
                <td>
                    <a href="product?func=download&uuid={$product_file_item[usr_item2].uuid}">다운로드</a>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:70%;">
                        <tr>
                            <td>
                                아이피주소
                            </td>
                            <td>
                                등록일자
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {$product_file_item[usr_item2].ip}
                            </td>
                            <td>
                                {$product_file_item[usr_item2].regidate} 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            {/section}
            <tr>
                <td colspan="3">
                    <input type="button" class="ui-button ui-widget ui-corner-all btn_submit"
                     value="창닫기" onclick="window.close()" style="width:100%;">
                </td>
            </tr>
        </table>
        
    </form>
</body>
</html>