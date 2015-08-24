var home_dirty = true,
	ani_index = 0,
	all_ani_dirty = false,
	textAreaMaxHeight = 600,
	tutorial_overview = true,
	tutorial_index = 0,
	tutorial_array = [],
	mouseOverText = {
		"pastel":"Pastel",
		"lovely":"Lovely",
		"modern":"Modern",
		"cyber":"Cyber",
		"simple":"Simple"
	};

var demoEvent = function(role, target, type, handler){
	var event;

	if(role == "add"){
		event = "addEventListener";
		if(!window[event]){
			event = "attachEvent";
			type = "on" + type;
		}
	}else{
		event = "removeEventListener";
		if(!window[event]){
			event = "detachEvent";
			type = "on" + type;
		}
	}
	if(window[event])
		target[event](type, handler);
};

function activeMenu(menu){
	if(menu === active_menu)
		return;
	
	if(active_menu)
		changeCss(active_menu, ".non_active_menu");
	
	changeCss(menu, ".active_menu");
	active_menu = menu;
	
	if(home_dirty){
		if(menu.parentNode === _$("chart_type"))
			displayNoneElem = _$("prop_content");
		else
			displayNoneElem = _$("type_content");

		playEffect(displayNoneElem, {"height":displayNoneElem.scrollHeight}, {"height":0}, titleSlideEnd, 800);
		home_dirty = false;
	}
}

function activeMainLi(item,f){
	var li = active_main_li,
		activeContentName = _$("active_content_name");
	if(item === li)
		return;
	
	if(li)
		changeCss(li, ".non_active_main_li");
	
	changeCss(item, ".active_main_li");
	active_main_li = item;


	activeContentName.innerHTML = item.name;

	createSubMenuItem(item.childs,f);
	
	if(!open_sub_menu){
		set(_$("title_eng"), "display", "block");
		changeCss(_$("main_menu"), ".active_main_menu_border");
		if(item.over){
			playEffect(_$("menu"), {"width":171}, {"width":321}, endSlide2, 800);
		}else{
			playEffect(_$("menu"), {"width":171}, {"width":321}, endSlide, 800);
		}		
	}
}

function activeSubLi(item){
	var li = active_sub_li,sampleStr="";
	if(item === li)
		return;
	if(li)
		changeCss(li, ".non_active_sub_li");
	changeCss(item, ".active_sub_li");
	active_sub_li = item;

	sampleStr = item.innerHTML.replace('<br>',' ');
	
	if(/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/.test(sampleStr)){
		changeCss(_$("sample_name"),".sample_name_han");
	}else{
		changeCss(_$("sample_name"),".sample_name_eng");
	}

	_$("type_name").innerHTML = _$("active_content_name").innerHTML.replace('<br>',' ');
	_$("sample_name").innerHTML = sampleStr;
}

function createMenuItem(id, items,f){
	var ul,
		type,
		i, n, e,
		p = _$(id),
		html = "<ul>";

	for(i = 0, n = items.length ; i < n ; i += 1){
		html += "<li>" + items[i].n + "</li>";
	}

	html += "</ul>";
	p.innerHTML = html.replace('<br>',' ');

	ul = p.childNodes[0];
	type = id.indexOf("type") > -1 ? "type_title" : "prop_title";

	for(i = 0, n = ul.childNodes.length ; i < n ; i += 1){
		e = ul.childNodes[i];
		e.name = items[i].n; 
		if(type == "type_title")
			e.name += " Chart";
		e.childs = items[i].c;
		e.titleTarget = type;
		e.f = f;
		demoEvent("add", e, "click", menuItemClick);
	}
	
}

function createSubMenuItem(items,f){
	var i, n, ul,
		html = "<ul>",
		p = _$("active_content_childs");

	if(p.childNodes && p.childNodes.length > 0){
		ul = p.childNodes[0];
		for(i = ul.childNodes.length - 1; i > -1 ; i -= 1){
			demoEvent("remove", ul.childNodes[i], "click", subMenuItemClick);
		}
	}
	
	for(i = 0, n = items.length ; i < n ; i += 1){
		html += "<li>" + items[i].n + "</li>";
	}

	html += "</ul>";
	_$("active_content_childs").innerHTML = html;
	
	ul = p.childNodes[0];
	for(i = 0, n = ul.childNodes.length ; i < n ; i += 1){
		e = ul.childNodes[i];
		e.url = items[i].u;
		e.f = f;
		demoEvent("add", e, "click", subMenuItemClick);
	}
}

