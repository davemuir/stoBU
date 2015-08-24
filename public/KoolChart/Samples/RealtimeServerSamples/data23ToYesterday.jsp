<%@ page language="java" contentType="text/xml; charset=utf-8" %>
<%@ page import="java.util.*" %>
<%@ page import="java.text.SimpleDateFormat" %>

<%

	Random myRandom = new Random();
	
	SimpleDateFormat dateFmt = new SimpleDateFormat("yyyy/MM/dd HH:mm");

	String requestAllData = request.getParameter("requestAllData");
	
	Date date = new Date();

	int data1;

	out.println("<items>");
	out.println("<infoMsg>");

	out.println("<index>"+dateFmt.format(date)+"</index>");
	out.println("<timeNow>"+dateFmt.format(date)+"</timeNow>");

	int baseHour = date.getHours() + 1;

	int baseMinutes = date.getMinutes();
	
	long startDateTime = date.getTime() - (baseHour * 60 * 60 * 1000) - (baseMinutes * 60 * 1000) - (1000 * 60 * 60 * 24);

	Date startDate = new Date(startDateTime);

	long endDateTime = date.getTime() - ((baseHour-1) * 60 * 60 * 1000) - (baseMinutes * 60 * 1000) - (1000 * 60);

	Date endDate = new Date(endDateTime);
	
	Date nextInitDate = new Date();
	nextInitDate.setHours(23);
	nextInitDate.setMinutes(59);

	long gap = endDate.getTime() - startDateTime;
	
	out.println("<isInitData>"+true+"</isInitData>");

	out.println("<nextInitDate>"+dateFmt.format(nextInitDate)+"</nextInitDate>");

	out.println("<startDate>"+dateFmt.format(startDate)+"</startDate>");

	out.println("<endDate>"+dateFmt.format(endDate)+"</endDate>");
	out.println("</infoMsg>");

	for(int i=0; i<=gap; i+=1000*60*3)
	{
		data1 = 100 + myRandom.nextInt(500)/2;

		long nextTime = startDateTime + i;
		Date baseDate = new Date(nextTime);
		
		out.println("<item>");
		out.println("<date>"+dateFmt.format(baseDate)+"</date>");
		out.println("<yesTotalData>"+data1+"</yesTotalData>");
		out.println("</item>");
	}
	out.println("</items>");
%>