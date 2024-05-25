<div>
	<h4>Hello Mathify</h4>
	<p>{{ $name }} has cancelled the subscription</p>
	<h4>Plan Information</h4>
	<table style="width:100%">
		<tr>
			<th style="text-alig">Student Name</th>
			<td>{{ $name }}</td>
		</tr>
		<tr>
			<th>Student Email</th>
			<td>{{ $email }}</td>
		</tr>
		<tr>
			<th>Plan Name</th>
			<td>{{ $plan_name }}</td>
		</tr>
	</table>
	<h5>Thanks</h5>
	<h5>{{ $name }}</h5>
</div>