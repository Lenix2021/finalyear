
<!DOCTYPE html>
<html>
<head>
	<title>Moderator Report</title>
</head>
<body>

	<form action="form.php" method="POST">
        <Center>  <header>
  <h1>HO TECHNICAL UNIVERSITY</h1>
  <h2>FACULTY OF APPLIED SCIENCES AND TECHNOLOGY</h2>
  <h3>DEPARTMENT OF COMPUTER SCIENCE</h3>
  <h4>INTERNAL MODERATION OF HND EXAMINATION PAPERS</h4>
  <h5>(Examination Questions and Marking Scheme Assetment Form)</h5>
</header></CEnter>
   
		<fieldset>
			<legend>Section A: Preliminaries</legend>
			<label for="field1">Name of Department:</label>
			<input type="text" id="field1" name="field1" required>
            <br>
			<label for="field2">Academic Year</label>
			<input type="text" id="field2" name="acyear" required>
            <br>
            <label for="field2">Semester:</label>
<select id="field2" name="sem" required>
  <option value="">Select Semester</option>
  <option value="1st">1st</option>
  <option value="2nd">2nd</option>
</select>
            <br>
            <label for="field2">Programme</label>
			<input type="text" id="field2" name="prog" required>
            <br>
            <label for="field2">Course Code</label>
			<input type="text" id="field2" name="coursecode" required>
            <br>
            <label for="field2">Course Title</label>
			<input type="text" id="field2" name="coursetitle" required>
            <br>
            <label for="field2">Name of Examiner</label>
			<input type="text" id="field2" name="examiner" required>
            

		</fieldset>
		<fieldset>
			<legend>Section B : Prerequisties</legend>
			<table >
				<thead>
					<tr>
						<th>S/N</th>
						<th>Required Items</th>
						<th>Select</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Course Outline</td>
						<td>
							<input type="radio" id="yes1" name="row1" value="yes">
							<label for="yes1">Yes</label>
							<input type="radio" id="no1" name="row1" value="no">
							<label for="no1">No</label>
						</td>
						
					</tr>
					<tr>
						<td>2</td>
						<td>Examination Question paper</td>
						<td>
							<input type="radio" id="yes3" name="row2" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row2" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>

                    <tr>
						<td>3</td>
						<td>Marking scheme</td>
						<td>
							<input type="radio" id="yes3" name="row3" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row3" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>
				</tbody>
			</table>
		</fieldset>
		<fieldset>
			<legend>Section C : Verifications</legend>
			<table >
				<thead>
					<tr>
						<th>S/N</th>
						<th>Required Items</th>
						<th>Select</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Course Outline</td>
						<td>
							<input type="radio" id="yes1" name="row4" value="yes">
							<label for="yes1">Yes</label>
							<input type="radio" id="no1" name="row4" value="no">
							<label for="no1">No</label>
						</td>
						
					</tr>
					<tr>
						<td>2</td>
						<td>Examination Question paper</td>
						<td>
							<input type="radio" id="yes3" name="row5" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row5" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>

                    <tr>
						<td>3</td>
						<td>Marking scheme</td>
						<td>
							<input type="radio" id="yes3" name="row6" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row6" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>
				</tbody>
			</table>
		
		<fieldset>
			<legend>Section D : Decision of Assesor</legend>
			<table >
				<thead>
					<tr>
						<th>S/N</th>
						<th>Assetment Questions</th>
						<th>Select</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Course Outline</td>
						<td>
							<input type="radio" id="yes1" name="row7" value="yes">
							<label for="yes1">Yes</label>
							<input type="radio" id="no1" name="row7" value="no">
							<label for="no1">No</label>
						</td>
						
					</tr>
					<tr>
						<td>2</td>
						<td>Examination Question paper</td>
						<td>
							<input type="radio" id="yes3" name="row8" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row8" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>

                    <tr>
						<td>3</td>
						<td>Marking scheme</td>
						<td>
							<input type="radio" id="yes3" name="row9" value="yes">
							<label for="yes3">Yes</label>
							<input type="radio" id="no3" name="row9" value="no">
							<label for="no3">No</label>
						</td>
					
					</tr>
				</tbody>
			</table>
		</fieldset>
		<fieldset>
	<legend>Section E : Recommendations/Observations</legend>
	<label for="general-observation">General Observation:</label>
	<textarea id="general-observation" name="general_observation"></textarea>
	<label for="head-of-department">Name of Head of Department:</label>
	<input type="text" id="head-of-department" name="head_of_department">
	<label for="date">Date:</label>
	<input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
</fieldset>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