function subMenuItemClick(e){
	var i,j,nt,type,flag = false,
		theme = _$("theme_div"),
		tuto = _$("tutorial_div");
	if(all_ani_dirty)
		return;

	if(get(tuto,"width") > 0){
		endTutorial();
	}

	var target = e.target || e.srcElement,
		overview = _$("overview");

	if(overview.style.display != "none"){
		set(overview, "display", "none");
		set(_$("chart_sample"), "display", "block");
	}
	
	for(i = 0 ; i < none_theme.length ; i++){
		type = none_theme[i];
		for(j = 0 ; j < type.c.length; j++){
			if(type.c[j].u == target.url){
				flag = true;
				nt = type.c[j].t;
				break;
			}
		}
	}
	set(theme,"display","block");
	if(target.f || flag){
		if(nt){
			for(i = 0 ; i < nt.length ; i++){
				if(nt[i] == -1){
					set(theme,"display","none");
					break;
				}else{
					set(theme.children[nt[i]],"display","none");
				}
			}
		}else{
			set(theme,"display","none");
		}
		
	}else{		
		for(i = 0 ; i < theme.children.length ; i++){
			set(theme.children[i],"display","block");
		}
	}
	activeSubLi(target);
	changeContent(target.url);
}

	function addImageEvent(){
		var pastel = _$("pastel"),
			lovely = _$("lovely"),
			modern = _$("modern"),
			cyber = _$("cyber"),
			simple = _$("simple");
		
		demoEvent("add", pastel, "mouseover", mouseHandler);
		demoEvent("add", lovely, "mouseover", mouseHandler);
		demoEvent("add", modern, "mouseover", mouseHandler);
		demoEvent("add", cyber, "mouseover", mouseHandler);
		demoEvent("add", simple, "mouseover", mouseHandler);
	}

function mouseHandler(e){
	var type = e.type,
		relatedTarget = e.relatedTarget,
		target = e.target || e.srcElement;

	switch(type){
		case "mouseover" : 
			var contentDiv = document.createElement("div");
			
			contentDiv.style.position = "absolute";
			contentDiv.style.height = "20px";
			contentDiv.style.cursor = "default";
			contentDiv.style.border = "1px solid #ebebeb";
			contentDiv.style.fontFamily = "arial";
			contentDiv.style.fontSize = "11px";
			contentDiv.style.color = "#666666";
			contentDiv.innerHTML = mouseOverText[target.id];
			contentDiv.style.backgroundColor = "#ffffff";
			contentDiv.style.padding = "2px 4px 2px 4px";
			document.body.appendChild(contentDiv);

			contentDiv.style.left = getElemX(target) + "px";
			contentDiv.style.top = getElemY(target) + target.offsetHeight * 0.5 + Number(contentDiv.style.height.replace(/px/,"")) + "px";

			target.popup = contentDiv;

			demoEvent("add", target, "mouseout", mouseHandler);
		break;

		case "mouseout" :
			document.body.removeChild(target.popup);
			target.popup = null;
			demoEvent("remove", target, "mouseout", mouseHandler);
		break;
		
		default:
	}
}

function getElemX(elem){
	var pt = elem.offsetLeft;
	while(elem.parentNode){
		pt += elem.parentNode.offsetLeft || 0;
		elem = elem.parentNode;
	}
	return pt;
}

function getElemY(elem){
	var pt = elem.offsetTop;
	while(elem.parentNode){
		pt += elem.parentNode.offsetTop || 0;
		elem = elem.parentNode;
	}
	return pt;
}

function menuItemClick(e){
	if(all_ani_dirty)
		return;

	var target = e.target || e.srcElement;
	activeMenu(_$(target.titleTarget));
	activeMainLi(target,target.f);
}

function createChartType(){
	createMenuItem("default_type", default_types,false);
	createMenuItem("premium_type", premium_types,false);
}

function createChartProp(){
	createMenuItem("prop_content", props,true);
}

