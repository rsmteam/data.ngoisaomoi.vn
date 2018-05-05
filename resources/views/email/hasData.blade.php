<style type="text/css" media="screen">
	table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    padding: 5px 10px;
}
</style>
<h2>Đã có phát sinh data mới vào lúc {{ $register_time }}</h2>

<table style="border-collapse: collapse;border:1px solid black">
	<thead>
		<tr>
			<th style="border: 1px solid black; padding: 5px 10px;">Tên khách hàng</th>
			<th style="border: 1px solid black; padding: 5px 10px;">Số điện thoại</th>
			<th style="border: 1px solid black; padding: 5px 10px;">Email</th>
			<th style="border: 1px solid black; padding: 5px 10px;">UTM_source</th>
			<th style="border: 1px solid black; padding: 5px 10px;">utm_medium</th>
			<th style="border: 1px solid black; padding: 5px 10px;">utm_campaign</th>
			<th style="border: 1px solid black; padding: 5px 10px;">link website</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $name }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $phone }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $email }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $utm_source }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $utm_medium }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $utm_campaign }}</td>
			<td style="border: 1px solid black; padding: 5px 10px;">{{ $link }}</td>
		</tr>
	</tbody>
</table>
