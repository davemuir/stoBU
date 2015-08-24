var baseurl = "./Samples/",

	default_types = [{
		// Line
			"n":"Line", "c":[
				// n - name
				// u - url
				{"n":"Line", "u":"Line_2D_Segment"},
				{"n":"Curve", "u":"Line_2D_Curve"},
				{"n":"Stepped Line", "u":"Line_2D_Step"},
				{"n":"ItemRenderer", "u":"Line_2D_Item"},
				{"n":"Line Baseline", "u":"Line_2D_Baseline"},
				{"n":"Null Data", "u":"Line_2D_Interpolate"},
				{"n":"Dashed Line", "u":"Dash_Lines"},
				{"n":"Dashed Curve", "u":"Dash_Line_Curve"},
				{"n":"Dashed Stepped Line", "u":"Dash_Line_Step"},
				{"n":"Line + Dahsed Line", "u":"Dash_DashedLine_Line"},
				{"n":"Line + Multiple Dashed Lines", "u":"Dash_Line_DashedLine"}
			]
		},{
		// Column
			"n":"Column", "c":[
				{"n":"Column 2D", "u":"Column_2D"},
				{"n":"Column 3D", "u":"Column_3D"},
				{"n":"MultiSeries 2D", "u":"Column_2D_MS"},
				{"n":"MultiSeries 3D", "u":"Column_3D_MS"},
				{"n":"Stacked 2D", "u":"Column_2D_Stacked"},
				{"n":"Stacked 2D <br> (Connecting Lines)", "u":"Column_2D_Stacked_Link"},
				{"n":"100% 2D", "u":"Column_2D_100Per"},
				{"n":"Stacked 3D", "u":"Column_3D_Stacked"},
				{"n":"Stacked 3D <br> (Connecting Lines)", "u":"Column_3D_Stacked_Link"},
				{"n":"100% 3D", "u":"Column_3D_100Per"},
				{"n":"Stacked MultiSeries", "u":"Column_2D_MS_Stacked"},
				{"n":"Adjust Column Width", "u":"Column_2D_Width_Control"},
				{"n":"Cylinder 3D", "u":"Cylinder_3D"},
				{"n":"Cylinder MultiSeries 3D", "u":"Cylinder_3D_MS"},
				{"n":"Cylinder Stacked 3D", "u":"Cylinder_3D_Stacked"}
			]
		},{
		// Bar
			"n":"Bar", "c":[
				{"n":"Bar 2D", "u":"Bar_2D"},
				{"n":"Bar (Negative Values)", "u":"Bar_2D_Negative"},
				{"n":"Bar 3D", "u":"Bar_3D"},
				{"n":"MultiSeries 2D", "u":"Bar_2D_MS"},
				{"n":"MultiSeries 3D", "u":"Bar_3D_MS"},
				{"n":"Stacked 2D", "u":"Bar_2D_Stacked"},
				{"n":"100% 2D", "u":"Bar_2D_100Per"},
				{"n":"Stacked 3D", "u":"Bar_3D_Stacked"},
				{"n":"100% 3D", "u":"Bar_3D_100Per"},
				{"n":"Stacked MultiSeries", "u":"Bar_2D_MS_Stacked"},
				{"n":"Adjust Bar Width", "u":"Bar_2D_Width_Control"},
				{"n":"Cylinder 3D", "u":"Cylinder_Bar_3D"},
				{"n":"Cylinder Stacked 3D", "u":"Cylinder_Bar_3D_Stacked"}
			]
		},{
		// Area
			"n":"Area", "c":[
				{"n":"Area 2D", "u":"Area_2D"},
				{"n":"Stacked 2D", "u":"Area_2D_Stacked"},
				{"n":"MultiSeries 2D", "u":"Area_2D_MS"},
				{"n":"Area Baseline", "u":"Area_2D_Baseline"}
			]
		},{
		// Pie
			"n":"Pie", "c":[
				{"n":"Pie 2D", "u":"Pie_2D"},
				{"n":"Pie 3D", "u":"Pie_3D"},
				{"n":"Stacked 3D", "u":"Pie_3D_Stacked"},
				{"n":"Pie with Wedge", "u":"Pie_2D_Wedge"},
				{"n":"Doughnut 2D", "u":"Doughnut_2D"},
				{"n":"Doughnut 3D", "u":"Doughnut_3D"}
			]
		},{
		// Bubble
			"n":"Bubble", "c":[
				{"n":"Bubble 3D", "u":"Bubble_3D"},
				{"n":"MutliSeries 3D", "u":"Bubble_3D_MS"},
				{"n":"Bubble Transparency", "u":"Bubble_3D_Transparency"}
			]
		},{
		// Plot
			"n":"Plot", "c":[
				{"n":"Plot 2D", "u":"Plot_2D"},
				{"n":"Plot 2D - Center Line", "u":"Plot_2D_Ex"}
			]
		},{
		// Combination
			"n":"Combination", "c":[
				{"n":"Area + Line 2D", "u":"Combi_2D_Single"},
				{"n":"Line 2D", "u":"Combination_2D_Line"},
				{"n":"Line 3D", "u":"Combination_3D_Line"},
				{"n":"MultiStacked + Line 2D ", "u":"Combination_2D_Complex_Line"},
				//{"n":"MultiSeries 3D", "u":"Combination_3D_MS_Line"},
				//{"n":"Stacked + Line 3D", "u":"Combination_3D_Stacked_Line"},
				{"n":"MultiSeries + Area + Line 2D", "u":"Combi_2D_Multi"},
				//{"n":"Area + Line 3D", "u":"Combi_Single"},
				//{"n":"MultiSeries + Area + Line 3D", "u":"Combi_Multi"},
				//{"n":"Stacked + Area + Line 3D", "u":"Combi_Stacked"}
			]
		},{
		// From-to
			"n":"From - To", "c":[
				{"n":"Step", "u":"From_To_Bar_2D"},
				{"n":"From - To (Bar)", "u":"From_To_Bar_3D"},				
				{"n":"From - To (Column)", "u":"From_To_Column_3D"},
				{"n":"From - To (Area)", "u":"From_To_Area_2D"},
				{"n":"From - To (Area Multi)", "u":"From_To_Area_2D_MS"},
				{"n":"Waterfall", "u":"From_To_Column_2D"}
			]
		},{
		// Target vs Actual
			"n":"Target vs Actual", "c":[
				{"n":"Cylinder 3D", "u":"Target_3D"},
				{"n":"Cylinder Bar 3D", "u":"Target_Bar_3D"},
				{"n":"Linear 2D", "u":"Target_2D"}
			]
		}
	],

	// Premium Charts
	premium_types = [{
		// Radar
			"n":"Radar", "c":[
			    {"n":"Polygon - Fill", "u":"Radar_Polygon"},
			    {"n":"Polygon - No Fill", "u":"Radar_Polygon_NoFill"},
			    {"n":"Polygon - Fill", "u":"Radar_Polygon_NoFill2"},
			    {"n":"Circle - Fill", "u":"Radar_Circle"},
			    {"n":"Circle - No Fill", "u":"Radar_Circle_NoFill"}
			]
		},{
		// History
			"n":"History", "c":[
				{"n":"Column", "u":"History_2D"},
				{"n":"Line", "u":"History_2D_Line"},
				{"n":"Column + Line", "u":"History_2D_WL"},
				{"n":"Combination", "u":"History_3D"}
			]
		},{
		// Real-Time
			"n":"Real-Time", "c":[
				{"n":"Number of Data <br> (Category Axis)", "u":"RealTime_Size_TimeAxis"},
				{"n":"Time <br> (DateTime Axis)", "u":"RealTime_Time_TimeAxis"}
				//{"n":"Real-Time Chart", "u":"Stock_Monitoring"}
			]
		},{
		// Scroll
			"n":"Scroll", "c":[
				{"n":"Column 2D", "u":"Scroll_Column_2D"},
				{"n":"Column 3D", "u":"Scroll_Column_3D"},
				{"n":"Column MultiSeries", "u":"Scroll_Column_2D_MS"},
				{"n":"Column Stacked", "u":"Scroll_Column_2D_Stacked"},
				{"n":"Bar MultiSeries", "u":"Scroll_Bar_2D_MS"},
				{"n":"Bar MultiSeries Inverted", "u":"Scroll_Bar_2D_Inverted_MS"},
				{"n":"Line MultiSeries", "u":"Scroll_Line_2D_MS"},
				{"n":"Area", "u":"Scroll_Area_2D"},
				{"n":"Area MultiSeries", "u":"Scroll_Area_2D_MS"},
				{"n":"Combination", "u":"Scroll_Combination_2D"},
				{"n":"Scroll Lazy Data", "u":"Scroll_Lazy_Data"}
			]
		},{
		// BrokenAxis
			"n":"Broken-Axis", "c":[
				//{"n":"Column2DChart Broken-Axis", "u":"BrokenAxis_Column_2D"},
				//{"n":"Bar2DChart Broken-Axis", "u":"BrokenAxis_Bar_2D"},
				//{"n":"Column3DChart Broken-Axis", "u":"BrokenAxis_Column_3D"},
				//{"n":"Bar3DChart Broken-Axis", "u":"BrokenAxis_Bar_3D"},
				//{"n":"Line2DChart Broken-Axis", "u":"BrokenAxis_Line_2D"}
				{"n":"Column 2D", "u":"BrokenAxis_Column_2D"},
				{"n":"Bar 2D", "u":"BrokenAxis_Bar_2D"},
				{"n":"Column 3D", "u":"BrokenAxis_Column_3D"},
				{"n":"Bar 3D", "u":"BrokenAxis_Bar_3D"},
				{"n":"Line 2D", "u":"BrokenAxis_Line_2D"}
			]
		},{
		// Matrix
			"n":"Matrix", "c":[
				{"n":"Matrix", "u":"Matrix2D_Renderer"},
				{"n":"Matrix - Fill", "u":"Matrix2D_Fill"},
				{"n":"Matrix - Fill 2", "u":"Matrix2D_Fill_2"},
				{"n":"Matrix - Plot", "u":"Matrix2D_Plot"},
				{"n":"Matrix - Image", "u":"Matrix2D_Image"},
				{"n":"Matrix - Item Renderers", "u":"Matrix2D_Renderer_s"}
			]
		},{
		// Image
			"n":"Image", "c":[
				{"n":"Same Ratio / Single Image (1)", "u":"Image_Single_Ratio"},
				{"n":"Same Ratio / Single Image (2)", "u":"Image_Single_MS_Ratio"},
				{"n":"Different Ratio / Single Image (1)", "u":"Image_Single_FRatio"},
				{"n":"Different Ratio / Single Image (2)", "u":"Image_Single_FRatio2"},
				{"n":"Single Ratio / Repetitive Image (1)", "u":"Image_SingleRepeat"},
				{"n":"Single Ratio / Repetitive Image (2)", "u":"Image_SingleRepeat2"},
				{"n":"Different Ratio / Multiple Images (1)", "u":"Image_Multiple"},
				{"n":"Different Ratio / Multiple Images (2)", "u":"Image_Multiple2"}
			]
		},{
		// Slide
			"n":"Slide", "c":[
				{"n":"Slide Basic", "u":"Slide_Sample"},
				{"n":"Slide with Effects", "u":"Slide_Sample2"}
			]
		},{
		// Wing
			"n":"Wing", "c":[
				{"n":"Bar 2D", "u":"Bar_2D_Wing"},
				{"n":"MultiSeries Bar 2D", "u":"Bar_2D_Wing_Multi"},
				{"n":"Stacked Bar 2D", "u":"Bar_2D_Wing_Stacked"},
				{"n":"Stacked Bar 2D (Connecting Lines)", "u":"Bar_2D_Wing_Stacked_Link"},
				{"n":"100% Bar 2D", "u":"Bar_2D_Wing_100Per"},
				{"n":"Column 2D", "u":"Column_2D_Wing"},
				{"n":"MultiSeries Column 2D", "u":"Column_2D_Wing_Multi"},
				{"n":"Stacked Column 2D", "u":"Column_2D_Wing_Stacked"},
				{"n":"Stacked Column 2D (Connecting Lines)", "u":"Column_2D_Wing_Stacked_Link"},
				{"n":"100% Column 2D", "u":"Column_2D_Wing_100Per"}
			]
		},{
		// RealTime-Premium
			"n":"RealTime-Premium", "c":[
				{"n":"Different Cycles (1)", "u":"RealTime_Premium_Line_Column"},
				{"n":"Today and Yesterday's data", "u":"RealTime_Premium_10Int"},
				{"n":"Different Cycles (2)", "u":"RealTime_Premium_25Base"}
			]
		},{
		// Candlestick
			"n":"Candlestick", "c":[
				{"n":"Candlestick", "u":"Candlestick_Normal"},
				{"n":"Candlestick Reverse", "u":"Candlestick_Reverse"},
				{"n":"Candlestick Symbol (1)", "u":"Candlestick_Symbol"},
				{"n":"Candlestick Symbol (2)", "u":"Candlestick_Symol_Another"},
				{"n":"CandleLine Symbol", "u":"CandleLine_Symbol"},
				{"n":"CandleLine Baseline", "u":"CandleLine_Baseline"},
				{"n":"CandleArea Symbol", "u":"CandleArea_Symbol"},
				{"n":"CandleArea Baseline", "u":"CandleArea_Baseline"},
				{"n":"Lazy Data", "u":"Candle_Lazy_Data"}
			]
		},{
		// Gauge
			"n":"Gauge", "c":[
  				{"n":"Circular Orange", "u":"Gauge_Circular_Orange"},
				{"n":"Circular Rainbow", "u":"Gauge_Circular_Rainbow"},
				{"n":"Circular Gradient", "u":"Gauge_Circular_Gradient"},
				{"n":"Circular Dual", "u":"Gauge_Circular_Dual"},
				{"n":"Half-Circular Rainbow1", "u":"Gauge_Half_Rainbow1"},
				{"n":"Half-Circular Rainbow2", "u":"Gauge_Half_Rainbow2"},
				{"n":"Half-Circular Notice", "u":"Gauge_Half_Notice"},
				{"n":"Half-Circular Gradient", "u":"Gauge_Half_Gradient"},
				{"n":"Horizontal Cylinder Gauge", "u":"Gauge_HorizontalCylinder"},
				{"n":"Vertical Cylinder Gauge", "u":"Gauge_VerticalCylinder"},
				{"n":"Horizontal Linear Gauge", "u":"Gauge_HorizontalLinear"},
				{"n":"Vertical Linear Gauge", "u":"Gauge_VerticalLinear"}
			]
		}
	],

	// properties
	props = [{
			"n":"Layout and Data Integration", "c":[
				{"n":"String Layout / Array Dataset", "u":"Embeding_String_Array"},
				{"n":"URL Layout / Array Dataset", "u":"Embeding_URL_Array"},
				{"n":"String Layout / XML Dataset", "u":"Embeding_String_URL"},
				{"n":"URL Layout / XML Dataset", "u":"Embeding_URL_URL"},
				{"n":"Using chartVars", "u":"Embeding_chartVars"},
				{"n":"Dynamic Change (Chart Type)", "u":"Dynamic_Change_Layout"},
				{"n":"Dynamic Change (Dataset)", "u":"Dynamic_Change_Data"},
				{"n":"Dynamic Change (Layout / Dataset)", "u":"Dynamic_Change_Both"},
				{"n":"Dynamic Creation (Layout)", "u":"Var_Dynamic_Layout"}
			]
		},{
			"n":"Axes", "c":[
				{"n":"Title", "u":"XY_One_Label"},
				{"n":"Title - Styles", "u":"XY_Label"},
				{"n":"Decoration", "u":"XY_Tick"},
				{"n":"Change Location", "u":"XY_Revers"},
				{"n":"Hide Y-axis", "u":"XY_Y_Remove"},
				{"n":"Invert Y-axis", "u":"XY_Invert_Y"},
				{"n":"Category X-axis / Linear Y-axis", "u":"XY_CatLin"},
				{"n":"DateTime X-axis / Log Y-axis", "u":"XY_DateLog"},
				{"n":"Category X-axis / Log Y-axis", "u":"XY_LogLog_Column"},
				{"n":"Log X-axis / Log Y-axis", "u":"XY_LogLog_Line"},
				{"n":"Dual Axes", "u":"XY_Dual"},
				{"n":"Dual Axes - Triple Series", "u":"XY_Dual2"},
				{"n":"Triple Axes", "u":"XY_Triple"},
				{"n":"CSS Styles", "u":"CSS_Exam2"},
				{"n":"Trimmed Numbers", "u":"Line_Area_Label"},
				{"n":"Minimum / Maximum Values", "u":"Minimum_Maximum"}
			]
		},{
			"n":"Axes - Line / Background", "c":[
				{"n":"Target Line (1)", "u":"Column_3D_TargetLine"},
				{"n":"Target Line (2)", "u":"Line_2D_TargetLine"},
				{"n":"Multiple Lines", "u":"Axis_Multi_Line"},
				{"n":"Range", "u":"Axis_Area"},
				{"n":"Multiple Ranges", "u":"Axis_Multi_Area"},
				{"n":"Range + Line", "u":"Axis_Area_Line"},
				{"n":"Range + Line (Mapped to Designated Axis)", "u":"Aim_Axis_Area_Line"},
				{"n":"Crosshair Mouse Pointer", "u":"CrossHair_MouseMove"},
				{"n":"Background - Horizontal Line", "u":"Bg_Hori"},
				{"n":"Background - Vertical Line", "u":"Bg_Vertical"},
				{"n":"Background - Horizontal / Vertical Lines", "u":"Bg_Hori_Vertical"},
				{"n":"Background - Image", "u":"Bg_Image"},
				{"n":"Background - Logo", "u":"Bg_Image_Logo"},
				{"n":"Background - Image / Line", "u":"Bg_Image_Line"},
				{"n":"Background - CSS Styles", "u":"CSS_KoolChart"},
				{"n":"HTML", "u":"Bg_Html_Alpha_Chart"}
			]
		},{
			"n":"Axes - Label", "c":[
				{"n":"Font Size", "u":"Change_FontSize"},
				{"n":"Thousand Separator", "u":"Formatter_Number"},
				{"n":"Currency Symbol (Yen)", "u":"Formatter_Currency2"},
				{"n":"Currency Symbol (Dollar)", "u":"Formatter_Currency"},
				{"n":"Date Format (YYYY-MM-DD)", "u":"Formatter_Date"},
				{"n":"Date Format (D MMM, YY)", "u":"Formatter_Date2"},
				{"n":"User-defined (X-axis)", "u":"Label_Func_X"},
				{"n":"User-defined (Scroll Chart)", "u":"Label_Func_X_Scroll"},
				{"n":"User-defined (Y-axis)", "u":"Label_Func_Y"},
				{"n":"Rotate (X-axis)", "u":"EmbededFont_XLabel"},
				{"n":"Vertical (Japanese)", "u":"Label_Vertical_Jpn"},
				{"n":"Rotate (Japanese)", "u":"LabelField_Jpn_Rotation"},
				{"n":"Vertical (English)", "u":"Label_Vertical_Eng"},
				{"n":"Rotate 1 (English)", "u":"LabelField_Eng_Rotation"},
				{"n":"Rotate 2 (English)", "u":"LabelField_Eng_Rotation_Label"}
			]
		},{
			"n":"Data Label", "c":[
				{"n":"Outside (Column)", "u":"LabelField_Column_Outside"},
				{"n":"Inside (Column)", "u":"LabelField_Column_Inside"},
				{"n":"Top / Middle / Bottom (Column)", "u":"LabelField_Both_Column"},
				{"n":"Outside (Bar)", "u":"LabelField_Bar_Outside"},
				{"n":"Inside (Bar)", "u":"LabelField_Bar_Inside"},
				{"n":"Left / Center / Right (Bar)", "u":"LabelField_Both_Bar"},
				{"n":"Outside with Margin (Bar)", "u":"LabelField_Bar_Outside_Margin"},
				{"n":"Up (Line)", "u":"LabelField_Line_2D_Up"},
				{"n":"Down (Line)", "u":"LabelField_Line_2D_Down"},
				{"n":"Up (Area)", "u":"LabelField_Area_2D_Up"},
				{"n":"Down (Area)", "u":"LabelField_Area_2D_Down"},
				{"n":"Inside (Pie)", "u":"LabelField_Pie"},
				{"n":"Outside (Pie)", "u":"LabelField_Pie_Callout"},
				{"n":"Inside / Outside (Pie)", "u":"LabelField_Pie_insideWithCallout"},
				{"n":"Radar Chart", "u":"Radar_Label"},
				{"n":"Underline", "u":"LabelField_Underline_Column"},
				{"n":"Vertical", "u":"LabelField_Rotation"},
				{"n":"User-defined", "u":"LabelField_Func_Column"},
				{"n":"User-defined (Pie)", "u":"LabelField_Func_Pie"}
			]
		},{
			"n":"Chart Design", "c":[
				{"n":"Single Color - Column", "u":"Column_3D_Color_Fill"},
				{"n":"Multiple Colors - Column", "u":"Column_3D_Color_Fills"},
				{"n":"Multiple Colors - MultiSeries Column", "u":"Column_3D_Multi_Color"},
				{"n":"Single Color - Bar", "u":"Bar_2D_Color_Fill"},
				{"n":"Single Color - Line", "u":"Line_2D_Color_Fill"},
				{"n":"Single Color - Area", "u":"Area_2D_Color_Fill"},
				{"n":"Multiple Colors - MultiSeries Radar", "u":"Radar_Color_Polygon"},
				{"n":"User-defined Colors - Column", "u":"Column_3D_Custom_Fill"},
				{"n":"User-defined Colors - Bar", "u":"Bar_3D_Custom_Fill"},
				{"n":"User-defined Colors - Line", "u":"Line_2D_Custom_Fill"},
				{"n":"User-defined Colors - Area", "u":"Area_2D_Custom_Fill"},
				{"n":"User-defined Colors - Bubble", "u":"Bubble_3D_Custom_Fill"},
				{"n":"User-defined Colors - Pie", "u":"Pie_2D_Custom_Fill"}
			]
		},{
			"n":"Tooltips", "c":[
			    {"n":"Fill colors", "u":"DataTip_BackgroundColor"},
				{"n":"Trail of Axes", "u":"DataTip_DisplayMode"},
				{"n":"Trail of Mouse Cursor", "u":"DataTip_DisplayMode2"},
				{"n":"User-defined (Column)", "u":"DataTip_Func"},
				{"n":"User-defined (Pie)", "u":"DataTip_Func2"}
			]
		},{
			"n":"Effects", "c":[
				{"n":"SeriesInterpolate", "u":"Effect_SeriesInterpolate"},
				{"n":"SeriesInterpolate Reverse", "u":"Effect_SeriesInterpolate_Reverse"},
				{"n":"SeriesZoom - Chart", "u":"Effect_SeriesZoom_Chart"},
				{"n":"SeriesZoom - Series", "u":"Effect_SeriesZoom_Series"},
				{"n":"SeriesSlide", "u":"Effect_SeriesSlide"}
			]
		},{
			"n":"Legend", "c":[
				{"n":"Bottom", "u":"Legend_Bottom"},
				{"n":"Right", "u":"Legend_Right"},
				{"n":"Mouse Over Event", "u":"Legend_Top_Right"},
				{"n":"Initially Unchecked", "u":"Legend_Check_False"},
				{"n":"Scroll Bar", "u":"Legend_Over"},
				{"n":"Using SubLegend", "u":"Legend_Sub_CheckBox"}
			]
		},{
			"n":"Title / Memo", "c":[
				{"n":"Title - Subtitle", "u":"Subject_Mod"},
				{"n":"Title - CSS Styles", "u":"CSS_Exam"},
				{"n":"Memo - Basic", "u":"Memo_Basic"},
				{"n":"Memo - Box", "u":"Memo_BorderColor"},
				{"n":"Memo - Font / Color / Size", "u":"Memo_Font_Color_Size"}
			]
		},{
			"n":"Zoom", "c":[
				{"n":"Line Chart (Fixed Y-axis)", "u":"Zoom_Line_Fix"},
				{"n":"Line Chart (Variable Y-axis)", "u":"Zoom_Line_Flexible"},
				{"n":"Column Chart", "u":"Zoom_Column"},
				{"n":"Bar Chart", "u":"Zoom_Bar"},
				{"n":"Area Chart", "u":"Zoom_Area"},
				{"n":"Bubble Chart", "u":"Zoom_Bubble"},
				{"n":"Plot Chart", "u":"Zoom_Plot"},
				{"n":"Combination Chart", "u":"Zoom_Combination"}
				//{"n":"Real-Time Chart", "u":"Zoom_Real_Time"}
			]
		},{
			"n":"Events / Functions", "c":[
				{"n":"Mouse Over - Tooltips", "u":"Mouse_Tooltip"},
				{"n":"Mouse Click - Explode Pie Slice", "u":"Click_Pie_2D"},
				{"n":"Mouse Click - Show Details", "u":"Click_Bar_3D"},
				{"n":"Mouse Click - Redirect", "u":"Click_Column_3D"},
				{"n":"Mouse Click - Drill Down", "u":"Click_Pie3D_CreateChart"},
				{"n":"Rendering Completed - Call Functions", "u":"ChartLoadComp_CallJavascript"},
				{"n":"Button Click - Resize", "u":"Resize_UserEvent"},
				{"n":"Show / Hide Preloader", "u":"ShowAndHidePreloader"},
				{"n":"Empty Dataset", "u":"No_Data_Func"}

			]
		},{
			"n":"Data Editor", "c":[
				{"n":"Basic", "u":"DataEditor_Basic"},
				{"n":"Editor Color", "u":"DataEditor_Color"},
				{"n":"Large Amounts of Data", "u":"DataEditor_HugeData"}
			]
		},{
			"n":"Export Chart", "c":[
				{"n":"Save as Image (Send to Server)", "u":"GetImageSnapshot"}
			]
		},{
			"n":"Large Amounts of Data", "c":[
				{"n":"Line Chart (3,000 items)", "u":"HugeData_Line"},
				{"n":"Plot Chart (3,000 items)", "u":"HugeData_Plot"},
				{"n":"Scroll Chart (1,000 items)", "u":"HugeData_Column"}
			]
		},{
			"n":"Multiple Charts", "c":[
				{"n":"Different Layout / Dataset", "u":"Dual_Chart"},
				{"n":"Same Layout / Different Dataset", "u":"Dual_Chart2"}
			]
		},{
			"n":"Theme", "c":[
				{"n":"Using Theme", "u":"ApplyTheme_Chart"}
			]
		},{
			"n":"Using Patterns for Visually Impaired Users", "c":[
				{"n":"Pattern - Line Chart", "u":"Pattern_Line_2D"},
				{"n":"Pattern - Column Chart", "u":"Pattern_Column_2D"},
				{"n":"Pattern - Area Chart", "u":"Pattern_Area_2D"},
				{"n":"Pattern - Pie Chart", "u":"Pattern_Pie_2D"},
				{"n":"Pattern - Gauge", "u":"Pattern_Gauge"},
				{"n":"User-defined", "u":"Pattern_Custom"}
			]
		}
	],

	images = [{
			"n":"Line Chart", "u":"line"
		},{
			"n":"Column Chart", "u":"column"
		},{
			"n":"Area Chart", "u":"area"
		},{
			"n":"Pie Chart", "u":"pie"
		},{
			"n":"Bubble Chart", "u":"bubble"
		},{
			"n":"Plot Chart", "u":"plot"
		},{
			"n":"Target vs Actual", "u":"target"
		},{
			"n":"History Chart", "u":"history"
		},{
			"n":"Broken-Axis Chart", "u":"broken"
		},{
			"n":"Image Chart", "u":"image"
		},{
			"n":"Candlestick Chart", "u":"candle"
		},{
			"n":"Gague Chart", "u":"gauge"
		}
],

