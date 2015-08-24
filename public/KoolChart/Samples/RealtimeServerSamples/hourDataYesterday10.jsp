<%@ page language="java" contentType="text/xml; charset=utf-8" %>
<%@ page import="java.util.*" %>
<%@ page import="java.text.SimpleDateFormat" %>

<%
	Random myRandom = new Random();
	
	SimpleDateFormat dateFmt = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");

	String requestAllData = request.getParameter("requestAllData");
	
	Date date = new Date();

	int data1;

	out.println("<items>");
	out.println("<infoMsg>");

	out.println("<index>"+0+"</index>");
	out.println("<timeNow>"+dateFmt.format(date)+"</timeNow>");
		
	int baseMinutes = date.getMinutes();

	long startDateTime = date.getTime() - (baseMinutes * 60 * 1000) - (1000 * 60 * 60 * 24);
	
	Date startDate = new Date(startDateTime);

	long endDateTime = startDate.getTime() + ( 60 * 1000 * 60 );
	
	Date endDate = new Date(endDateTime);
	endDate.setSeconds(0);
	
	long nextInitTime = date.getTime()- (baseMinutes * 60 * 1000)  + (60 * 60 * 1000);
	Date nextInitDate = new Date(nextInitTime);
	nextInitDate.setSeconds(0);

	out.println("<isInitData>"+true+"</isInitData>");

	out.println("<nextInitDate>"+dateFmt.format(nextInitDate)+"</nextInitDate>");
	
	out.println("<endDate>"+dateFmt.format(endDate)+"</endDate>");
	
	out.println("</infoMsg>");
	
	long gap = endDateTime - startDateTime;
	
	for(int i=0; i<=gap; i+=1000*10)
	{
		data1 = 100 + myRandom.nextInt(100)/2;

		long nextTime = startDateTime + i;
		Date baseDate = new Date(nextTime);
		
		out.println("<item>");
		out.println("<date>"+dateFmt.format(baseDate)+"</date>");
		out.println("<yesData>"+data1+"</yesData>");
		out.println("</item>");
	}
	out.println("</items>");
%>