/**
 * Created by mac on 2017/11/20.
 */
/**
 * 读取文件
 * @param obj
 * @param num 0,上传一个文件,1 上传多个文件
 * @returns {boolean}
 */
function read_file(obj, num) {
    //获取input 名称(区分多个上传)
    var input_name = $(obj).attr('name');
    var file = obj.files[0]; //获取file对象
    //判断file的类型是不是图片类型。
    if (!/image\/\w+/.test(file.type)) {
        alert("文件必须为图片！");
        return false;
    }
    var reader = new FileReader(); //声明一个FileReader实例
    reader.readAsDataURL(file); //调用readAsDataURL方法来读取选中的图像文件
    //最后在onload事件中，获取到成功读取的文件内容，并以插入一个img节点的方式显示选中的图片
    reader.onload = function (e) {
        if (num == 0) {
            $("#" + input_name).attr('src', this.result);
        }
    }
    //上传图片
    var file_path = upimg(input_name);
    if (file_path) {
        if (num > 0) {
            var str = '<div class="multi-item">';
            str += '<img src="/upfiles/' + file_path + '" class="img-responsive img-thumbnail" style="width:120px;height:120px" >';
            str += '<input type="hidden" name="info[' + input_name + '][]" value="' + file_path + '">';
            str += '<em class="close" title="删除这张图片" onclick="delimg(this)">×</em>';
            str += '</div>';
            $(obj).parent().parent().prepend(str);
        } else {
            $("input[name='info[" + input_name + "]']").val(file_path);
        }
    } else {
        alert('上传文件失败');
    }
    $(obj).val('');//清空
}

//删除图片
function delimg(obj){
    $(obj).parent().remove();
}


//上传图片
function upimg(input_name) {
    var upfile_url = '/admin/upFile/publicImg';
    var formData = new FormData();
    formData.append('file', $("input[name='"+input_name+"']")[0].files[0]);
    $.ajax({
        url: upfile_url,
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (returndata) {
            console.log(returndata);
            if (returndata.code == 1) {
                file_path = returndata.data.file_path;
            }else{
                file_path = false;
            }
        },
        error: function (returndata) {
            console.log(returndata);

        }

    });
    return file_path;
}

//select2
$('.select2-tag').css('width', '200px').select2({allowClear: true})