function createImage(){
	var i, n,
		count = 0,
		className,
		html = "";

	for(i = 0, n = images.length ; i < n ; i += 1){
		count++;

		className = "overview_image";
		if(count % 3 == 0)
			className += " overview_image_last";
		
		html += '<div class="' + className + '"id="img_'+images[i].u+'" style="background:url(./Samples/Web/Images/' + images[i].u + '.png) no-repeat"><span id="image_name">' + images[i].n + '</span></div>';
	}
	_$("overview").innerHTML = html;
}

function changeContent(url){
	var div = _$("content_chart"),
		contentIFrame = _$("content_iframe"),
		frame = document.createElement("iframe");
	
	if(contentIFrame){
		contentIFrame.parentNode.removeChild(contentIFrame);
		contentIFrame = null;
	}

	demoEvent("add", frame, "load", frameloadHandler);	

	frame.id = "content_iframe";
	frame.frameBorder = 0;
	frame.marginWidth = 0;
	frame.marginHeight = 0;
	frame.src = baseurl + url + ".html";

	div.appendChild(frame);
}

function removeIFrame(frame){
	var heads, childs,
		removeChild = function(cs){
			var i, n, child;
			for(i = cs.length - 1, n = -1 ; i > n ; i -= 1){
				child = cs[i];
				if(child.childNodes.length > 0)
					removeChild(child.childNodes);
				if(!/KoolChart/.test(child.className))
					child.parentNode.removeChild(child);
			}
		};
	
	try{
		heads = frame.contentWindow.document.head.childNodes;
		childs = frame.contentWindow.document.body.childNodes;

		removeChild(heads);
		removeChild(childs);
		
		for(var o in frame.contentWindow){
			if(o == "location"){
				continue;
			}else{
				frame.contentWindow[o] = null;
			}
			
		}
	}catch(e){}
	
	frame.parentNode.removeChild(frame);
	frame = null;
}	

function frameloadHandler(e){
	var iframe = e.target || e.srcElement,
		url,str,i,n,layoutStr,chartData,
		contentChart = _$("content_chart");

	n = checkUrl(iframe);
	
	if(!iframe.contentWindow){
		return;
	}
	if(iframe.contentWindow.layoutStr){
		layoutStr = inputTab(iframe.contentWindow.layoutStr);
	}	
	if(iframe.contentWindow.chartData){
		chartData = objectToString(iframe.contentWindow.chartData);
	}
	
	if(n == 1){
		layoutStr = "You cannot modify the layout of this sample.";
	}else if(n == 2){
		chartData = "You cannot modify the data of this sample.";
	}else if(n == 3){
		layoutStr = "You cannot modify the layout of this sample.";
		chartData = "You cannot modify the data of this sample.";
	}else{
		
	}
	
	contentChart.style.height = "0px";
	var frameHeight = contentChart.offsetHeight;
	
	for(i = 0 ; i < iframe.contentWindow.document.body.childNodes.length ; i++){
		if(iframe.contentWindow.document.body.childNodes[i].offsetHeight){
			frameHeight += iframe.contentWindow.document.body.childNodes[i].offsetHeight;
		}		
	}
	contentChart.style.height = frameHeight + 15 + "px";
	textAreaSetValue(layoutStr, chartData,n);
	
	demoEvent("remove", contentChart, "load", frameloadHandler);
}

function checkUrl(iframe){
	var url,str;
	url = iframe.src;
	str = url.split("/");
	for(i = 0 ; i < str.length ; i++){
		if(str[i].indexOf(".html")>0){
			url = str[i];
		}
	}
	url = url.split(".")[0];	
	
	var n = 0;
	if(url == "Dual_Chart2" ||
		url =="Dual_Chart" ||
		url =="Zoom_Real_Time" ||
		url =="CategoryAxis_CanDropLabels" ||
		url =="Line_Area_Label" ||		
		url =="Dynamic_Change_Both" ||
		url =="Dynamic_Change_Data" ||
		url =="Dynamic_Change_Layout" ||
		url =="Embeding_chartVars" ||
		url =="Embeding_URL_Array"){

		n = 1;
	}
	else if(url == "Embeding_String_URL"){

		n = 2;
	}
	else if(url == "Embeding_URL_URL"||
		url == "Slide_Sample"||
		url == "Slide_Sample2"||
		url == "Scroll_Lazy_Data"||
		url == "Candle_Lazy_Data"||
		url == "Stock_Monitoring"||
		url == "RealTime_Time_TimeAxis"||
		url =="Var_Dynamic_Layout" ||
		url == "RealTime_Size_TimeAxis"||
		url == "RealTime_Premium_25Base"||
		url == "RealTime_Premium_10Int"||
		url == "RealTime_Premium_Line_Column"){

		n = 3;
	}
	return n;
}

