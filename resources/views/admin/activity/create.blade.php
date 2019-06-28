<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>
 <style>
    .scroll{
        overflow-x: hidden; 
        overflow-y: auto;
        height: 100%;  
        width: 100%; 
    }

  </style>
  
</head>
<body>


<div class="scroll">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">添加活动</h2>
       <a class="fr top_rt_btn" href="/activity-index">返回活动列表</a>
      </div>
    
        <form action="active-add" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">活动名称：</span>
        <input type="text" class="textbox textbox_295" name="active_name" placeholder="活动名称..."/>
        <!-- <span class="errorTips">错误提示信息...</span> -->
       </li>
       <li>
        <span class="item_name" style="width:120px;">满多少：</span>
        <input type="text" name="full" class="textbox textbox_150" placeholder="数值类型">
       </li>
       <li>
        <span class="item_name" style="width:120px;">减多少：</span>
        <input type="text" name="subtract" class="textbox textbox_50" placeholder="数值类型">
       </li>
       <li>
        <span class="item_name" style="width:120px;">开始时间：</span>
        <input type="datetime-local" name="start_time" class="textbox textbox_295">
       </li>
       <li>
        <li>
        <span class="item_name" style="width:120px;">截至时间：</span>
        <input type="datetime-local" name="end_time" class="textbox textbox_295">
       </li>
       <li>
        <span class="item_name" style="width:120px;">状态：</span>
        <label class="single_selection"><input type="radio" value="1" name="status"/>启用</label>
        <label class="single_selection"><input type="radio" value="0" name="status"/>不启用</label>
       </li>
       <li>
        <span class="item_name" style="width:120px;">活动描述：</span>
        <script id="editor" name='active_desc' type="text/plain" style="width:1024px;height:500px;margin-left:120px;margin-top:0;"></script>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"  />
       </li>
      </ul>
      </form>
     
 </div>
</div>
<script src="js/ueditor.config.js"></script>
<script src="js/ueditor.all.min.js"> </script>
<script type="text/javascript">

    $(function(){
        UE.getEditor('editor').setHeight(300);
    })
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }
</script>
</body>
</html>

