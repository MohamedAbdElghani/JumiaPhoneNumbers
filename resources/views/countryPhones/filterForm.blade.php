<form method="GET" action="{{route('phones')}}">
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Select Country</label>
                <div class="col-sm-7">
                    <select class="form-control" name="country">
                        <option value="">Select...</option>
                        @foreach($data['countries'] as $country)
                            <option value="{{($country)}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Phone State</label>
                <div class="col-sm-8">
                    <select class="form-control" name="state">
                        <option value="">Select...</option>
                        <option value="valid">Valid</option>
                        <option value="nonValid">Invalid</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
    @include('countryPhones.countriesTable')
</form>