function textAreaSetValue(layout, data,n){
	var tlayout = _$("tarea_layout"),
		tdata = _$("tarea_data"),
		tadiv = _$("tarea_div"),
		updiv = _$("update_div"),		
		layoutHeight,
		dataHeight,
		tabHeight;
	
	tlayout.style.display = "block";
	tdata.style.display = "block";
	tlayout.style.height = "0px";
	tdata.style.height = "0px";
	
	tlayout.value = layout;
	tdata.value = data;

	layoutHeight = tlayout.scrollHeight;
	dataHeight = tdata.scrollHeight;

	if(layoutHeight > textAreaMaxHeight){
		layoutHeight = textAreaMaxHeight;		
	}

	if(dataHeight > textAreaMaxHeight){
		dataHeight = textAreaMaxHeight;
	}
	
	if(active_tab_li.id =="li_layout"){
		tdata.style.display = "none";
		tabHeight = layoutHeight;		
	}else{
		tlayout.style.display = "none";
		tabHeight = dataHeight;
	}
	
	activeUpdateBtn(n);

	tlayout.style.height = layoutHeight + "px";
	tdata.style.height = dataHeight + "px";

	tadiv.style.height = tabHeight + 34 +"px";
	updiv.style.height = tabHeight + 71 + "px";	
}

function inputTab(layout){
	var i, n,
		str,
		retStr = "",
		tabCount = 0,
		strArr = layout.split("<");
	
	for(i = 0, n = strArr.length ; i < n ; i += 1){
		str = strArr[i];
		
		if(str == "")
			continue;
		
		str = "<" + str;

		if(str.indexOf("</") > -1)
			tabCount--;
		
		retStr += (addTabTag(tabCount) + str + "\n");
		
		if(str.indexOf("/>") < 0 && str.indexOf("</") < 0)
			tabCount++;
	}
	return retStr;
}

function activeUpdateBtn(n){
	var updateBtn = _$("btn_update"),
		tdata = _$("tarea_data"),
		tlayout = _$("tarea_layout");

	tlayout.readOnly = false;
	tdata.readOnly = false;
	updateBtn.style.display = "block";
	if(active_tab_li.id =="li_layout" && (n == 1 || n == 3) ){
		updateBtn.style.display = "none";
		tlayout.readOnly = true;
	}

	if(active_tab_li.id =="li_data" && (n == 2 || n == 3) ){
		updateBtn.style.display = "none";
		tdata.readOnly = true;
	}
}

function addTabTag(count){
	var tabStr = "";
	for(var i = 0, n = count ; i < n ; i += 1)
		tabStr += "    ";
	return tabStr;
}

function objectToString(obj){
	var data,
		retStr = "";
	for(var i = 0, n = obj.length ; i < n ; i += 1){
		data = obj[i];
		retStr += "{";
		for(var o in data){
			retStr += "\"" + o + "\":";
			if(typeof data[o] == "string")
				retStr += "\"" + data[o] + "\"";
			else
				retStr += data[o];
			retStr += ", ";
		}
		retStr = retStr.substring(0, retStr.length - 2) + "}";
		if(i != obj.length - 1)
			retStr += ",\n";
	}
	return retStr;
}

function stringToObject(str){
	/*var o,
		item,
		strArr,
		data = [];
		
	str = (str + ",").replace(/{|"|\r|\n/g,"");
	strArr = str.split("},");
	for(var i = 0, n = strArr.length ; i < n ; i += 1){
		str = strArr[i];
		if(str == "")
			continue;
		str = str.split(", ");
		o = {};
		for(var j = 0, m = str.length ; j < m ; j += 1){
			item = str[j].split(":");
			o[item[0]] = item[1];
		}
		data.push(o);
	}
	return data;*/
	return JSON.parse('[' + str + ']');
}