tutorialContent = [{
		"index":0,"content":"<pre><font color='#0000ff'>&#60;html&#62</font></pre>","className":"active_tutorial_child"
	},{
		"index":1,"content":'<pre>'
		+'<font color="#4BBF5A">&#60;!-- for IE7, 8 --&#62;<br>'
		+'&#60;!--[if IE]&#62;<br>'
		+'<font color="#0000ff">&#60;script <font color="#ff0000">language="javascript" type="text/javascript" src="../KoolChart/JS/excanvas.js"</font>&#62;<br>&#60;/script></font><br>'
		+'&#60;![endif]--&#62;</font><br><br>'
		+'<font color="#4BBF5A">&#60;!-- KoolChart License --&#62;</font><br>'		
		+'<font color="#0000ff">&#60;script <font color="#ff0000">language="javascript" type="text/javascript" src="../LicenseKey/KoolChartLicense.js"</font>&#62;<br>&#60;/script&#62;</font><br><br>'
		+'<font color="#4BBF5A">&#60;!-- KoolChart Library --&#62;</font><br>'
		+'<font color="#0000ff">&#60;script <font color="#ff0000">language="javascript" type="text/javascript" src="../KoolChart/JS/KoolChart.js"</font>&#62;<br>&#60;/script&#62;</font><br><br>'
		+'</pre>'
		,"className":"none_tutorial_child","displayList":true,"displayIndex":0
		,"displayBtn":"What you are doing in this step is including JavaScript files for creating charts.<br> If IE7 (or IE8) is used, then excanvs.js must be included."
	},{
		"index":2,"content":'<pre><font color="#0000ff">&#60;script <font color="#ff0000">type="text/javascript"</font>></font><br>'
		+'<font color="#4BBF5A">// Sets the value of KoolOnLoadCallFunction to the name of a JS function (e.g. chartReadyHandler) that is called when the chart is ready to be created.</font><br>'
		+'<font color="#0000ff">var <font color="#792929">chartVars = "KoolOnLoadCallFunction=chartReadyHandler";</font><br><br>'
		+'<font color="#4BBF5A">// Creating the chart.<br>'
		+'// Parameters <br>'
		+'//  1. Chart ID: You can use any name you like. <br>'
		+'//  2. DIV ID: The chart will be placed in this DIV.<br>'
		+'//  3. chartVars: Variables used for creating the chart.<br>'
		+'//  4. Chart width: Default value is 100%<br>'
		+'//  5. Chart height: Default value is 100%</font><br>'
		+'<font color="#792929">KoolChart.create("chart1", "chartHolder", chartVars, "100%", "100%"); </font><br><br>'
		+'<font color="#4BBF5A">// The JavaScript function which is set to the value of KoolOnLoadCallFunction.<br>'
		+'// This function will call two functions, setLayout() and setData() which are two main functions of KoolChart.<br>'
		+'// Parameter: <br>'
		+'//  1. ID: The Chart ID which is used as the first parameter of KoolChart.create().</font><br>'
		+'function <font color="#792929">chartReadyHandler(id) {<br>'
		+'	document.getElementById(id).setLayout(layoutStr);<br>'
		+'	document.getElementById(id).setData(chartData);<br>'
		+'}</font></font><br><br>'
		+'</pre>'
		,"className":"none_tutorial_child","displayList":true,"displayIndex":2
		,"displayBtn":"What you are doing in this step is writing the script for creating the chart.<br>"
						+"Please read the commented out text."
	},{
		"index":3,"content":'<pre>'
		+'<font color="#4BBF5A">// Declares Layout</font><br>'
		+'<font color="#0000ff">var</font> <font color="#792929">layoutStr = &#39;&#60;KoolChart backgroundColor="0xFFFFFF" cornerRadius="12" borderThickness="1" borderStyle="none">&#39;<br>'
		+'			+&#39;&#60;Options>+&#39;<br>'
		+'				+&#39;&#60;Caption text="RainFall"/>&#39;<br>'
		+'				+&#39;&#60;SubCaption text="( mm )" textAlign="right"/>&#39;<br>'
		+'			+&#39;&#60;/Options>&#39;<br>'
		+'			+&#39;&#60;NumberFormatter id="numFmt" precision="0"/>&#39;<br>'
		+'			+&#39;&#60;Line2DChart showDataTips="true" dataTipDisplayMode="remote" paddingTop="0">&#39;<br>'
		+'				+&#39;&#60;horizontalAxis>&#39;<br>'
		+'					+&#39;&#60;CategoryAxis categoryField="Month"/>&#39; <br>'
		+'				+&#39;&#60;/horizontalAxis>&#39;<br>'
		+'				+&#39;&#60;verticalAxis>&#39;<br>'
		+'					+&#39;&#60;LinearAxis minimum="70" maximum="100" interval="5"/>&#39;<br>'
		+'				+&#39;&#60;/verticalAxis>&#39;<br>'
		+'				+&#39;&#60;series>&#39;<br>'
		+'					+&#39;&#60;Line2DSeries yField="Vancouver" displayName="Vancouver">&#39;<br>'
		+'					+&#39;&#60;/Column2DSeries>&#39;<br>'
		+'				+&#39;&#60;/series>&#39;<br>'
		+'				+&#39;&#60;annotationElements>&#39;<br>'
		+'					+&#39;&#60;CrossRangeZoomer backgroundColor="0xeb494a" borderColor="0xeb494a" enableZooming="false" horizontalLabelFormatter="{numFmt}" horizontalStrokeEnable="false">&#39;<br>'
		+'						+&#39;&#60;verticalStroke>&#39;<br>'
		+'							+&#39;&#60;Stroke color="0xeb494a" />&#39;<br>'
		+'						+&#39;&#60;/verticalStroke>&#39;<br>'
		+'					+&#39;&#60;/CrossRangeZoomer>&#39;<br>'
		+'				+&#39;&#60;/annotationElements>&#39;<br>'
		+'			+&#39;&#60;/Column2DChart>&#39;<br>'
		+'		+&#39;&#60;/KoolChart>&#39;;</font><br><br>'
		+'</pre>'
		,"className":"none_tutorial_child","displayList":true,"displayIndex":3
		,"displayBtn":"What you are doing in this step is declaring Layout."
	},{
		"index":4,"content":'<pre>'
		+'<font color="#4BBF5A">// Declares Dataset<br></font>'
		+'<font color="#0000ff">var</font> <font color="#792929">chartData = [{"Month":"Jan", "Vancouver":80},<br>'
		+'		{"Month":"Feb", "Vancouver":90},<br>'
		+'		{"Month":"Mar", "Vancouver":83},<br>'
		+'		{"Month":"Apr", "Vancouver":81},<br>'
		+'		{"Month":"May", "Vancouver":87},<br>'
		+'		{"Month":"Jun", "Vancouver":89},<br>'
		+'		{"Month":"Jul", "Vancouver":86},<br>'
		+'		{"Month":"Aug", "Vancouver":92},<br>'
		+'		{"Month":"Sep", "Vancouver":88},<br>'
		+'		{"Month":"Oct", "Vancouver":84},<br>'
		+'		{"Month":"Nov", "Vancouver":87},<br>'
		+'		{"Month":"Dec", "Vancouver":90}];</font><br><br>'
		+'</pre>'
		,"className":"none_tutorial_child","displayList":true,"displayIndex":4
		,"displayBtn":"What you are doing in this step is declaring Dataset."
	},{
		"index":5,"content":'<pre><font color="#0000ff">&#60/script></font><br><br></pre>',"className":"none_tutorial_child","displayList":true,"displayIndex":2
	},{
		"index":6,"content":"<pre><font color='#0000ff'>&#60;body></font></pre>","className":"active_tutorial_child"
	},{
		"index":7,"content":'<pre>'
		+'	<font color="#0000ff">&#60;div <font color="#ff0000">id="content"</font>><br>'
		+'		<font color="#4BBF5A">&#60;!-- The DIV in which the chart is placed --></font><br>'
		+'		&#60;div <font color="#ff0000">id="chartHolder" style="width:600px; height:400px;"</font>><br>'
		+'		&#60;/div><br>'
		+'	&#60;/div></font><br><br>'
		+'</pre>'
		,"className":"none_tutorial_child","displayList":true,"displayIndex":1
		,"displayBtn":"What you are doing in this step is declaring the DIV in which the chart is placed."
	},{
		"index":8,"content":'<pre>'
		+'<font color="#0000ff">&#60;/body><br>'
		+'&#60;/html></font>'
		+'</pre>'
		,"className":"active_tutorial_child"
	},{
		"index":9,"content":''
		,"className":"none_tutorial_child","displayList":true,"displayIndex":5
		,"displayBtn":""
	}
],

