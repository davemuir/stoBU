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

	if(requestAllData != null && requestAllData.equals("true"))
	{
		int baseHour = date.getHours() + 1;

		int baseMinutes = date.getMinutes();

		long startDateTime = date.getTime() - (baseHour * 60 * 60 * 1000) - (baseMinutes * 60 * 1000);

		Date startDate = new Date(startDateTime);

		Date endDate = new Date();
		endDate.setHours(23);
		endDate.setMinutes(59);
		
		Date nextInitDate = endDate;

		long gap = date.getTime() - startDateTime;
		
		out.println("<isInitData>"+true+"</isInitData>");

		out.println("<nextInitDate>"+dateFmt.format(nextInitDate)+"</nextInitDate>");

		out.println("<startDate>"+dateFmt.format(startDate)+"</startDate>");

		out.println("<endDate>"+dateFmt.format(endDate)+"</endDate>");
		out.println("</infoMsg>");

		for(int i=0; i<=gap; i+=1000*60*10)
		{
			data1 = 100 + myRandom.nextInt(500)/2;

			long nextTime = startDateTime + i;
			Date baseDate = new Date(nextTime);

			out.println("<item>");
			out.println("<date>"+dateFmt.format(baseDate)+"</date>");
			out.println("<data60>"+data1+"</data60>");
			out.println("</item>");
		}
	}
	else
	{
			out.println("<isInitData>"+false+"</isInitData>");
			out.println("</infoMsg>");

			long baseStartTime = date.getTime();
			
			long gap = date.getTime() - baseStartTime;

			for(int i=0; i<=gap; i+=1000*60*10)
			{
				data1 = 100 + myRandom.nextInt(500)/2;

				long nextTime = baseStartTime + i;
				Date baseDate = new Date(nextTime);

				out.println("<item>");
				out.println("<date>"+dateFmt.format(baseDate)+"</date>");
				out.println("<data60>"+data1+"</data60>");
				out.println("</item>");
			}
	}
	out.println("</items>");
%>