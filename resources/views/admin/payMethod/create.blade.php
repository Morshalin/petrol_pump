<form action="{{route('admin.paymethod.store')}}" id="content_form1" method="post" >
@csrf
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="payMethodName">{{_lang('Pay Method')}}</label>
			<input type="text" class="form-control" name="payMethodName" id="payMethodName">
		</div>
    </div>
</div>

 <div class="text-right mt-2">
  <button type="submit" class="btn btn-primary btn-sm"  id="submit">{{_lang('create')}}</button>
  <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px">
</button>

 </div>
</form>

<table class="table content_managment_table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Method Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($models as $key => $item)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$item->payMethodName}}</td>
            <td>
                <span style="cursor: pointer;" data-id="{{$item->id}} " data-url="{{route('admin.paymethod.destroy',$item->id)}}" class="badge badge-danger" id="delete_item"> Delete</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    _modalFormValidation1();
</script>
