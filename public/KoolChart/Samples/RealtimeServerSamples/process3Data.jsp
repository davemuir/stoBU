<%@ page language="java" contentType="text/xml; charset=utf-8" %>
<%@ page import="java.util.*" %>
<%@ page import="java.text.SimpleDateFormat" %>
<%
Random myRandom = new Random();
Date date = new Date();
int p1 = myRandom.nextInt(100);
int p2 = myRandom.nextInt(100);
int p3 = myRandom.nextInt(100);

SimpleDateFormat dateFmt = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");

out.println("<items>");
out.println("<item>");
out.println("<Time>"+dateFmt.format(date)+"</Time>");
out.println("<P1>"+p1+"</P1>");
out.println("<P2>"+p2+"</P2>");
out.println("<P3>"+p3+"</P3>");
out.println("</item>");
out.println("</items>");
%>