function titleMouseHandler(e){
	if(!displayNoneElem || all_ani_dirty)
		return;

	var id,
		activeTarget,
		target = e.target || e.srcElement;
	
	id = target.id;
	if(id == "type_title")
		id = "type";
	else if(id == "prop_title")
		id = "prop";
	else
		return;
	
	// 
	if(displayNoneElem.id.indexOf(id) < 0)
		return;
	
	activeTarget = _$("prop_content");
	if(id == "prop")
		activeTarget = _$("type_content");

	playEffect(displayNoneElem, {"height":0}, {"height":displayNoneElem.scrollHeight}, titleSlideEnd, 800);
	activeMenu(_$(id + "_title"));

	playEffect(activeTarget, {"height":activeTarget.scrollHeight}, {"height":0}, titleSlideEnd, 800);
	displayNoneElem = activeTarget;
}

function titleSlideEnd(e){
	e._ani_dirty = false;
}

function addElementEvent(){
	var i,e,
		layout = _$("li_layout"),
		data = _$("li_data"),
		home = _$("home"),
		tdata = _$("tarea_data"),
		tlayout = _$("tarea_layout"), 
		update = _$("btn_update"),
		type_title = _$("type_title"),
		prop_title = _$("prop_title");

	for(i = 0 ; i < images.length; i++){
		e = _$("img_"+images[i].u);
		e.u = images[i].u;
		e.titleTarget = "type_title";
		demoEvent("add",e , "click", overviewImgClick);
	}
	
	set(_$("tarea_data"), "display", "none");

	changeCss(layout, ".active_li");
	active_tab_li = layout;

	demoEvent("add", type_title, "mouseover", titleMouseHandler);
	demoEvent("add", prop_title, "mouseover", titleMouseHandler);

	demoEvent("add", layout, "click", tabClickHandler);
	demoEvent("add", data, "click", tabClickHandler);
	demoEvent("add", update, "click",updateClickHandler);
	
	demoEvent("add", tlayout, "keydown", textAreaKeyHandler);
	demoEvent("add", tlayout, "keyup", textAreaKeyHandler);
	
	demoEvent("add", tdata, "keydown", textAreaKeyHandler);
	demoEvent("add", tdata, "keyup", textAreaKeyHandler);

	demoEvent("add", _$("tutorial"), "click", startTutorial);
	demoEvent("add",_$("tutorial_next"),"click",nextTutorial);

	demoEvent("add", home, "click", function(){
		if(!all_ani_dirty && open_sub_menu){
			set(_$("sub_menu"), "zIndex", -1);
			changeCss(active_menu, ".non_active_menu");
			changeCss(active_main_li, ".non_active_main_li");
			set(_$("chart_sample"), "display", "none");
			set(_$("overview"), "display", "block");
			playEffect(_$("menu"), {"width":321}, {"width":171}, endSlide, 800);
			playEffect(displayNoneElem, {"height":0}, {"height":displayNoneElem.scrollHeight}, titleSlideEnd, 800);
			home_dirty = true;
			displayNoneElem = null;
		}
	});
}

function changeCss(target, className){
	var i, n, 
		j, m,
		cssText,
		rules;

	cssText = _forLocalChromeCss[className.substring(1, className.length)];
	
	if(cssText.indexOf("{") > -1)
		cssText = cssText.substring(cssText.indexOf("{") + 1, cssText.indexOf("}"));
	cssText = cssText.split(";");
	
	for(i = 0, n = cssText.length ; i < n ; i += 1){
		if(cssText[i] == "" || cssText[i] == " ")
			continue;
		rules = cssText[i].split(":");
		target.style[removeHyphen(rules[0])] = rules[1];
	}
}

