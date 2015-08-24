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

	if(requestAllData != null && requestAllData.equals("true"))
	{
		
		int baseMinutes = date.getMinutes();

		long startDateTime = date.getTime() - (baseMinutes * 60 * 1000);
		
		Date startDate = new Date(startDateTime);

		long endDateTime = startDate.getTime() + ( 60 * 1000 * 60 );
		
		Date endDate = new Date(endDateTime);
		endDate.setSeconds(0);

		out.println("<isInitData>"+true+"</isInitData>");

		out.println("<nextInitDate>"+dateFmt.format(endDate)+"</nextInitDate>");
		
		
		out.println("<startDate>"+dateFmt.format(startDate)+"</startDate>");
		out.println("<endDate>"+dateFmt.format(endDate)+"</endDate>");
		
		out.println("</infoMsg>");
		
		long gap = date.getTime() - startDateTime;
		
		for(int i=0; i<=gap; i+=1000*5)
		{
			data1 = 100 + myRandom.nextInt(100)/2;

			long nextTime = startDateTime + i;
			Date baseDate = new Date(nextTime);
			
			out.println("<item>");
			out.println("<date>"+dateFmt.format(baseDate)+"</date>");
			out.println("<todayData>"+data1+"</todayData>");
			out.println("</item>");
		}
	}

	else
	{
			out.println("<isInitData>"+false+"</isInitData>");
			out.println("</infoMsg>");

			data1 = 100 + myRandom.nextInt(100)/2;

			out.println("<item>");
			out.println("<date>"+dateFmt.format(date)+"</date>");
			out.println("<todayData>"+data1+"</todayData>");
			out.println("</item>");
	}
	out.println("</items>");
%>