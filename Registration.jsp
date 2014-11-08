<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    <%@ page import="java.sql.*" %>
    <%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Registration Form</title>
</head>
<body><%
Connection conn = null;
try{
//"jdbc:mysql://68.178.143.9:3306/thoughtspot"
conn = DriverManager.getConnection("jdbc:mysql://p3nlmysqladm002.secureserver.net/grid55/15/index.php:3306/toughtspot","thoughtspot","Nerdsquad14!");
if(conn != null){
System.out.println("connected");
}
//String query = ("SELECT program, school FROM Programs p INNER JOIN Schools s WHERE p.program=s.program;");
//PreparedStatement ps = null;

}catch(SQLException e){
	e.printStackTrace();
}finally{
	}


%>


	<form method="post" action="controler">
	
	<table id="table">
	<tr id="tableRow"><td id="tableData">User Name:</td>
	<td> <input required type="text" name="userName"><br><br></td></tr>
		<tr id="tableRow"><td id="tableData">First Name:</td>
		 <td id="tableData"><input required type="text" name="firstName"><br><br></td></tr>
	    <tr id="tableRow"><td id="tableData">Last Name:</td>
	    <td id="tableData"> <input required type="text" name="lastName"><br><br></td></tr>
	    <tr id="tableRow"><td id="tableData">email:</td>
	    <td id="tableData"> <input required type="email" name="email"><br><br></td></tr>
	    <tr id="tableRow"><td id="tableData">School: </td>
	    <td id="tableData"><select	name="optionsSchool">
			<option value="">schoolName
			<option value="schoolName">schoolName
			<option value="schoolName">schoolName
		</select><br><br></td></tr>
		 <tr id="tableRow"><td id="tableData">Program:</td>
		 <td id="tableData"> <select name="optionsProgram">
			<option value="program">program
			<option value="program">program
			<option value="program">program
		</select><br><br></td></tr>
	    <tr id="tableRow"><td id="tableData">Phone Number:</td>
	    <td id="tableData"> <input required type="number" name="phoneNumber"><br><br></td></tr>
		<tr id="tableRow"><td>Street Address:</td>
		 <td id="tableData"><input required type="text" name="streetAddress"><br><br></td></tr>
		<tr id="tableRow"><td id="tableData">Province: </td>
		<td id="tableData"><select name="optionsProvince">
			<option value="Province">Province
			<option value="Province">Province
			<option value="Province">Province
		</select> <br><br></td></tr>
		<tr id="tableRow"><td>Postal Code: </td>
		<td id="tableData"><input required type="text" name="postalCode"><br><br></td></tr>
		<tr><td colspan="2"><input type="submit" name="submit" value="Register">
		
	</table>
	</form>

</body>
</html>