function removeHyphen(str){
	var i, n, retStr = "";
	str = str.toLowerCase();
	str = str.replace(/\"| /g,"");
	str = str.split("-");
	retStr = str[0];
	for(i = 1, n = str.length ; i < n ; i += 1){
		retStr += str[i].substring(0, 1).toUpperCase() + str[i].substring(1, str[i].length);
	}
	return retStr;
}

function tabClickHandler(e){
	var datadisplay = "none",
		layoutdisplay = "none",
		tdata = _$("tarea_data"),
		tlayout = _$("tarea_layout"), 
		tadiv = _$("tarea_div"),
		updiv = _$("update_div"),
		iframe = _$("content_iframe"),
		target = e.target || e.srcElement,
		tabHeight,n;
	
	n = checkUrl(iframe);
	if(active_tab_li === target)
		return;

	changeCss(target, ".active_li");
	changeCss(active_tab_li, ".non_active_li");
	
	if(_$("li_layout") === target){
		layoutdisplay = "block";
		tabHeight = tlayout.style.height;

	}else{
		datadisplay = "block";
		tabHeight = tdata.style.height;
	}

	tabHeight = Number(tabHeight.replace(/px/, ''));
	tadiv.style.height = tabHeight + 34 +"px";
	updiv.style.height = tabHeight + 34 + 37 + "px";
	set(tlayout, "display", layoutdisplay);
	set(tdata, "display", datadisplay);

	active_tab_li = target;
	activeUpdateBtn(n);
}

function updateClickHandler(e){
	window.scroll(0, 0);
	var iframe = _$("content_iframe"),
		tlayout = _$("tarea_layout"),
		tdata = _$("tarea_data"),
		chart = iframe.contentWindow.document.getElementById("chart1");
	if(tarea_layout_dirty && tarea_data_dirty){
		chart.setLayout(tlayout.value);
		chart.setData(stringToObject(tdata.value));
	}else if(active_tab_li.id =="li_layout"){
		chart.setLayout(tlayout.value);
	}else{
		chart.setData(stringToObject(tdata.value));
	}
	tarea_layout_dirty = tarea_data_dirty = false;

}

var tarea_layout_dirty = false,
	tarea_data_dirty = false;

function textAreaKeyHandler(event){
	var tarea = event.target || event.srcElement,
		keyCode = event.keyCode,
		tareaHeight = 0,
		tadiv = _$("tarea_div"),
		updiv = _$("update_div"),
		resize = false,
		headText,
		tailText,
		space = "    ",
		sindex;

	switch(event.type){
		case "keydown":
				if(keyCode == 9){
					if(!tarea.selectionStart)
						alert("Tab Key cannot be supported in IE7 and IE8.");
					sindex = tarea.selectionStart;
					headText = tarea.value.substring(0, sindex);
					tailText = tarea.value.substring(sindex, tarea.value.length);
					tarea.value = headText + space + tailText;
					tarea.selectionStart = tarea.selectionEnd = sindex + space.length;
					if(event.preventDefault)
						event.preventDefault();
				}else if(keyCode == 13 || keyCode == 46 || keyCode == 8)
					resize = true;
			break;
		case "keyup":
				if(keyCode == 8)
					resize = true;
			break;
		default:
			break;
	}

	if(resize){
		tarea.style.height = "1px";
		tareaHeight = tarea.scrollHeight;
		if(keyCode == 13)
			tareaHeight += 16;
		if(tareaHeight > textAreaMaxHeight){
			tareaHeight = textAreaMaxHeight;
		}
		tarea.style.height = tareaHeight + "px";		
		tadiv.style.height = tareaHeight + 34 +"px";
		updiv.style.height = tareaHeight + 34 + 37 + "px";
	}

	if(tarea === _$("tarea_layout"))
		tarea_layout_dirty = true;
	else if(tarea === _$("tarea_data"))
		tarea_data_dirty = true;

	if(keyCode == 9)
		return false;	
}

function startTutorial(){
	var i,html,w,
		content = _$("tutorial_content"),
		btn = _$("tutorial_next"),
		tu = _$("tutorial_div"),
		exp = _$("tutorial_exp");
	w = get(tu,"width");
	if(w>0){
		return;
	}

	tu.style.display = "block";
	
	window.scrollTo(0,0);
	tutorial_index = 0;
	html = "";
	exp.innerHTML = "Please click the button at the top.";
	btn.innerHTML = "step.1";
	changeCss(tu,".active_tutorial_div");
	
	tutorial_array = [];
	for(i = 0 ; i < tutorialContent.length ; i++){
		html += '<div class="'+tutorialContent[i].className+'">'+tutorialContent[i].content+'</div>';
		if(tutorialContent[i].displayList){
			tutorial_array.push(tutorialContent[i]);
		}
	}

	content.innerHTML = html;
	
	playEffect(tu,{"width":0},{"width":900},tutorialSlideEnd,800);
	
}

function endTutorial(){
	var tu = _$("tutorial_div");
	if(tutorial_overview){
		set(_$("overview"), "display", "block")
	}else{
		set(_$("chart_sample"), "display", "block")
	}
	
	playEffect(tu,{"width":900},{"width":0},tutorialEnd,800);
}

function tutorialEnd(e){
	var tu = _$("tutorial_div");
	tu.style.display = "none";
	e._ani_dirty = false;
}

function tutorialSlideEnd(e){
	var overview = _$("overview");
	if(overview.style.display != "none"){
		set(overview, "display", "none");
		tutorial_overview = true;
	}else{
		tutorial_overview = false;
		set(_$("chart_sample"), "display", "none");
	}	
	e._ani_dirty = false;	
}

function nextTutorial(){
	var i,h,n,btn = _$("tutorial_next"),
		con = _$("tutorial_content"),
		exp = _$("tutorial_exp"),
		maxCount = tutorial_array.length-1,
		chartVars;	
	if(btn.innerHTML == "step.6"){
		btn.innerHTML = "close";
		exp.innerHTML = "";
		//window.scrollBy(0,300);
		return;
	}else if(btn.innerHTML == "close"){
		endTutorial();		
		//window.scrollTo(0,0);
		return;
	}
	for(i = 0 ; i < tutorial_array.length; i++){		
		if(tutorial_array[i].displayIndex == tutorial_index){
			//changeCss(con.childNodes[tutorial_array[i].index],".active_tutorial_child");
			h = con.childNodes[tutorial_array[i].index].childNodes[0].offsetHeight;
			playEffect(con.childNodes[tutorial_array[i].index],{"height":0},{"height":h},titleSlideEnd,800);
			if(tutorial_array[i].displayBtn){
				exp.innerHTML = tutorial_array[i].displayBtn;
			}
		}
	}	
	tutorial_index++;
	if(maxCount  <= tutorial_index){
		tutorial_index=maxCount;		
	}else if(tutorial_index == 3){
		//window.scrollBy(0,150);
	}else if(tutorial_index == 4){
		//window.scrollBy(0,250);
	}else if(tutorial_index == 5){
		//window.scrollBy(0,170);
	}
	n = tutorial_index+1;
	btn.innerHTML = "step."+ n;
}

function playWindowScroll(from, to){
	playEffect(window, {"scroll":from}, {"scroll":to}, function(e){
		e._ani_dirty = false;
	}, 800, true);
}

function changeTheme(theme){
	var iframe = _$("content_iframe").contentWindow ;	
	iframe.KoolChartChangeTheme(theme);
}

function overviewImgClick(e){
	if(all_ani_dirty)
		return;
	var i,tname,turl,item,c,li,
		target = e.target || e.srcElement,
		type = _$("default_type").children[0].children,
		premium = _$("premium_type").children[0].children;
	activeMenu(_$(target.titleTarget));
	
	
	turl = target.u;
	for(i = 0 ; i < type.length ; i++){
		tname = type[i].innerHTML;
		if(turl=="target"){
			turl = "Target vs Actual";
		}else if(turl == "broken"){
			turl = "BrokenAxis";	
		}else if(turl == "candle"){
			turl = "candlestick";
		}
		if(tname.toUpperCase() == turl.toUpperCase()){
			item = type[i];
			break;
		}
	}
	
	for(i = 0 ; i < premium.length ; i++){
		tname = premium[i].innerHTML;
		if(tname.toUpperCase() == turl.toUpperCase()){
			item = premium[i];
			break;
		}
	}
	item.over = true;
	activeMainLi(item,false);
	all_ani_dirty = false;
	
}

function playEffect(e, fp, tp, endFunc, d, scroll){
	var o,
		endTime,
		interval,
		offset = 1 / d,
		startTime = new Date().getTime(),
		play = function(){
			endTime = new Date().getTime();
			for(o in tp){
				if(endTime - startTime > d){
					if(scroll)
						e.scrollTo(0, tp[o]);
					else
						e.style[o] = tp[o] + "px";
					clearInterval(interval);
					endFunc(e);
					ani_index--;
					if(ani_index == 0)
						all_ani_dirty = false;
				}else{
					if(scroll)
						e.scrollTo(0, (easingFunc(endTime - startTime, 0, 1, d)  * (tp[o] - fp[o])));
					else
						e.style[o] = fp[o] + (easingFunc(endTime - startTime, 0, 1, d)  * (tp[o] - fp[o])) + "px";
				}
			}
		};
	if(!e._ani_dirty){
		ani_index++;
		all_ani_dirty = e._ani_dirty = true;
		interval = setInterval(play, 30);
	}
}

function endSlide(e){
	var display = "block",
		open = true;

	if(open_sub_menu){
		display = "none";
		open = false;
		
		changeCss(_$("main_menu"), ".non_main_menu_border");
		active_menu = active_main_li = null;
		set(_$("title_eng"), "display", display);
	}else{
		set(_$("sub_menu"), "zIndex", 0);
	}
	open_sub_menu = open;
	e._ani_dirty = false;
}

function endSlide2(e){
	var display = "block",
		open = true;

	if(open_sub_menu){
		display = "none";
		open = false;
		
		changeCss(_$("main_menu"), ".non_main_menu_border");
		active_menu = active_main_li = null;
		set(_$("title_eng"), "display", display);
	}else{
		set(_$("sub_menu"), "zIndex", 0);
	}
	open_sub_menu = open;
	e._ani_dirty = false;
	all_ani_dirty = false;
	var li  = _$("active_content_childs").children[0].children[0];
	li.click();
}

function easingFunc(t, b, c, d){
	t /= d;
	t--;
	return c*(t*t*t + 1) + b;
}

function _$(id){
	return document.getElementById(id);
}

function set(e, p, v, px){
	e.style[p] = v + (px ? "px" : "");
}

function get(e,p){
	var v = e.style[p];
	if(typeof v === "string" && v.indexOf("px") > 0 ) {
		v = Number(v.replace(/px/, ''));
	}
	return v;
}

var _forLocalChromeCss = {
	active_menu : "background-color:#f7721a;color:#ffffff",
	non_active_menu : "background-color:#f2f2f2;color:#454545",
	active_li : "border-bottom:none;background-color:#f7f7f7",
	non_active_li : "border-bottom:solid 1px #e2e2e2;background-color:#ffffff",
	active_main_li : "color:#454545;text-decoration:underline",
	non_active_main_li : "color:#888888;text-decoration:none",
	active_sub_li : "color:#ffffff;background-color:#888888",
	non_active_sub_li : "color:#888888;background-color:#ffffff",
	active_main_menu_border : "border-right-style:solid;border-right-width:1px;border-right-color:#ebebeb",
	non_main_menu_border : "border-right-style:none",
	sample_name_eng : "font-family:arial;font-size:28px",
	sample_name_han : "font-family:Malgun Gothic;font-size:23px;letter-spacing:-1px",
	active_tutorial_child : "display:block;overflow:hidden;font-family: arial,Malgun Gothic;font-size:12px",
	none_tutorial_child : "height:0px;overflow:hidden;font-family: arial,Malgun Gothic;font-size:12px",
	active_tutorial_div : "border-right:solid 1px #ebebeb",
	non_tutorial_div : "border:none"
}

function checkChrome(){
	var u = navigator.userAgent,
		isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
	var rlocalProtocol = /^(?:about|app|app\-storage|.+\-extension|file|widget):$/;
	var rurl = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/;
	var ajaxLocation;

	var ajaxLocParts;

	try {
		ajaxLocation = location.href;
	} catch( e ) {
		ajaxLocation = document.createElement( "a" );
		ajaxLocation.href = "";
		ajaxLocation = ajaxLocation.href;
	}

	ajaxLocParts = rurl.exec( ajaxLocation.toLowerCase() ) || [];

	var isLocal = rlocalProtocol.test( ajaxLocParts[ 1 ] );

	if(!isSafari && testCSS("WebkitTransform") && isLocal){

		var d = _$("deemd"),
			alert = _$("deemd_alert"),
			content = _$("deemd_content"),
			title = _$("deemd_title"),
			close = _$("deemd_close"),
			str="";

		str = 'If you run this samples with Chrome in local PC, the chart cannot be rendered properly. Please read "new-user.txt" for further reference.';
		content.innerHTML = str;
		d.style.display = "block";
		alert.style.display = "block";
		demoEvent("add",close,"click",closeDeemd);
	}	
}

function closeDeemd(){
	var d = _$("deemd"),
		alert = _$("deemd_alert"),
		close = _$("deemd_close");
	
	demoEvent("remove",close,"click",closeDeemd);
	d.style.display = "none";
	alert.style.display = "none";
}

function testCSS(prop){
	return prop in document.documentElement.style;
}