/*
	n: Name	c: Child (Submenu)	u: URL	
	t: Hiding Themes
		-1: All
		0(Right) ~ 6(Left)
*/

none_theme = [{
	// Column
		"n":"Column", "c":[
			{"n":"Cylinder 3D", "u":"Cylinder_3D","t":[0]},
			{"n":"Cylinder MultiSeries 3D", "u":"Cylinder_3D_MS","t":[0]},
			{"n":"Cylinder Stacked 3D", "u":"Cylinder_3D_Stacked","t":[0]}
		]
	},{
	// Bar
		"n":"Bar", "c":[
			{"n":"Cylinder Bar 3D", "u":"Cylinder_Bar_3D","t":[0]},
			{"n":"Cylinder Bar Stacked 3D", "u":"Cylinder_Bar_3D_Stacked","t":[0]}
		]
	},{
	// From-to
		"n":"From - To", "c":[
			{"n":"WaterFall", "u":"From_To_Column_2D","t":[-1]}
		]
	},{
	// RealTime-Premium
		"n":"RealTime-Premium", "c":[
			{"n":"Different Cycles (1)", "u":"RealTime_Premium_Line_Column","t":[-1]},
			{"n":"Today and Yesterday's Data", "u":"RealTime_Premium_10Int","t":[-1]},
			{"n":"Different Cycles (2)", "u":"RealTime_Premium_25Base","t":[-1]}
		]
	},{
	// Slide
		"n":"Slide", "c":[
			{"n":"Slide Basic", "u":"Slide_Sample","t":[-1]},
			{"n":"Slide with Effects", "u":"Slide_Sample2","t":[-1]}
		]
	},{
	// Gauge
		"n":"Gauge", "c":[
  			{"n":"Circular Orange", "u":"Gauge_Circular_Orange","t":[-1]},
			{"n":"Circular Rainbow", "u":"Gauge_Circular_Rainbow","t":[-1]},
			{"n":"Circular Gradient", "u":"Gauge_Circular_Gradient","t":[-1]},
			{"n":"Circular Dual", "u":"Gauge_Circular_Dual","t":[-1]},
			{"n":"Half-Circular Rainbow1", "u":"Gauge_Half_Rainbow1","t":[-1]},
			{"n":"Half-Circular Rainbow2", "u":"Gauge_Half_Rainbow2","t":[-1]},
			{"n":"Half-Circular Notice", "u":"Gauge_Half_Notice","t":[-1]},
			{"n":"Half-Circular Gradient", "u":"Gauge_Half_Gradient","t":[-1]},
			{"n":"Horizontal Cylinder Gauge", "u":"Gauge_HorizontalCylinder","t":[-1]},
			{"n":"Vertical Cylinder Gauge", "u":"Gauge_VerticalCylinder","t":[-1]},
			{"n":"Horizontal Linear Gauge", "u":"Gauge_HorizontalLinear","t":[-1]},
			{"n":"Vertical Linear Gauge", "u":"Gauge_VerticalLinear","t":[-1]}
		]
	},{
	// Candlestick
		"n":"Candlestick", "c":[
			{"n":"Candlestick", "u":"Candlestick_Normal","t":[-1]},
			{"n":"Candlestick Reverse", "u":"Candlestick_Reverse","t":[-1]},
			{"n":"Candlestick Symbol (1)", "u":"Candlestick_Symbol","t":[-1]},
			{"n":"Candlestick Symbol (2)", "u":"Candlestick_Symol_Another","t":[-1]}
		]
	},{
		// Image
		"n":"Image", "c":[
			{"n":"Same Ratio / Single Image (1)", "u":"Image_Single_Ratio","t":[-1]},
			{"n":"Same Ratio / Single Image (2)", "u":"Image_Single_MS_Ratio","t":[-1]},
			{"n":"Different Ratio / Single Image (1)", "u":"Image_Single_FRatio","t":[-1]},
			{"n":"Different Ratio / Single Image (2)", "u":"Image_Single_FRatio2","t":[-1]},
			{"n":"Single Ratio / Repetitive Image (1)", "u":"Image_SingleRepeat","t":[-1]},
			{"n":"Single Ratio / Repetitive Image (2)", "u":"Image_SingleRepeat2","t":[-1]},
			{"n":"Different Ratio / Multiple Images (1)", "u":"Image_Multiple","t":[-1]},
			{"n":"Different Ratio / Multiple Images (2)", "u":"Image_Multiple2","t":[-1]}
		]
	}
];