<option value="">點我選擇門市</option>
@foreach($data as $v)
    <option value="{{ $v['shop_no'] }}">{{ $v['shop_name'] }}門市（{{ str_replace($city_name.$county_name,'',$v['shop_address']) }}）</option>
@endforeach
