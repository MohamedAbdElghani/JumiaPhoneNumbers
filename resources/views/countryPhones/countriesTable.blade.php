<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Country</th>
        <th scope="col">State</th>
        <th scope="col">Country code</th>
        <th scope="col">Phone number</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['customers']->resolve() as $customer)
    <tr>
        <td>{{$customer['country']}}</td>
        <td>{{$customer['state'] == True ? 'OK' : 'NOK'}}</td>
        <td>{{$customer['countryCode']}}</td>
        <td>{{$customer['phoneNo']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>